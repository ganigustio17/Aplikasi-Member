<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Member\BlogController;
use App\Http\Controllers\Member\PageController;
use App\Http\Controllers\Member\UserController;
use App\Http\Controllers\Front\HomepageController;
use App\Http\Controllers\Front\BlogDetailController;
use App\Http\Controllers\Front\PageDetailController;

Route::get('/', [HomepageController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'blocked'])->name('dashboard');

Route::middleware(['auth', 'verified', 'blocked'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   

    Route::resource('/member/blog', BlogController::class)->names([
        'index' => 'member.blog.index',
        'create' => 'member.blog.create',
        'store' => 'member.blog.store',
        'show' => 'member.blog.show',
        'edit' => 'member.blog.edit',
        'update' => 'member.blog.update',
        'destroy' => 'member.blog.destroy',
    ])->parameters([
        'blog' => 'post'
    ]);

    Route::resource('/member/page', PageController::class)->names([
        'index' => 'member.page.index',
        'create' => 'member.page.create',
        'store' => 'member.page.store',
        'show' => 'member.page.show',
        'edit' => 'member.page.edit',
        'update' => 'member.page.update',
        'destroy' => 'member.page.destroy',
    ])->parameters([
        'page' => 'post'
    ])->middleware(['role_or_permission:admin-page']);

    Route::resource('/member/user', UserController::class)->names([
        'index' => 'member.user.index',
        'create' => 'member.user.create',
        'store' => 'member.user.store',
        'show' => 'member.user.show',
        'edit' => 'member.user.edit',
        'update' => 'member.user.update',
        'destroy' => 'member.user.destroy',
    ])->middleware(['role_or_permission:admin-user']);

    Route::get('/member/user/{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('member.user.toggle-block');
});

require __DIR__.'/auth.php';

Route::get('/{slug}', [BlogDetailController::class, 'detail'])->name('blog-detail');
Route::get('/page/{slug}', [PageDetailController::class, 'detail'])->name('page-detail');
Route::get('/empty', [HomepageController::class , 'index']);
