<?php

use App\Http\Controllers\Admin\AdminAppointmentController;
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
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\HeaderFooterController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Frontend\AppointmentController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\SubscriberController;
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

/*========== Frontend route ==========*/
Route::get('/{slug}', [FrontendPageController::class, 'show'])->name('frontend.page.show');
// Blog
Route::get('/blog/posts', [BlogController::class, 'index'])->name('frontend.blog.index');
Route::get('/blog/search', [BlogController::class, 'search'])->name('frontend.blog.search');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('frontend.blog.show');
Route::get('/blog/single/search', [BlogController::class, 'singleSearch'])->name('frontend.singleblog.search');
// comment
Route::post('/comment/{postId}', [CommentController::class, 'store'])
    ->name('comment.store')
    ->middleware('auth');

// User authentication routes
Route::get('/user/register', [UserAuthController::class, 'showRegistrationForm'])->name('user.registration'); // login page route
Route::post('/user/register', [UserAuthController::class, 'registerStore'])->name('user.register.store');
Route::get('/user/login', [UserAuthController::class, 'showLoginForm'])->name('user.login'); // login page route
Route::post('/user/login', [UserAuthController::class, 'loginStore'])->name('user.login.store'); // login page route
// Appointment booking form
Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointment.create');

// Appointment book (form submission)
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
// Subscription management
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscriber.store');


/*========== Admin dashboard ==========*/
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    /*========== Admin dashboard ==========*/
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    /*========== Admin Profile view and edit page ==========*/
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile/{id}', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    /*========== Users management ==========*/
    // Create User Form
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    // Store New User
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    // List Users
    Route::get('/users/list', [AdminUserController::class, 'index'])
        ->name('admin.users.index');
    // Edit User
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])
        ->name('admin.users.edit');
    // Update User
    Route::put('/users/{id}', [AdminUserController::class, 'update'])
        ->name('admin.users.update');
    // Delete User
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');


    /*========== Reviews manage by admin ==========*/
    Route::resource('reviews', ReviewController::class);


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

    // comment management
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('admin.comments.index');
    // Additional routes for updating status, deleting, etc.
    Route::patch('/comments/{id}/approve', [AdminCommentController::class, 'approve'])->name('admin.comments.approve');
    Route::delete('/comments/{id}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');


    /*==========Appointment management==========*/
    // appointment list
    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');

    // appointment status update (confirm, cancel, reschedule)
    Route::post('/appointments/{id}/update-status', [AdminAppointmentController::class, 'updateStatus'])->name('admin.appointments.updateStatus');
    // Appointment Edit route
    Route::get('/appointments/{id}/edit', [AdminAppointmentController::class, 'edit'])
        ->name('admin.appointments.edit');
    // Appointment Update  route (PUT method)
    Route::put('/appointments/{id}', [AdminAppointmentController::class, 'update'])
        ->name('admin.appointments.update');
    // Appointment Delete route
    Route::delete('/appointments/{id}', [AdminAppointmentController::class, 'destroy'])
        ->name('admin.appointments.destroy');

    // Holidays management routes
    Route::get('/holidays', [HolidayController::class, 'index'])->name('admin.holidays.index');
    Route::get('/holidays/create', [HolidayController::class, 'create'])->name('admin.holidays.create');
    Route::post('/holidays', [HolidayController::class, 'store'])->name('admin.holidays.store');
    Route::get('/holidays/{id}/edit', [HolidayController::class, 'edit'])->name('admin.holidays.edit');
    Route::put('/holidays/{id}', [HolidayController::class, 'update'])->name('admin.holidays.update');
    Route::delete('/holidays/{id}', [HolidayController::class, 'destroy'])->name('admin.holidays.destroy');


    // Subscription management for admin
    Route::get('/subscribers', [AdminSubscriberController::class, 'index'])->name('admin.subscribers.index');

    // Display header & footer management page
    Route::get('/header-footer', [HeaderFooterController::class, 'index'])->name('header_footer.index');
    Route::post('/header-footer/update', [HeaderFooterController::class, 'update'])->name('header_footer.update');
});


// Common routes for admin and moderator (moderator limited access)
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin_or_mod']], function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    /*========== Post ==========*/
    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
    Route::get('/get-subcategories/{id}', [SubCategoryController::class, 'getSubcategories']);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('tag', TagController::class);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
