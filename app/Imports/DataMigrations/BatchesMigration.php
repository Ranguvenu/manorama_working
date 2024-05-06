<?php

namespace App\Imports\DataMigrations;

use App\Models\Ecommerce\Batches;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Category;
use App\Models\MasterData\Hierarchy;
use App\Services\Moodle\Package as PackageService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use App\Models\DataMigrations\TempMmPackages;
use App\Models\DataMigrations\MigrationLogs;

class BatchesMigration implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
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
        $service = new PackageService();
        foreach ($rows as $index => $row) {
            $response = [];
            $excel_row = $this->startRow + $index + 1;
            $response['row'] = $excel_row;
            $response['values'] = $row->toArray();
            $response['has_errors'] = false;
            $response['errors'] = [];
            $errors = false;
            $validator = Validator::make($row->toArray(), [
                'old_id' => 'required',
                'package_id' => 'required',
                'hierarchy_id' => 'required',
                'name' => 'required',
                'code' => 'required|unique:batches,code,'. $row['old_id'] .',old_id',
                'batch_start_date' => 'required',
                'batch_end_date' => 'required',
                'enrollment_start_date' => 'required',
                'enrollment_end_date' => 'required',
                'duration' => 'required',
                'student_limit' => 'required',
                'batch_provider' => 'nullable',
            ]);
            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }
            if ($row['batch_provider']) {
                $providercode = str_replace(' ', '', $row['batch_provider']);
                $providers = Category::where('code', $providercode)->where('taxonomy_slug', 'batch_provider')->first();
                if ($providers) {
                    $provider_id = $providers->id;
                } else {
                    $provider_id = 0;
                }
            } else {
                $provider_id = 0;
            }
            $exists = Batches::where('old_id', $row['old_id'])->first();
            if (!$exists) {
                $package = Packages::where('old_id', $row['package_id'])->first();
                $batchdata = [
                    'old_id' => $row['old_id'],
                    'name' => $row['name'],
                    'code' => $row['code'] ? $row['code'] : '',
                    'batch_start_date' => $row['batch_start_date'] ? $row['batch_start_date'] : '',
                    'batch_end_date' => $row['batch_end_date'] ? $row['batch_end_date'] : '',
                    'enrollment_start_date' => $row['enrollment_start_date'],
                    'enrollment_end_date' => $row['enrollment_end_date'],
                    'duration' => $row['duration'],
                    'student_limit' => $row['student_limit'],
                    'batch_provider_id' => $provider_id,
                    'created_at' => !empty($row['created_on']) ? $row['created_on'] : time(),
                    'updated_at' => !empty($row['updated_on']) ? $row['updated_on'] : time(),
                ];
               
                if ($row['hierarchy_id']) {
                    $subjectid = $row['hierarchy_id'];
                    $actualcourseid = TempMmPackages::where(['packageid' => $row['package_id'], 'subjectid' => $subjectid])->value('mastercourseid');
                    $actualcourse = Hierarchy::where('old_id', $actualcourseid)->value('id');
                    $batchdata['hierarchy_id'] = $actualcourse;
                    $batch = $package->batches()->create($batchdata);
                    $clonedcourse = $service->create_migration_batch($batch);

                    if($batch->id) {
                        $conditions = ['component' => 'Batch', 'component_status' => 'created', 'raw_data' => serialize($row), 'inserted_data' => serialize($batchdata), 'status' => 1];
                        MigrationLogs::create($conditions);
                    } else {
                        $conditions = ['component' => 'Batch', 'component_status' => 'creation Failed', 'raw_data' => serialize($row), 'inserted_data' => serialize($batchdata), 'status' => 0];
                        MigrationLogs::create($conditions);
                    }

                }
            }

            $this->imported[] = $response;
        }
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required',
            '*.package_id' => 'required',
            '*.hierarchy_id' => 'required',
            '*.code' => 'required',
            '*.batch_start_date' => 'required',
            '*.batch_end_date' => 'required',
            '*.enrollment_start_date' => 'required',
            '*.enrollment_end_date' => 'required',
            '*.duration' => 'required',
            '*.student_limit' => 'required',
            '*.batch_provider' => 'nullable',
            '*.created_on' => 'required',
            '*.updated_on' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Name is required',
            'package_id.required' => 'Package is required',
            'code.required' => 'Code is required',
            'code.unique' => 'Given code already exists',
            'batch_start_date.required' => 'Batch Start Date is required',
            'batch_end_date.required' => 'Batch End Date  is required',
            'enrollment_start_date.required' => 'Enrollment Start Date  is required',
            'enrollment_end_date.required' => 'Enrollment End Date  is required',
            'duration.required' => 'Duration is required',
            'student_limit.required' => 'Student Limit required',
            'created_on.required' => 'Created On is required',
            'updated_on.required' => 'Updated On is required',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }
}
