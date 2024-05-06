<?php

namespace App\Http\Controllers\Website\PageBuilder;

use App\Http\Controllers\Controller;
use App\Models\Website\PageBuilder\PageComponentType;
use Illuminate\Http\Request;

class ComponentsController extends Controller
{
    public function index(PageComponentType $component, Request $request)
    {
        $class = $component->service;
        if ($class && class_exists($class)) {
            $service = new $class();

            return $service->index($request);
        }
    }

    public function create(PageComponentType $component, Request $request)
    {
        $class = $component->service;
        if ($class && class_exists($class)) {
            $service = new $class();

            return $service->create($request);
        }
    }

    public function show(PageComponentType $component, Request $request)
    {
        $class = $component->service;
        // dd($class);
        if ($class && class_exists($class)) {
            $service = new $class();

            return $service->show($request);
        }
    }

    public function download(PageComponentType $component, Request $request)
    {
        $class = $component->service;
        if ($class && class_exists($class)) {
            $service = new $class();

            return $service->download($request);
        }
    }
}
