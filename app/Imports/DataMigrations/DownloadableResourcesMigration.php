<?php

namespace App\Imports\DataMigrations;

use App\Models\Content\DownloadableResource;
use App\Models\MasterData\Category;
use App\Models\Modules\Media;
use App\Services\FileUploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Symfony\Component\HttpFoundation\File\UploadedFile as SymfonyUploadedFile;
use Illuminate\Support\Facades\Log;
use App\Models\DataMigrations\MigrationLogs;

class DownloadableResourcesMigration implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable;
    use SkipsFailures;
    public $startRow;

    public $imported = [];

    public $failed_imports = [];

    public function __construct(int $startRow = 1)
    {
        $this->startRow = $startRow;
    }

    public function startRow(): int
    {
        return $this->startRow;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $response = [];
            $excel_row = $this->startRow + $index + 1;
            $response['row'] = $excel_row;
            $response['values'] = $row->toArray();
            $response['has_errors'] = false;
            $response['errors'] = [];
            $errors = false;
            $validator = Validator::make($row->toArray(), [
                'old_id' => 'nullable',
                'title' => 'required',
                'description' => 'required',
                'publish_from' => 'required',
                'publish_to' => 'required',
                'resource_type' => 'nullable',
                'resource' => 'required',
                'is_active' => 'nullable',
            ]);
            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }
            $type = Category::where('name', $row['resource_type'])->orWhere('code', $row['resource_type'])->where('taxonomy_slug', 'resource_type')->first();
            $categorydata = [
                'name' => $row['resource_type'],
                'code' => strtolower(str_replace(' ', '', $row['resource_type'])),
                'taxonomy_slug' => 'resource_type',
            ];
            if (!$type) {
                $taxonomy = new Category();
                $newtype = $taxonomy->create($categorydata);
                $typeid = $newtype->id;
            } else {
                $typeid = $type->id;
            }
            $fileurlinfo = 'https://stag-media.manoramahorizon.com/'.$row['resource'];
            $fileContents = file_get_contents($fileurlinfo);
            $tempFile = tempnam(sys_get_temp_dir(), 'temp');
            file_put_contents($tempFile, $fileContents);
            $file = UploadedFile::createFromBase(new SymfonyUploadedFile($tempFile, basename($fileurlinfo)));
            $service = new FileUploadService('resource');
            $newfile = $service->upload($file);
            $mediadata = [
               'url' => $newfile['url'],
               'name' => pathinfo($fileurlinfo, PATHINFO_FILENAME),
               'size' => 0,
               'component' => 'resource',
               'extension' => pathinfo($fileurlinfo, PATHINFO_EXTENSION),
               'title' => pathinfo($fileurlinfo, PATHINFO_FILENAME),
            ];
            $media = new Media();
            $mediaid = $media->create($mediadata);

            $dresource = DownloadableResource::where('old_id', $row['old_id'])->first();
            if(!$dresource) {
                $data = [
                    'old_id' => $row['old_id'], 
                    'title' => $row['title'],
                    'description' => $row['description'] ? $row['description'] : '',
                    'publish_from' => $row['publish_from'] ? $row['publish_from'] : '',
                    'publish_to' => $row['publish_to'] ? $row['publish_to'] : '',
                    'resource_type_id' => $typeid,
                    'resource_id' => $mediaid->id,
                    'is_active' => $row['is_active'] ? $row['is_active'] : 0,
                ];
                $dtimings = DownloadableResource::create($data);
                if ($dtimings->id) {
                    $conditions = ['component' => 'DownloadableResource', 'component_status' => 'created', 'raw_data' => serialize($row), 'inserted_data' => serialize($data), 'status' => 1];
                    MigrationLogs::create($conditions);
                    
                    $message = "Downloadable Resource having old_id". $row['old_id'] ." is inserted";
                    Log::info($message);
                } else {
                    $conditions = ['component' => 'DownloadableResource', 'component_status' => 'creation Failed', 'raw_data' => serialize($row), 'inserted_data' => serialize($data), 'status' => 0];
                    MigrationLogs::create($conditions);
                    
                    $message = "Downloadable Resource having old_id". $row['old_id'] ." is not inserted";
                    Log::info($message);
                }

                $dtimings->created_at = !empty($row['created_on']) ? $row['created_on'] : time();
                $dtimings->updated_at = !empty($row['updated_on']) ? $row['updated_on'] : time();
                $dtimings->save();
                
            } else {
                $data = [
                    'title' => $row['title'],
                    'description' => $row['description'] ? $row['description'] : '',
                    'publish_from' => $row['publish_from'] ? $row['publish_from'] : '',
                    'publish_to' => $row['publish_to'] ? $row['publish_to'] : '',
                    'resource_type_id' => $typeid,
                    'is_active' => $row['is_active'] ? $row['is_active'] : 0,
                ];
                $dresource->update($data);
                $conditions = ['component' => 'DownloadableResource', 'component_status' => 'updated', 'raw_data' => serialize($row), 'inserted_data' => serialize($data), 'status' => 1];
                MigrationLogs::create($conditions);

                $message = "Downloadable Resource having old_id". $row['old_id'] ." is Updated";
                Log::info($message);
            }

            $this->imported[] = $response;
        }
    }

    public function rules(): array
    {
        return [
            '*.title' => 'required',
            '*.resource' => 'required',
            '*.description' => 'required',
            '*.publish_from' => 'required',
            '*.publish_to' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'title.required' => 'Title is required',
            'resource.required' => 'Resource is required',
            'description.required' => 'Description is required',
            'publish_from.required' => 'Publish From  is required',
            'publish_to.required' => 'Publish To is required',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }
}
