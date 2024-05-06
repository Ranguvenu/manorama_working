<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\ArticleResource;
use App\Http\Resources\Content\StudyMaterialResource;
use App\Http\Resources\Content\WebinarsResource;
use App\Http\Resources\Website\PageResource;
use App\Meta;
use App\Models\Content\Courses;
use App\Models\Content\StudyMaterial;
use App\Models\Content\Webinar;
use App\Models\MasterData\Category;
use App\Models\Website\PageBuilder\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FrontendPagesController extends Controller
{
    public function results(Page $page)
    {
        return $page->configuration;
    }

    public function index(Page $page, Request $request)
    {
        $user = \Auth::user();
        if ($page->status == 0) {
            if (!($user && $user->hasPermissionTo('design-website-pages'))) {
                abort('404');
            }
        }

        if ($page && $page->seo_configuration) {
            foreach ($page->seo_configuration as $key => $value) {
                if (is_array($value)) {
                    $value = implode(',', $value);
                } else {
                    $value = $value;
                }
                Meta::addMeta($key, $value, $request->fullUrl());
            }
        }

        return Inertia::render('Website/index', ['page' => $page, 'elements' => $page->configuration]);
    }

    public function package($type, Page $page)
    {
        $user = \Auth::user();
        if ($page->status == 0) {
            if (!($user && $user->hasPermissionTo('design-website-pages'))) {
                abort('404');
            }
        }

        if ($page && $page->seo_configuration) {
            foreach ($page->seo_configuration as $key => $value) {
                if (is_array($value)) {
                    $value = implode(',', $value);
                } else {
                    $value = $value;
                }
                Meta::addMeta($key, $value);
            }
        }

        return Inertia::render('Website/index', ['page' => $page, 'elements' => $page->configuration]);
    }

    public function lms_package($type, Courses $course)
    {
        $package = $course->batch ? $course->batch->package : '';
        if ($package) {
            $page = $package->pages;
            if ($page) {
                return redirect()->to(route('frontend.package', ['type' => $type, 'page' => $page->slug]));
            }
        }
        abort('404');
    }

    public function search(Request $request)
    {
        $filters = [
            'search' => $request->get('search'),
        ];

        $webinars = Webinar::filterBy($filters)->take(8)->get();
        $pages = Page::published()->filterBy($filters)->where('page_type', 'package')->get();
        $articles = Category::where('slug', 'article')->first();
        $currentaffairs = Category::where('slug', 'current-affair')->first();
        $studymaterials = StudyMaterial::active()->filterBy($filters)->get();

        return Inertia::render('Website/Search/index', [
            'term' => $request->get('search'),
            'results' => [
                'pages' => PageResource::collection($pages),
                'webinars' => WebinarsResource::collection($webinars),
                'articles' => ArticleResource::collection($articles->blogs()->published()->filterBy($filters)->latest()->take(8)->get()),
                'currentaffairs' => ArticleResource::collection($currentaffairs->blogs()->published()->filterBy($filters)->latest()->take(8)->get()),
                'studymaterials' => StudyMaterialResource::collection($studymaterials),
            ],
        ]);
    }
}
