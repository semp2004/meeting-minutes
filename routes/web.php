<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Enums\Permission;

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

Route::get('/', [\App\Http\Controllers\HomePageController::class, 'index']);

Route::get('/authenticated', [\App\Http\Controllers\Admin\NewTemplateController::class, 'index']);
Route::post('/authenticated', [\App\Http\Controllers\Admin\NewTemplateController::class, 'store']);

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/agenda', [AgendaController::class, 'index']);
});


Route::middleware('permission:'. Permission::AdminView ->name) -> group(function() {
//  New template
    Route::get('/admin/NewTemplate', [\App\Http\Controllers\Admin\NewTemplateController::class, 'index']);
    Route::post('/admin/NewTemplate', [\App\Http\Controllers\Admin\NewTemplateController::class, 'store']);

//  Edit template
    Route::get('/admin/EditTemplate/{id}', [\App\Http\Controllers\Admin\EditTemplateController::class, 'index']);
    Route::post('/admin/EditTemplate/{id}', [\App\Http\Controllers\Admin\EditTemplateController::class, 'store']);

    Route::get('/admin/register', [RegisteredUserController::class, 'create']) -> middleware('permission:' . Permission::NewUser -> name)
        ->name('register');
    Route::post('/admin/register', [RegisteredUserController::class, 'store']) -> middleware('permission:' . Permission::NewUser -> name);

    Route::get('/admin/EditUsers', [\App\Http\Controllers\Admin\EditUserController::class, 'index']) -> middleware('permission:' . Permission::EditUser -> name);

    Route::get('/admin/EditUser/{id}', [\App\Http\Controllers\Admin\EditUserController::class, 'EditUser']) -> middleware('permission:' . Permission::EditUser -> name) ->name('EditUser');

    Route::post('/admin/EditUser/{id}', [\App\Http\Controllers\Admin\EditUserController::class, 'EditUserRequest']) -> middleware('permission:' . Permission::EditUser -> name) ->name('EditUser');

    Route::get('/admin/DeleteUser/{id}', [\App\Http\Controllers\Admin\EditUserController::class, 'DeleteUser']) -> middleware('permission:' . Permission::DeleteUser -> name) ->name('DeleteUser');

});
