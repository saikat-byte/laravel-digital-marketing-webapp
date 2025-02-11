<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\PageSettingController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontent\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Default Home Page (Root URL)
Route::get('/', function () {
    return redirect()->route('frontend.home', ['slug' => 'home']);
})->name('frontend.home');

// Frontend route
Route::get('/{slug}', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/service', [FrontendController::class, 'service'])->name('frontend.service');
Route::get('/case-studies', [FrontendController::class, 'caseStudies'])->name('frontend.case-studies');
Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/blog', [FrontendController::class, 'blog'])->name('frontend.blog');
Route::get('/single-blog/{id}', [FrontendController::class, 'singleBlog'])->name('frontend.single.blog');



// Admin dashboard
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('tag', TagController::class);
    Route::get('/get-subcategories/{id}', [SubCategoryController::class, 'getSubcategories']);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('post', PostController::class);

    // Pages
    Route::get('/pages', [PageController::class, 'index'])->name('page.index');
    Route::get('/page/create', [PageController::class, 'create'])->name('page.create');
    Route::post('/page', [PageController::class, 'store'])->name('page.store');
    Route::get('/page/{page}/edit', [PageController::class, 'edit'])->name('page.edit');
    Route::put('/page/{page}', [PageController::class, 'update'])->name('page.update');
    Route::delete('/page/{id}/soft-delete', [PageController::class, 'destroy'])->name('page.soft-delete');
    Route::get('/page/{id}/restore', [PageController::class, 'restore'])->name('page.restore');
    Route::delete('/page/{id}/force-delete', [PageController::class, 'forceDelete'])->name('page.force-delete');

    // Page Sections
    Route::post('/page/{page}/sections', [PageSectionController::class, 'store'])->name('page.sections.store');
    Route::put('/page/sections/{section}', [PageSectionController::class, 'update'])->name('page.sections.update');
    // drag and drop
    Route::post('/page/sections/order', [PageSectionController::class, 'updateOrder'])->name('page.sections.order');
    // Section Soft Delete
    Route::delete('/page/sections/{id}/soft-delete', [PageSectionController::class, 'softDelete'])->name('page.sections.soft-delete');
    // Section Restore
    Route::get('/page/sections/{id}/restore', [PageSectionController::class, 'restore'])->name('page.sections.restore');
    // Section Permanent Delete
    Route::delete('/page/sections/{id}/force-delete', [PageSectionController::class, 'forceDelete'])->name('page.sections.force-delete');

    Route::post('/page/sections/{section}/delete-image', [PageSectionController::class, 'deleteImage'])->name('page.sections.delete-image');
    Route::post('/page/{page}/toggle-status', [PageController::class, 'toggleStatus'])->name('pages.toggle-status');

    // Page section Settings
    Route::get('/page/sections/{section}/edit', [PageSectionController::class, 'edit'])->name('page.sections.edit');
    Route::post('/page/sections/{section}/store-content', [PageSectionController::class, 'edit'])->name('page.sections.storeContent');
    Route::put('/page/sections/{section}/update-content', [PageSectionController::class, 'updateContent'])->name('page.sections.updateContent');
    Route::post('/page-sections/{section}/toggle-status', [PageSectionController::class, 'toggleStatus'])->name('page.sections.toggle-status');

    // drag and drop
    Route::post('page/sections/reorder', [PageSectionController::class, 'reorder'])->name('page.sections.reorder');

    // toggle visibility
    Route::post('sections/{section}/toggle-visibility', [PageSectionController::class, 'toggleVisibility'])
        ->name('sections.toggle-visibility');


});


Route::get('/admin/dashboard', function () {
    return view('admin.modules.dashboard');
})->name('admin.dashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
