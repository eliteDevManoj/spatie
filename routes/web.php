<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [UserController::class, 'create']);

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');


Route::get('/roles', [RoleController::class, 'index'])->name('roles');

Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');

Route::post('/roles/create', [RoleController::class, 'add'])->name('roles.add');

Route::get('/roles/edit', [RoleController::class, 'view'])->name('roles.view');

Route::put('/roles/update', [RoleController::class, 'update'])->name('roles.update');

Route::delete('/roles/delete', [RoleController::class, 'delete'])->name('roles.delete');



Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');

Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');

Route::post('/permissions/create', [PermissionController::class, 'add'])->name('permissions.add');

Route::get('/permissions/edit', [PermissionController::class, 'view'])->name('permissions.view');

Route::put('/permissions/update', [PermissionController::class, 'update'])->name('permissions.update');

Route::delete('/permissions/delete', [PermissionController::class, 'delete'])->name('permissions.delete');



Route::get('/users', [UserController::class, 'index'])->name('users');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

Route::post('/users/create', [UserController::class, 'store'])->name('users.store');

Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');

Route::put('/users/update', [UserController::class, 'update'])->name('users.update');


/** Test Units */

Route::get('/fake/users', [TestController::class, 'fakeUsers'])->name('fake.users');