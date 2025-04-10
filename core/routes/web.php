<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\MicrosoftAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\DetailLoginController;
use App\Http\Controllers\MicrosoftController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\ProfileController;

Route::group(['middleware' => 'web'], function () {
    // Rute-rute Anda di sini
});

Route::get('/microsoft/login', [MicrosoftController::class, 'index'])->name('microsoft.login');
Route::get('/microsoft/authorized', [MicrosoftController::class, 'authorized'])->name('microsoft.authorized');

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk tampilan login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk submit login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Rute untuk tampilan register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

// Rute untuk submit register
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Rute untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk login dan register google
Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// fitur forgot password
Route::get('/forgot-password', [ForgotController::class, 'showForgotPasswordForm'])->name('forgot.password.form');
Route::get('/forgot-password/check-email', [ForgotController::class, 'checkEmail'])->name('forgot.password.check');
Route::post('/forgot-password/reset', [ForgotController::class, 'resetPassword'])->name('forgot.password.reset');

// Rute untuk home dan filter
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('detail/{dashboard_name}', [HomeController::class, 'showDetail'])->name('detail');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::post('/filter/category', [SearchController::class, 'filterByCategory'])->name('filter.category');
Route::get('/filter-category', [SearchController::class, 'filterByCategoryView'])->name('filterByCategoryView');

// Rute untuk content management
Route::get('/content-dashboard', [ContentController::class, 'dashboard'])->name('content-dashboard');
Route::get('/content-dashboard-add', [ContentController::class, 'dashboardAdd'])->name('content-dashboard-add');
Route::post('/dashboard-create', [ContentController::class, 'dashboardStore'])->name('dashboard-create');
Route::delete('/dashboard/{dashboard_id}', [ContentController::class, 'dashboardDestroy'])->name('dashboard.destroy');
Route::get('/dashboard/{id}/edit', [ContentController::class, 'dashboardEdit'])->name('content-dashboard-edit');
Route::put('/dashboard/{id}', [ContentController::class, 'dashboardUpdate'])->name('content-dashboard-update');
Route::post('/truncate_table', [ContentController::class, 'truncateTable'])->name('truncate_table');

// rute Service Interruption
Route::get('/service-interruption', [ContentController::class, 'serviceInterruption'])->name('service-interruption');
Route::post('/change-status', [ContentController::class, 'changeStatus'])->name('change-status');

// Rute untuk category
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Rute untuk permission management
Route::get('/permission', [PermissionController::class, 'index'])->name('permission');
Route::post('/permission', [PermissionController::class, 'store'])->name('permissions.submit');
Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
Route::post('/permission-request', [RequestController::class, 'storePermissionRequest'])->name('permissions.request');
Route::get('/approve-permission-request/{requestId}', [PermissionController::class, 'approvePermissionRequest'])->name('approve.permission.request');
Route::get('/approve/permission/reject/{requestId}', [PermissionController::class, 'rejectPermissionRequest'])->name('reject.permission.request');
Route::get('/permissions/get-data-by-name/{name}', [PermissionController::class, 'getDataByName'])->name('permissions.get-data-by-name');
Route::get('/get-permissions/{id}', [PermissionController::class, 'getPermissions'])->name('get.permissions');
Route::post('/updatePermission', [PermissionController::class, 'updatePermission'])->name('updatePermission');
Route::post('/approving', [PermissionController::class, 'approveAllRequests'])->name('approving');

// rute untuk recent login
Route::get('/settings', [DetailLoginController::class, 'index'])->name('settings');

// rute user management recipient
Route::get('/user-management', [UserController::class, 'index'])->name('user-management');
Route::get('/add-recipient', [UserController::class, 'add_recepient'])->name('add-recipient');
Route::get('/search-recipients', [UserController::class, 'searchRecipientDetails'])->name('search-recipients');
Route::get('/dashboard/{id}/recipients', [UserController::class, 'showRecipients'])->name('dashboard.recipients');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::post('/upload-recipients', [UserController::class, 'upload'])->name('upload-recipients');
Route::get('/recipient_dashboards/{recipient_id}', [UserController::class, 'showRecipientDashboards'])->name('recipient_dashboards');

// rute user management dashboards
Route::get('/add-dashboards', [UserController::class, 'add_dashboards'])->name('add-dashboards');
Route::post('/create-dashboards', [UserController::class, 'storeDashboards'])->name('create-dashboards');
Route::post('/change-statuss/{id}', [UserController::class, 'changeStatus'])->name('change-statuss');
Route::post('/update-status/{dashboardId}/{recipientsId}', [UserController::class, 'updateStatus'])->name('update-status');
Route::get('/callback', [MicrosoftAuthController::class, 'handleCallback'])->name('callback');

Route::get('/recipient-emails', [PermissionController::class, 'getEmails'])->name('recipient-emails');
Route::get('/recipient-details', [PermissionController::class, 'getRecipientDetails'])->name('recipient-details');

Route::get('/profile-settings', [ProfileController::class, 'show'])->name('profile-settings');
Route::post('/profile-update/{id}', [ProfileController::class, 'profileUpdate'])->name('profile-update');
Route::delete('/avatar-reset/{id}', [ProfileController::class, 'resetAvatar'])->name('avatar-reset');
Route::post('profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
