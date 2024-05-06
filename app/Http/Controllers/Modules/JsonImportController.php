<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\JsonUpload\CreateJsonUploadRequest;

class JsonImportController extends Controller
{
    public function store(CreateJsonUploadRequest $request)
    {
        $fileName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);
        $path = public_path('upload').'/'.$fileName;
        $class = $request->get('component');
        $json = \File::json($path);
        $import = new $class();
        $import->import($json);

        return $import->import($json);
    }
}
