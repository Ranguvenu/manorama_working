<?php

namespace App\Services\Content;

use App\Models\Content\Courses;

class BatchCourse
{
    public function create_course($batch, $clonedcourses)
    {
        foreach ($clonedcourses as $clonecourse) {
            $create = Courses::create([
                'mdl_id' => $clonecourse['id'],
                'hierarchy_id' => ($batch->hierarchy_id) ? $batch->hierarchy_id : 0,
                'name' => $clonecourse['fullname'],
                'code' => $clonecourse['shortname'],
                'parent_mdl_id' => $clonecourse['parentcourseid'],
                'description' => !empty($clonecourse['description']) ? $clonecourse['description'] : null,
                'thumbnail' => !empty($clonecourse['logo']) ? $clonecourse['logo'] : null,
            ]);
            $batch->course_id = $create->id;
            $batch->save();
        }

        return true;
    }
}
