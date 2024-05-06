<?php

namespace App\Http\Controllers\Modules;

use App\Helpers\SiteSettings;
use App\Http\Controllers\Controller;
use App\Http\Resources\Modules\PackageResource;
use App\Models\Ecommerce\Packages;
use Illuminate\Http\Request;

class BlogSidebarController extends Controller
{
    public function index(Request $request)
    {
        $settings = new SiteSettings();
        $sidebar = $settings->blog_sidebar();
        $response = [];
        foreach ($sidebar as $key => $value) {
            $filters = [
                'goal' => $value['value'],
            ];
            $elements = Packages::active()->filterBy($filters)->latest()->take($value['limit'])->get();
            $response[$key] = $value;
            $response[$key]['elements'] = PackageResource::collection($elements);
        }

        return $response;
    }
}
