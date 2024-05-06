<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AutoCompleteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [AuthenticatedSessionController::class, 'create'])
// ->name('login');

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('subscriber')) {
        // return redirect('/home');
        if (auth()->user()->is_purchased_user()) {
            return redirect(route('integrations.lms'));
        }

        // return redirect('/home');
        return redirect(route('integrations.redirect'));
    }

    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', '2fa'])->name('dashboard');

// Route::get('/home', function () {
//     return Inertia::render('Home');
// })->middleware(['auth', 'verified'])->name('home');

// Route::get('/articles', function () {
//     return Inertia::render('Articles');
// });

// Route::get('/articledetails', function () {
//     return Inertia::render('ArticleDetails');
// })->middleware(['auth', 'verified'])->name('articledetails');

// Route::get('/aboutus', function () {
//     return Inertia::render('AboutUs');
// })->middleware(['auth', 'verified'])->name('aboutus');

// Route::get('/contactus', function () {
//     return Inertia::render('ContactUs');
// })->middleware(['auth', 'verified'])->name('contactus');

// Route::get('/career', function () {
//     return Inertia::render('Career');
// })->middleware(['auth', 'verified'])->name('career');

// Route::get('/privacypolicy', function () {
//     return Inertia::render('PrivacyPolicy');
// });

// Route::get('/tnc', function () {
//     return Inertia::render('TnC');
// });

// Route::get('/downloadresources', function () {
//     return Inertia::render('DownloadResources');
// });

// Route::get('/studymaterial', function () {
//     return Inertia::render('StudyMaterial');
// });

// Route::get('/studymaterialview', function () {
//     return Inertia::render('StudyMaterialView');
// });

// Route::get('/webinarview', function () {
//     return Inertia::render('WebinarView');
// });

// Route::get('/sitemap', function () {
//     return Inertia::render('Sitemap');
// });

// Route::get('/studyabroad', function () {
//     return Inertia::render('StudyAbroad');
// });

// Route::get('/productlist', function () {
//     return Inertia::render('ProductList');
// });
// Route::get('/productview', function () {
//     return Inertia::render('ProductView');
// });
// Route::get('/productviewoc', function () {
//     return Inertia::render('ProductViewOc');
// });
// Route::get('celist/', function () {
//     return Inertia::render('CEList');
// })->middleware(['auth', 'verified'])->name('celist');

// Route::get('ceview/', function () {
//     return Inertia::render('CEView');
// })->middleware(['auth', 'verified'])->name('ceview');
// Route::get('mclist/', function () {
//     return Inertia::render('MCList');
// });
// Route::get('mcview/', function () {
//     return Inertia::render('MCView');
// })->middleware(['auth', 'verified'])->name('mcview');
// Route::get('mocktest/', function () {
//     return Inertia::render('MockTest');
// })->middleware(['auth', 'verified'])->name('mocktest');
// Route::get('thankyou/', function () {
//     return Inertia::render('ThankYou');
// })->middleware(['auth', 'verified'])->name('thankyou');
// Route::get('page404/', function () {
//     return Inertia::render('Page404');
// })->middleware(['auth', 'verified'])->name('page404');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/{user}/complete', [ProfileController::class, 'complete'])->name('profile.complete');
});

Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('/', [SiteSettingsController::class, 'index'])->name('index');
    Route::post('/store', [SiteSettingsController::class, 'store'])->name('store');
    Route::post('/create', [SiteSettingsController::class, 'create'])->name('create');
});

Route::prefix('autocomplete')->name('autocomplete.')->group(function () {
    Route::post('users', [AutoCompleteController::class, 'users'])->name('users');
    Route::post('packages', [AutoCompleteController::class, 'packages'])->name('packages');
    Route::post('pages', [AutoCompleteController::class, 'pages'])->name('pages');
    Route::post('package/{package}/pricing', [AutoCompleteController::class, 'package_pricing'])->name('package.pricing');
    Route::post('package/{package}/batches', [AutoCompleteController::class, 'package_batches'])->name('package.batches');
    Route::post('package/{package}/courses', [AutoCompleteController::class, 'package_courses'])->name('package.courses');
    Route::post('hierarchy/goals', [AutoCompleteController::class, 'goals'])->name('hierarchy.goals');
    Route::post('coupons', [AutoCompleteController::class, 'coupons'])->name('coupons');
});

Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('registrations', [ReportsController::class, 'registrations'])->name('registrations');
    Route::get('batches', [ReportsController::class, 'batches'])->name('batches');
    Route::get('packages', [ReportsController::class, 'packages'])->name('packages');
    Route::get('enrolments', [ReportsController::class, 'enrolments'])->name('enrolments');
    Route::get('articles', [ReportsController::class, 'articles'])->name('articles');
    Route::get('currentaffairs', [ReportsController::class, 'currentaffairs'])->name('currentaffairs');
    Route::get('resources', [ReportsController::class, 'resources'])->name('resources');
    Route::get('orderscount', [ReportsController::class, 'orderscount'])->name('orderscount');
    Route::get('website_content', [ReportsController::class, 'website_content'])->name('website_content');
    Route::get('orders', [ReportsController::class, 'orders'])->name('orders');
    Route::prefix('summary')->name('summary.')->group(function () {
        Route::post('/users/{category:slug}', [SummaryController::class, 'users'])->name('users');
        Route::post('/leads/{category:slug}', [SummaryController::class, 'leads'])->name('leads');
        Route::post('/packages', [SummaryController::class, 'packages'])->name('packages');
        Route::post('/coupons', [SummaryController::class, 'coupons'])->name('coupons');
        Route::post('/transactions', [SummaryController::class, 'transactions'])->name('transactions');
    });
});

Route::prefix('user')->name('user.')->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [UserProfileController::class, 'index'])->name('index');
        Route::get('/edit', [UserProfileController::class, 'edit'])->name('edit');
        Route::put('{user}/update', [UserProfileController::class, 'update'])->name('update');
        Route::post('{user}/profileupdate', [UserProfileController::class, 'profileupdate'])->name('profileupdate');
    });
});

Route::get('/states/{country}', [ProfileController::class, 'getstates'])->name('getstates');

require __DIR__.'/auth.php';
require __DIR__.'/masterdata.php';
require __DIR__.'/website.php';
require __DIR__.'/usermanagement.php';
require __DIR__.'/leadmanagement.php';
require __DIR__.'/modules.php';
require __DIR__.'/content.php';
require __DIR__.'/integrations.php';
require __DIR__.'/careers.php';
require __DIR__.'/blog.php';
require __DIR__.'/notifications.php';
require __DIR__.'/ecommerce.php';
require __DIR__.'/frontend.php';
require __DIR__.'/webhooks.php';
require __DIR__.'/migrations.php';
