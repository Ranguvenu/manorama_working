<?php

namespace App\Imports\DataMigrations;

use App\Models\Content\Courses;
use App\Models\MasterData\Hierarchy;
use App\Services\Moodle\Package as PackageService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use App\Models\DataMigrations\MigrationLogs;

class BatchCoursesMigration implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable;
    use SkipsFailures;
    public $startRow;

    public $imported = [];

    public $failed_imports = [];

    public $service;

    public function __construct(int $startRow = 1)
    {
        $this->service = new PackageService();
        $this->startRow = $startRow;
    }

    public function startRow(): int
    {
        return $this->startRow;
    }

    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        foreach ($collection as $row => $value) {
            $hierarchy = Hierarchy::where('code', $value['subject_code'])->get(['id', 'mdl_id']);

            $response = [];
            $excel_row = $this->startRow + $row + 1;
            $response['row'] = $excel_row;

            $data = [
                'old_id' => $value['old_id'],
                'subject_code' => $value['subject_code'],
                'package_code' => $value['package_code'],
                'hierarchy_id' => $hierarchy[0]->id,
                'parent_mdl_id' => $hierarchy[0]->mdl_id,
                'mdl_id' => 0,
                'name' => $value['name'],
                'code' => $value['code'],
                'description' => !empty($value['description']) ? $value['description'] : null,
                'thumbnail' => !empty($value['thumbnail']) ? $value['thumbnail'] : null,
            ];

            $validator = Validator::make($value->toArray(), [
                'old_id' => 'required',
                'subject_code' => 'required|exists:hierarchies,code',
                'name' => 'required',
                'code' => 'required',
            ]);
            $response['values'] = $data;
            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }

            $lmsresponse = $this->service->create_batchcourse($value);

            if ($lmsresponse) {
                $mdlid = $lmsresponse[0]['id'];
                $data['mdl_id'] = $mdlid;
                $course = Courses::create($data);

                if ($course->id) {
                    $conditions = ['component' => 'BatchCourse', 'component_status' => 'created', 'raw_data' => serialize($value), 'inserted_data' => serialize($data), 'status' => 1];
                    MigrationLogs::create($conditions);
                }

                DB::commit();
                $response['errors'] = [];
                $response['has_errors'] = false;
                $this->imported[] = $response;
            } else {

                $conditions = ['component' => 'BatchCourse', 'component_status' => 'creation failed', 'raw_data' => serialize($value), 'inserted_data' => serialize($data), 'status' => 0];
                MigrationLogs::create($conditions);
                
                DB::rollback();
                $response['errors'] = ['0' => 'Course is not created in LMS', '1' => $lmsresponse];
                $response['has_errors'] = true;
                $this->imported[] = $response;
            }
        }
    }

    public function validate($data)
    {
        $validator = Validator::make($data, [
            'old_id' => 'required',
            'subject_code' => 'required|exists:hierarchies,code',
            'name' => 'required',
            'code' => 'required',
        ]);

        return $validator;
    }

    public function rules(): array
    {
        return [
            '*.old_id' => 'required',
            '*.subject_code' => 'required|exists:hierarchies,code',
            '*.name' => 'required',
            '*.code' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'old_id.required' => 'Old Id is required',
            'subject_code.required' => 'Subject Code is Required',
            'name.required' => 'Name is required',
            'code.required' => 'Code is required',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the exception how you'd like.
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }
}
