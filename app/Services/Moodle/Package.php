<?php

namespace App\Services\Moodle;

use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Hierarchy;
use App\Services\Content\BatchCourse;
use App\Models\DataMigrations\TempMmPackages;

class Package extends MoodleService
{
    public function create_package($package)
    {
        $courses = $package->courses->map(function ($course) {
            return $course->course->mdl_id;
        })->join(',');

        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'local_packagecreation',
            'moodlewsrestformat' => 'json',
            'goalid' => $package->goal->mdl_id,
            'boardid' => $package->board->mdl_id,
            'classid' => $package->classes->mdl_id,
            'packageid' => $package->id,
            'name' => $package->title,
            'code' => $package->code,
            'description' => !empty($package->description) ? $package->description : null,
            'imageurl' => !empty($package->thumbnail->url) ? $package->thumbnail->url : null,
            'startdate' => $package->valid_from,
            'enddate' => $package->valid_to,
            'package_type' => $package->package_type,
            'validity_type' => $package->validity_type,
            'validity' => $package->valid_for,
            'courses' => ($package->package_type_name == 'course') ? (($courses) ? $courses : '') : '',
        ];

        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = $this->make_request('POST', $payload);

        if ($response['success']) {
            return $response['data'];
        }

        return false;
    }

    public function destroy_package($code, $type)
    {
        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'local_package_deletepackage',
            'moodlewsrestformat' => 'json',
            'code' => $code,
            'type' => $type,
        ];
        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = $this->make_request('POST', $payload);

        if ($response['success']) {
            return $response['data'];
        }

        return false;
    }

    public function create_batch($batch)
    {
        $package = Packages::where('id', $batch['package_id'])->get();

        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'local_package_createorupdate_batch',
            'moodlewsrestformat' => 'json',
            'goalid' => $batch->package->goal->mdl_id,
            'boardid' => $batch->package->board->mdl_id,
            'classid' => $batch->package->classes->mdl_id,
            'batchid' => $batch->id,
            'name' => $batch->name,
            'code' => $batch->code,
            'packageid' => $batch->package->id,
            'packagecode' => $batch->package->code,
            'packagetype' => $batch->package->package_type,
            'startdate' => $batch->batch_start_date,
            'enddate' => $batch->batch_end_date,
            'duration' => $batch->duration,
            'studentlimit' => $batch->student_limit,
            'provider' => $batch->batch_provider_id,
            'courses' => ($batch->hierarchy_id > 0) ? $batch->hierarchy->mdl_id : 0,
        ];
        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = $this->make_request('POST', $payload);

        if ($response['success']) {
            $batchcourse = new BatchCourse();

            $batchcourse->create_course($batch, $response['data']);

            return $response['data'];
        }

        return false;
    }

    public function create_batchcourse($data)
    {
        $parentcourseid = Hierarchy::where('code', $data['subject_code'])->value('mdl_id');
        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'local_package_create_batchcourse',
            'moodlewsrestformat' => 'json',
            'old_id' => $data['old_id'],
            'subject_code' => $data['subject_code'],
            'package_code' => $data['package_code'],
            'parentcourseid' => $parentcourseid,
            'name' => $data['name'],
            'code' => $data['code'],
            'description' => !empty($data['description']) ? $data['description'] : null,
            'thumbnail' => !empty($data['thumbnail']) ? $data['thumbnail'] : null,
        ];
        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = $this->make_request('POST', $payload);

        if ($response['success']) {
            return $response['data'];
        }

        return false;
    }

    public function create_migration_batch($batch)
    {
        $package = Packages::where('id', $batch['package_id'])->get();
        if ($batch->hierarchy_id > 0) {
            $mcourseid = TempMmPackages::where(['packageid' => $batch['package_id'], 'subjectid' => $batch->hierarchy_id])->value('mastercourseid');
        }

        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'local_package_createorupdate_batch',
            'moodlewsrestformat' => 'json',
            'old_id' => $batch->old_id,
            'goalid' => $batch->package->goal->mdl_id,
            'boardid' => $batch->package->board->mdl_id,
            'classid' => $batch->package->classes->mdl_id,
            'batchid' => $batch->id,
            'name' => $batch->name,
            'code' => $batch->code,
            'packageid' => $batch->package->id,
            'packagecode' => $batch->package->code,
            'packagetype' => $batch->package->package_type,
            'startdate' => $batch->batch_start_date,
            'enddate' => $batch->batch_end_date,
            'duration' => $batch->duration,
            'studentlimit' => $batch->student_limit,
            'provider' => $batch->batch_provider_id,
            'courses' => ($batch->hierarchy_id > 0) ? $batch->hierarchy->mdl_id : 0,
        ];
        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = $this->make_request('POST', $payload);

        if ($response['success']) {
            $batchcourse = new BatchCourse();

            $batchcourse->create_course($batch, $response['data']);

            return $response['data'];
        }

        return false;
    }
}
