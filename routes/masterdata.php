<?php

use App\Http\Controllers\MasterData\AgentsController;
use App\Http\Controllers\MasterData\CategoriesController;
use App\Http\Controllers\MasterData\ClonedCoursesController;
use App\Http\Controllers\MasterData\CollegesController;
use App\Http\Controllers\MasterData\CountryCodeController;
use App\Http\Controllers\MasterData\CourseController;
use App\Http\Controllers\MasterData\FaqController;
use App\Http\Controllers\MasterData\HierarchyController;
use App\Http\Controllers\MasterData\SchoolsController;
use App\Http\Controllers\MasterData\TestimonialController;
use App\Http\Controllers\MasterData\UniversitiesController;
use Illuminate\Support\Facades\Route;

Route::prefix('masterdata')->name('masterdata.')->middleware(['auth', '2fa'])->group(function () {
    Route::prefix('colleges')->name('colleges.')->group(function () {
        Route::get('/', [CollegesController::class, 'index'])->name('index');
        Route::post('/results', [CollegesController::class, 'results'])->name('results');
        Route::get('/create', [CollegesController::class, 'create'])->name('create');
        Route::post('/store', [CollegesController::class, 'store'])->name('store');
        Route::get('{college}/show', [CollegesController::class, 'show'])->name('show');
        Route::get('{college}/edit', [CollegesController::class, 'edit'])->name('edit');
        Route::put('{college}/update', [CollegesController::class, 'update'])->name('update');
        Route::delete('{college}/destroy', [CollegesController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('schools')->name('schools.')->group(function () {
        Route::get('/', [SchoolsController::class, 'index'])->name('index');
        Route::post('/results', [SchoolsController::class, 'results'])->name('results');
        Route::get('/create', [SchoolsController::class, 'create'])->name('create');
        Route::post('/store', [SchoolsController::class, 'store'])->name('store');
        Route::get('{school}/edit', [SchoolsController::class, 'edit'])->name('edit');
        Route::put('{school}/update', [SchoolsController::class, 'update'])->name('update');
        Route::delete('{school}/destroy', [SchoolsController::class, 'destroy'])->name('destroy');
        Route::get('{school}/show', [SchoolsController::class, 'show'])->name('show');
    });

    Route::prefix('universities')->name('universities.')->group(function () {
        Route::get('/create', [UniversitiesController::class, 'create'])->name('create');
        Route::post('/store', [UniversitiesController::class, 'store'])->name('store');
        Route::get('/', [UniversitiesController::class, 'index'])->name('index');
        Route::post('/results', [UniversitiesController::class, 'results'])->name('results');
        Route::get('{universities}/edit', [UniversitiesController::class, 'edit'])->name('edit');
        Route::put('{universities}/update', [UniversitiesController::class, 'update'])->name('update');
        Route::delete('{universities}/destroy', [UniversitiesController::class, 'destroy'])->name('destroy');
        Route::get('{universities}/show', [UniversitiesController::class, 'show'])->name('show');
    });

    Route::prefix('agents')->name('agents.')->group(function () {
        Route::get('/', [AgentsController::class, 'index'])->name('index');
        Route::post('/results', [AgentsController::class, 'results'])->name('results');
        Route::get('/create', [AgentsController::class, 'create'])->name('create');
        Route::post('/store', [AgentsController::class, 'store'])->name('store');
        Route::get('{agent}/edit', [AgentsController::class, 'edit'])->name('edit');
        Route::put('{agent}/update', [AgentsController::class, 'update'])->name('update');
        Route::delete('{agent}/destroy', [AgentsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::prefix('{taxonomy}')->name('{taxonomy}.')->group(function () {
            Route::get('/', [CategoriesController::class, 'index'])->name('index');
            Route::post('/results', [CategoriesController::class, 'results'])->name('results');
            Route::get('/list', [CategoriesController::class, 'list'])->name('list');
            Route::get('/create', [CategoriesController::class, 'create'])->name('create');
            Route::post('/store', [CategoriesController::class, 'store'])->name('store');
            Route::get('/{category}/edit', [CategoriesController::class, 'edit'])->name('edit');
            Route::put('/{category}/update', [CategoriesController::class, 'update'])->name('update');
            Route::delete('/{category}/destroy', [CategoriesController::class, 'destroy'])->name('destroy');
            Route::get('/{category}/existingcategory', [CategoriesController::class, 'existingcategory'])->name('existingcategory');
        });
    });

    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/create', [FaqController::class, 'create'])->name('create');
        Route::post('/store', [FaqController::class, 'store'])->name('store');
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::post('/results', [FaqController::class, 'results'])->name('results');
        Route::get('{faq}/edit', [FaqController::class, 'edit'])->name('edit');
        Route::put('{faq}/update', [FaqController::class, 'update'])->name('update');
        Route::delete('{faq}/destroy', [FaqController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('testimonials')->name('testimonials.')->group(function () {
        Route::get('/', [TestimonialController::class, 'index'])->name('index');
        Route::post('/results', [TestimonialController::class, 'results'])->name('results');
        Route::get('/create', [TestimonialController::class, 'create'])->name('create');
        Route::post('/store', [TestimonialController::class, 'store'])->name('store');
        Route::get('{testimonial}/edit', [TestimonialController::class, 'edit'])->name('edit');
        Route::put('{testimonial}/update', [TestimonialController::class, 'update'])->name('update');
        Route::delete('{testimonial}/destroy', [TestimonialController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('countrycode')->name('countrycode.')->group(function () {
        Route::get('/', [CountryCodeController::class, 'index'])->name('index');
        Route::post('/results', [CountryCodeController::class, 'results'])->name('results');
        Route::get('/create', [CountryCodeController::class, 'create'])->name('create');
        Route::post('/store', [CountryCodeController::class, 'store'])->name('store');
        Route::get('{countrycode}/edit', [CountryCodeController::class, 'edit'])->name('edit');
        Route::put('{countrycode}/update', [CountryCodeController::class, 'update'])->name('update');
        Route::delete('{countrycode}/destroy', [CountryCodeController::class, 'destroy'])->name('destroy');
        Route::get('/{countrycode}/existingcode', [CountryCodeController::class, 'existingcode'])->name('existingcode');
    });

    Route::prefix('hierarchy')->name('hierarchy.')->group(function () {
        Route::get('/', [HierarchyController::class, 'index'])->name('index');
        Route::post('/results', [HierarchyController::class, 'results'])->name('results');
        Route::post('/store', [HierarchyController::class, 'store'])->name('store');
        Route::get('{hierarchy}/children', [HierarchyController::class, 'children'])->name('children');
        Route::get('{hierarchy}/edit', [HierarchyController::class, 'edit'])->name('edit');
        Route::post('{hierarchy}/update', [HierarchyController::class, 'update'])->name('update');
        Route::delete('{hierarchy}/delete', [HierarchyController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::post('/results', [CourseController::class, 'results'])->name('results');
    });

    Route::prefix('cloned_courses')->name('cloned_courses.')->group(function () {
        Route::get('/', [ClonedCoursesController::class, 'index'])->name('index');
        Route::post('/results', [ClonedCoursesController::class, 'results'])->name('results');
    });
});
