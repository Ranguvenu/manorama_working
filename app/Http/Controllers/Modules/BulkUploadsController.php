<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\BulkUpload\CreateBulkUploadRequest;

class BulkUploadsController extends Controller
{
    public function store(CreateBulkUploadRequest $request)
    {
        $fileName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);
        $path = public_path('upload').'/'.$fileName;
        $class = $request->get('component');
        try {
            $import = new $class();
            $import->import($path);
            $data = $this->format_error_data($import->failed_imports) + $this->format_imported_data($import->imported);
            $total = sizeof($data);
            $completed = sizeof($import->imported);

            return response()->json([
                'data' => $data,
                'counts' => [
                    'total' => $total,
                    'completed' => $completed,
                    'errors' => ($total - $completed),
                ],
            ], 200);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[$failure->row()][$failure->attribute()] = $failure->errors()[0];
            }

            return response()->json([
                'errors' => $errors,
            ], 422);
        }
    }

    public function format_error_data($data)
    {
        $response = [];
        foreach ($data as $key => $value) {
            $response[$value->row()]['has_errors'] = true;
            $response[$value->row()]['row'] = $value->row();
            $response[$value->row()]['values'] = $value->values();
            $response[$value->row()]['errors'][$value->attribute()] = $value->errors();
        }

        return $response;
    }

    public function format_imported_data($data)
    {
        $response = [];
        foreach ($data as $key => $value) {
            $response[$value['row']]['has_errors'] = $value['has_errors'];
            $response[$value['row']]['row'] = $value['row'];
            $response[$value['row']]['values'] = $value['values'];
            $response[$value['row']]['errors'] = $value['errors'];
        }

        return $response;
    }
}
