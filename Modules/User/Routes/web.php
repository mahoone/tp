<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

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

Route::group(
    [
        'middleware' => 'auth'
    ],
    function () {

        Route::group([
            'as' => ''
        ], function () {

            Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
            Route::get('dashboard/users/{user}', [UserController::class, 'show'])->name('users.show');
            Route::put('dashboard/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('dashboard/users/{user}', [UserController::class, 'delete'])->name('users.delete');
        });

        Route::group([
            'middleware' => 'is_admin',
            'as' => ''
        ], function () {
            Route::get('dashboard/user', [UserController::class, 'showStore'])->name('user.showStore');
            Route::post('dashboard/user', [UserController::class, 'store'])->name('user.store');
        });
    }
);
