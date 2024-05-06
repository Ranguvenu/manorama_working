<?php

namespace App\Http\Controllers\Ecommerce\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ecommerce\Api\PackagesResource;
use App\Models\Ecommerce\Packages;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $packages = Packages::filterBy($request->all())->latest()->paginate($perpage);

        return PackagesResource::collection($packages);
    }
}
