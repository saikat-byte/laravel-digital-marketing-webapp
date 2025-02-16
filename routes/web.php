<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommonSectionController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\UserAuthController;
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

// Default Home Page
Route::get('/', function () {
    return redirect()->route('frontend.page.show', ['slug' => 'home']);
})->name('frontend.page.show');

// Frontend route
Route::get('/{slug}', [FrontendPageController::class, 'show'])->name('frontend.page.show');
// Blog
Route::get('/blog/posts', [BlogController::class, 'index'])->name('frontend.blog.index');
Route::get('/blog/search', [BlogController::class, 'search'])->name('frontend.blog.search');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('frontend.blog.show');
Route::get('/blog/single/search', [BlogController::class, 'singleSearch'])->name('frontend.singleblog.search');
// comment
Route::post('/comment/{postId}', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');


// User authentication routes
Route::get('/user/register', [UserAuthController::class, 'showRegistrationForm'])->name('user.registration'); // login page route
Route::post('/user/register', [UserAuthController::class, 'registerStore'])->name('user.register.store');
Route::get('/user/login', [UserAuthController::class, 'showLoginForm'])->name('user.login'); // login page route
Route::post('/user/login', [UserAuthController::class, 'loginStore'])->name('user.login.store'); // login page route



// Admin dashboard
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    /*========== Post ==========*/
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('tag', TagController::class);
    Route::get('/get-subcategories/{id}', [SubCategoryController::class, 'getSubcategories']);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('post', PostController::class);

    /*========== Pages==========*/
    Route::get('/pages', [PageController::class, 'index'])->name('page.index');
    Route::get('/page/create', [PageController::class, 'create'])->name('page.create');
    Route::post('/page', [PageController::class, 'store'])->name('page.store');
    Route::get('/page/{page}/edit', [PageController::class, 'edit'])->name('page.edit');
    Route::put('/page/{page}', [PageController::class, 'update'])->name('page.update');
    Route::delete('/page/{id}/soft-delete', [PageController::class, 'destroy'])->name('page.soft-delete');
    Route::get('/page/{id}/restore', [PageController::class, 'restore'])->name('page.restore');
    Route::delete('/page/{id}/force-delete', [PageController::class, 'forceDelete'])->name('page.force-delete');
    Route::post('/pages/update-order', [PageController::class, 'updateOrder'])->name('pages.updateOrder');

    /*========== Page Sections==========*/
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


    /*========== Page section Settings==========*/
    Route::get('/page/sections/{section}/edit', [PageSectionController::class, 'edit'])->name('page.sections.edit');
    Route::post('/page/sections/{section}/store-content', [PageSectionController::class, 'edit'])->name('page.sections.storeContent');
    Route::put('/page/sections/{section}/update-content', [PageSectionController::class, 'updateContent'])->name('page.sections.updateContent');
    Route::post('/page-sections/{section}/toggle-status', [PageSectionController::class, 'toggleStatus'])->name('page.sections.toggle-status');

    // drag and drop
    Route::post('page/sections/reorder', [PageSectionController::class, 'reorder'])->name('page.sections.reorder');
    // toggle visibility
    Route::post('sections/{section}/toggle-visibility', [PageSectionController::class, 'toggleVisibility'])->name('sections.toggle-visibility');

    /*==========Common section route==========*/
    Route::get('common-sections', [CommonSectionController::class, 'index'])->name('common.section.index');
    Route::get('common-sections/create', [CommonSectionController::class, 'create'])->name('common.section.create');
    Route::post('common-sections', [CommonSectionController::class, 'store'])->name('common.section.store');
    Route::get('common-sections/{id}/edit', [CommonSectionController::class, 'edit'])->name('common.section.edit');
    Route::put('common-sections/{id}', [CommonSectionController::class, 'update'])->name('common.section.update');
    Route::delete('common-sections/{id}/soft-delete', [CommonSectionController::class, 'softDelete'])->name('common.section.soft-delete');
    Route::get('common-sections/{id}/restore', [CommonSectionController::class, 'restore'])->name('common.section.restore');
    Route::delete('common-sections/{id}/force-delete', [CommonSectionController::class, 'forceDelete'])->name('common.section.force-delete');
    Route::post('common-sections/{id}/toggle-status', [CommonSectionController::class, 'toggleStatus'])->name('common.section.toggle-status');

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
