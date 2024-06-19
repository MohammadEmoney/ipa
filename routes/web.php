<?php

use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '{locale?}'], function () {
    Route::middleware(['web'])->prefix('admin')->name('admin.')->group(function(){
        Route::post('upload', [ImageController::class, 'upload'])->name('image_upload');
        Route::get('login', \App\Livewire\Admin\Auth\LiveLogin::class)->name('login');
        Route::redirect('/', '/admin/dashboard');
        Route::middleware('auth')->group(function(){
            Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
            Route::get('users/password', \App\Livewire\Admin\Users\LiveUserPassword::class)->name('users.password');
            Route::get('users/trash', \App\Livewire\Admin\Users\LiveDeletedUsers::class)->name('users.trash');
    
        //  Users
            Route::get('users', \App\Livewire\Admin\Users\LiveUserIndex::class)->name('users.index')->middleware('can:user_index');
            Route::get('users/create', \App\Livewire\Admin\Users\LiveUserCreate::class)->name('users.create')->middleware('can:user_create');
            Route::get('users/{user}', \App\Livewire\Admin\Users\LiveUserShow::class)->name('users.show')->middleware('can:user_show');
            Route::get('users/{user}/edit', \App\Livewire\Admin\Users\LiveUserEdit::class)->name('users.edit')->middleware('can:user_edit');
        // Posts
            Route::get('posts', \App\Livewire\Admin\Posts\LivePostIndex::class)->name('posts.index')->middleware('can:post_index');
            Route::get('posts/create', \App\Livewire\Admin\Posts\LivePostCreate::class)->name('posts.create')->middleware('can:post_create');
            Route::get('posts/{post}/edit', \App\Livewire\Admin\Posts\LivePostEdit::class)->name('posts.edit')->middleware('can:post_edit');
        // Pages
            Route::get('pages', \App\Livewire\Admin\Pages\LivePageIndex::class)->name('pages.index')->middleware('can:page_index');
            Route::get('pages/create', \App\Livewire\Admin\Pages\LivePageCreate::class)->name('pages.create')->middleware('can:page_create');
            Route::get('pages/{page}/edit', \App\Livewire\Admin\Pages\LivePageEdit::class)->name('pages.edit')->middleware('can:page_edit');
        // Categories
            Route::get('categories', \App\Livewire\Admin\Categories\LiveCategoryIndex::class)->name('categories.index')->middleware('can:category_index');
            Route::get('categories/create', \App\Livewire\Admin\Categories\LiveCategoryCreate::class)->name('categories.create')->middleware('can:category_create');
            Route::get('categories/{category}/edit', \App\Livewire\Admin\Categories\LiveCategoryEdit::class)->name('categories.edit')->middleware('can:category_edit');
        // Group Layouts
            Route::get('group-layouts', \App\Livewire\Admin\GroupLayouts\LiveGroupLayoutIndex::class)->name('group-layouts.index')->middleware('can:group_layout_index');
            Route::get('group-layouts/create', \App\Livewire\Admin\GroupLayouts\LiveGroupLayoutCreate::class)->name('group-layouts.create')->middleware('can:group_layout_create');
            Route::get('group-layouts/{layoutGroup}/edit', \App\Livewire\Admin\GroupLayouts\LiveGroupLayoutEdit::class)->name('group-layouts.edit')->middleware('can:group_layout_edit');
        // Layouts
            Route::prefix('layouts')->name('layouts.')->group(function () {
                Route::get('/{layoutGroup}', \App\Livewire\Admin\Layouts\LiveLayoutIndex::class)->name('index')->middleware('can:layout_index');
                Route::get('/{layoutGroup}/create', \App\Livewire\Admin\Layouts\LiveLayoutCreate::class)->name('create')->middleware('can:layout_create');
                Route::get('/{layoutGroup}/{layout}/edit', \App\Livewire\Admin\Layouts\LiveLayoutEdit::class)->name('edit')->middleware('can:layout_edit');
            });
    
            Route::get('settings', \App\Livewire\Admin\Settings\LiveSettings::class)->name('settings.general')->middleware('can:general_settings');
    
            // Role and Permissions
            // Route::get('roles', \App\Livewire\Admin\Roles\LiveRoleIndex::class)->name('roles.index');
            Route::get('roles/permissions', \App\Livewire\Admin\Roles\LiveRolePermission::class)->name('roles.permissions');
        });
    });
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::redirect('/home', '/');
    Route::middleware(['web'])->name('front.')->group(function(){
        Route::get('/news', \App\Livewire\Front\Blog\LiveBlogIndex::class)->name('blog.index');
        Route::get('/news/{post:slug}', \App\Livewire\Front\Blog\LiveBlogShow::class)->name('blog.show');
        Route::get('/categories/{category:slug}', \App\Livewire\Front\Categories\LiveCategoryShow::class)->name('categories.show');
        Route::get('/pages/{page:slug}', \App\Livewire\Front\Pages\LivePageShow::class)->name('pages.show');
        Route::get('/search', \App\Livewire\Front\Blog\LiveBlogIndex::class)->name('search');
    });
    Route::get('login', App\Livewire\Auth\LiveLogin::class)->name('login');
    Route::get('register', App\Livewire\Auth\LiveRegister::class)->name('register');
})->where('locale', '[a-zA-Z]{2}');


// Route::get('/', \App\Livewire\Front\Home\LiveHome::class)->name('home');

// Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::middleware('auth')->prefix('dashboard')->name('profile.')->group(function(){
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//     Route::get('/edit-profile', [DashboardController::class, 'edit'])->name('edit');
//     Route::get('/courses', LiveCourseSelect::class)->name('courses.select')->middleware('register-complete');
// });


// Route::get('register', [RegisterController::class, 'register'])->name('register');
// Route::get('get-code/{code}', [LoginController::class, 'getCode'])->name('code');

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
