<?php

namespace App\Imports\DataMigrations;

use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Hierarchy;
use App\Models\Modules\Media;
use App\Services\FileUploadService;
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
use Illuminate\Support\Facades\DB;
use App\Models\DataMigrations\MigrationLogs;

class PackageMigration implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable;
    use SkipsFailures;
    public $startRow;

    public $imported = [];

    public $failed_imports = [];

    public $service;

    public $old_id;

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
        foreach ($collection as $row => $value) {
            $parent_id = Hierarchy::where('code', $value['class_code'])->value('id');
            $response = [];
            $excel_row = $this->startRow + $row + 1;
            $response['row'] = $excel_row;
            $exists = Packages::where('old_id', $value['old_id'])->first();
            $data = [
                'old_id' => $value['old_id'],
                'goal_id' => Hierarchy::where('code', $value['goal_code'])->value('id'),
                'board_id' => Hierarchy::where('code', $value['board_code'])->value('id'),
                'class_id' => Hierarchy::where('code', $value['class_code'])->value('id'),
                'goal_code' => $value['goal_code'],
                'board_code' => $value['board_code'],
                'class_code' => $value['class_code'],
                'courses' => $value['courses'],
                'validity_type' => $value['validity_type'],
                'valid_for' => $value['validity_type_value'],
                'thumbnail_id' => $value['thumbnail'],
                'title' => $value['title'],
                'code' => $value['code'],
                'description' => !empty($value['description']) ? $value['description'] : null,
                'valid_from' => $value['valid_from'],
                'valid_to' => $value['valid_to'],
                'enrollment_start_date' => $value['valid_from'],
                'enrollment_end_date' => $value['valid_to'],
                'package_type' => $value['package_type'],
                'is_paid' => !empty($value['payment_type']) ? $value['payment_type'] : 1,
                'trial_duration' => !empty($value['is_trial_available']) ? $value['is_trial_available'] : 0,
                'is_published' => !empty($value['is_published']) ? $value['is_published'] : 0,
                'created_at' => !empty($value['created_at']) ? $value['created_at'] : time(),
                'updated_at' => !empty($value['updated_at']) ? $value['updated_at'] : time(),
                'created_by' => !empty($value['created_by']) ? $value['created_by'] : 1,
                'updated_by' => !empty($value['updated_by']) ? $value['updated_by'] : 1,
            ];

            $validator = Validator::make($value->toArray(), [
                'old_id' => 'required',
                'goal_code' => 'required|exists:hierarchies,code',
                'board_code' => 'required|exists:hierarchies,code',
                'class_code' => 'required|exists:hierarchies,code',
                'title' => 'required',
                'code' => 'required|unique:packages,code,'. $value['old_id'] .',old_id',
                'thumbnail' => 'required',
            ]);
            $response['values'] = $data;
            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }

            if (!$exists) {
                $service = new FileUploadService('packages');
                $file = $service->upload_from_url($value['thumbnail']);
                if ($file) {
                    $media = Media::create([
                        'url' => $file['url'],
                        'name' => $file['name'],
                        'title' => $file['title'],
                        'component' => 'packages',
                        'size' => $file['size'],
                        'type' => $file['type'],
                        'extension' => $file['extension'],
                    ]);
                    $data['thumbnail_id'] = $media->id;
                }
                $package = Packages::create($data);

                $conditions = ['component' => 'Packages', 'component_status' => 'created', 'raw_data' => serialize($value), 'inserted_data' => serialize($data), 'status' => 1];
                MigrationLogs::create($conditions);

                $courses = [];
                if ($package->package_type == 1) {
                    $hierarchy = Hierarchy::create([
                        'title' => $package->title,
                        'code' => uniqid(),
                        'parent_id' => $package->class_id,
                        'depth' => 3,
                        'type_id' => 5,
                    ]);
                    $courses[] = [
                        'course_id' => $hierarchy->id,
                    ];
                } else {
                    $subjectcourses = explode('|', $data['courses']);
                    $oldid = $value['old_id'];
                    foreach($subjectcourses as $course){
                        $actualcourseid = TempMmPackages::where(['packageid' => $oldid, 'subjectid' => $course])->value('mastercourseid');
                        $actualcourse = Hierarchy::where('old_id', $actualcourseid)->value('id');
                        if($actualcourse){
                            $courses[] = [
                                'course_id' => $actualcourse
                            ];
                        }
                    }
                }
                $package->courses()->createUpdateOrDelete($courses);
                $mdl_id = $this->service->create_package($package);
                if ($mdl_id) {
                    $response['errors'] = [];
                    $response['has_errors'] = false;
                    $this->imported[] = $response;
                }
            } else {
                $service = new FileUploadService('packages');
                $file = $service->upload_from_url($value['thumbnail']);
                if ($file) {
                    $media = Media::create([
                        'url' => $file['url'],
                        'name' => $file['name'],
                        'title' => $file['title'],
                        'component' => 'packages',
                        'size' => $file['size'],
                        'type' => $file['type'],
                        'extension' => $file['extension'],
                    ]);
                    $data['thumbnail_id'] = $media->id;
                }
                $package = $exists->updateOrCreate(['code' => $data['code']], $data);

                $response['errors'] = [];
                $response['has_errors'] = false;
                $this->imported[] = $response;

                $conditions = ['component' => 'Packages', 'component_status' => 'updated', 'raw_data' => serialize($value), 'inserted_data' => serialize($data), 'status' => 1];
                MigrationLogs::create($conditions);
            }
        }
    }

    public function validate($data)
    {
        $validator = Validator::make($data, [
            'old_id' => 'required',
            'goal_code' => 'required|exists:hierarchies,code',
            'board_code' => 'required|exists:hierarchies,code',
            'class_code' => 'required|exists:hierarchies,code',
            'title' => 'required',
            'code' => 'required|unique:packages,code,'. $data['old_id'] .',old_id',
            'thumbnail' => 'required',
        ]);

        return $validator;
    }

    public function rules(): array
    {
        return [
            '*.old_id' => 'required',
            '*.code' => 'required',
            '*.goal_code' => 'required|exists:hierarchies,code',
            '*.board_code' => 'required|exists:hierarchies,code',
            '*.class_code' => 'required|exists:hierarchies,code',
            '*.title' => 'required',
            '*.thumbnail' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'old_id.required' => 'Old Id is required',
            'title.required' => 'Title is required',
            'code.required' => 'Code is required',
            'goal_code.required' => 'Goal Code is required',
            'board_code.required' => 'Board Code is required',
            'class_code.required' => 'Class Code is required',
            'thumbnail.required' => 'Thumbnail is required',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the exception how you'd like.
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }
}
