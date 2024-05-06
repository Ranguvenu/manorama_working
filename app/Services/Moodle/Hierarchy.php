<?php

namespace App\Services\Moodle;

use App\Models\MasterData\Hierarchy as HierarchyModel;

class Hierarchy extends MoodleService
{
    public function create_hierarchy(HierarchyModel $hierarchy)
    {
        $tags = $hierarchy->tags ? explode(',', $hierarchy->tags) : [];

        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'local_goals_create_hierarchies',
            'old_id' => !empty($hierarchy->old_id) ? $hierarchy->old_id : 0,
            'id' => $hierarchy->mdl_id ? $hierarchy->mdl_id : 0,
            'type' => $hierarchy->type_name,
            'referenceid' => $hierarchy->parent ? $hierarchy->parent->mdl_id : 0,
            'name' => $hierarchy->title,
            'code' => $hierarchy->code,
            'image' => $hierarchy->image ? $hierarchy->image : null,
            'description' => $hierarchy->description ? $hierarchy->description : null,
            'tags' => base64_encode(serialize($tags)),
            'is_active' => !empty($hierarchy->is_active) ? $hierarchy->is_active : 1,
        ];
        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = $this->make_request('POST', $payload);

        if ($response['success']) {
            return $response['data']['id'];
        }

        return false;
    }

    public function delete_hierarchy(HierarchyModel $hierarchy)
    {
        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'local_goals_delete_hierarchies',
            'id' => $hierarchy->id ? $hierarchy->mdl_id : 0,
            'type' => $hierarchy->type_name,
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
}
