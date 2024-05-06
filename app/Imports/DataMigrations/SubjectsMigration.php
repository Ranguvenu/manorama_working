<?php

namespace App\Imports\DataMigrations;

use App\Models\MasterData\Hierarchy;
use App\Services\Moodle\Hierarchy as HierarchyService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Log;
use App\Models\DataMigrations\MigrationLogs;

class SubjectsMigration implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable;
    use SkipsFailures;
    public $startRow;

    public $imported = [];

    public $failed_imports = [];

    public $service;

    public function __construct(int $startRow = 1)
    {
        $this->service = new HierarchyService();
        $this->startRow = $startRow;
    }

    public function startRow(): int
    {
        return $this->startRow;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $row => $value) {
            $parent_id = Hierarchy::where('code', $value['classcode'])->value('id');
            $response = [];
            $excel_row = $this->startRow + $row + 1;
            $response['row'] = $excel_row;

            $data = [
                'old_id' => !empty($value['old_id']) ? $value['old_id'] : 0,
                'type_id' => 4,
                'classcode' => $value['classcode'],
                'title' => $value['title'],
                'code' => $value['code'],
                'description' => !empty($value['description']) ? $value['description'] : null,
                'image' => !empty($value['image']) ? $value['image'] : null,
                'parent_id' => $parent_id,
                'depth' => 3,
                'mdl_id' => !empty($value['mdl_id']) ? $value['mdl_id'] : 0,
                'tags' => $value['tags'],
                'is_active' => $value['is_active'],
            ];

            $validator = Validator::make($value->toArray(), [
                'classcode' => 'required|exists:hierarchies,code',
                'title' => 'required',
                'code' => 'required',
            ]);
            $response['values'] = $data;
            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                Log::info($response);
                $this->imported[] = $response;
                continue;
            }
            $hierarchy = Hierarchy::where('old_id', $value['old_id'])->first();
            $code = Hierarchy::where('code', $value['code'])->value('id');
            if ($code) {
                unset($data['mdl_id']);
                $hierarchy = Hierarchy::updateOrCreate(['code' => $value['code']], $data);

                $hierarchy->created_at = !empty($value['created_on']) ? $value['created_on'] : time();
                $hierarchy->updated_at = !empty($value['updated_on']) ? $value['updated_on'] : time();
                $hierarchy->save();

                $conditions = ['component' => 'Subjects', 'component_status' => 'updated', 'raw_data' => serialize($value), 'inserted_data' => serialize($data), 'status' => 1];
                MigrationLogs::create($conditions);

                $mdl_id = $this->service->create_hierarchy($hierarchy);
                if ($mdl_id > 0) {
                    $message = "Subject is updated in LMS having old_id ".$value['old_id'];
                    Log::info($message);
                } else {
                    $message = "Subject is not updated in LMS having old_id ".$value['old_id'];
                    Log::info($message);
                }

                $message = "Subject is updated having old_id ".$value['old_id'];
                Log::info($message);

            } else {
                $code = Hierarchy::where('code', $value['code'])->value('id');
                $hierarchy = Hierarchy::create($data);

                $hierarchy->created_at = !empty($value['created_on']) ? $value['created_on'] : time();
                $hierarchy->updated_at = !empty($value['updated_on']) ? $value['updated_on'] : time();
                $hierarchy->save();

                $conditions = ['component' => 'Subjects', 'component_status' => 'created', 'raw_data' => serialize($value), 'inserted_data' => serialize($data), 'status' => 1];
                MigrationLogs::create($conditions);

                $mdl_id = $this->service->create_hierarchy($hierarchy);
                if ($mdl_id) {
                    $hierarchy->mdl_id = $mdl_id;
                    $hierarchy->save();

                    $message = "Subject is created in LMS having old_id ".$value['old_id'];
                    Log::info($message);
                }

                $message = "Subject is created having old_id ".$value['old_id'];
                Log::info($message);
            }
            $response['errors'] = [];
            $response['has_errors'] = false;
            $this->imported[] = $response;
        }
    }

    public function validate($data)
    {
        $validator = Validator::make($data, [
            'classcode' => 'required|exists:hierarchies,code',
            'title' => 'required',
            'code' => 'required|unique:App\Models\MasterData\Hierarchy,code',
        ]);

        return $validator;
    }

    public function rules(): array
    {
        return [
            '*.code' => 'required',
            '*.classcode' => 'required|exists:hierarchies,code',
            '*.title' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'title.required' => 'Title is required',
            'code.required' => 'Code is required',
            'classcode.required' => 'Class Code is required',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the exception how you'd like.
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }
}
