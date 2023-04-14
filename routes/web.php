<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgendaItemController;
use App\Http\Controllers\CommentController;
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

Route::get('/', [\App\Http\Controllers\HomePageController::class, 'index'])->name('home-page');

Route::get('/authenticated', [\App\Http\Controllers\Admin\NewTemplateController::class, 'index']);
Route::post('/authenticated', [\App\Http\Controllers\Admin\NewTemplateController::class, 'store']);

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //agenda and meetings
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
    Route::get('/meeting/new', [AgendaController::class, 'newmeeting']);
    Route::get('/meeting/edit/{meeting}', [AgendaController::class, 'editmeeting']);
    Route::post('/meeting/store', [AgendaController::class, 'store'])->name('meeting.store');
    Route::post('/meeting/update/{meeting}', [AgendaController::class, 'update'])->name('meeting.update');
    Route::post('/meeting/delete/{meeting}', [AgendaController::class, 'delete'])->name('meeting.delete');
    Route::get('/meeting/{meeting}', [AgendaController::class, 'meeting']);

    //agenda items
    Route::get('/agenda-item/{agendaItem}', [AgendaItemController::class, 'edit'])->name('agenda-item.edit');
    Route::post('/meeting/agenda-item', [AgendaItemController::class, 'store']);
    Route::post('/agenda-item/update', [AgendaItemController::class, 'update'])->name('agenda-item.update');

    // Besluiten

    Route::get('/besluit/{agendaItem}', [\App\Http\Controllers\BesluitController::class, 'view'])->name('besluit');
    Route::post('/besluit/{agendaItem}', [\App\Http\Controllers\BesluitController::class, 'store'])->name('besluit.post');

    //comments
    Route::get('comment/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::get('/comment/delete/{id}', [CommentController::class, 'confirmation'])->name('comment.delete.confirmation');
    Route::post('/comment/save', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/comment/update', [CommentController::class, 'update'])->name('comment.update');
    Route::post('/comment/delete/', [CommentController::class, 'delete'])->name('comment.delete');
});


Route::middleware('permission:' . Permission::AdminView->name)->group(function () {
//  New template
    Route::get('/admin/newtemplate', [\App\Http\Controllers\Admin\NewTemplateController::class, 'index'])->name('NewTemplate');
    Route::post('/admin/newtemplate', [\App\Http\Controllers\Admin\NewTemplateController::class, 'store']);

//  Edit Template
    Route::get('/admin/edittemplates', [\App\Http\Controllers\Admin\EditTemplateController::class, 'index'])->name('EditTemplates');
    Route::get('/admin/edittemplate/{id}', [\App\Http\Controllers\Admin\EditTemplateController::class, 'editTemplate'])->name('EditTemplate');
    Route::post('/admin/edittemplate/{id}', [\App\Http\Controllers\Admin\EditTemplateController::class, 'store']);

    Route::get('/admin/register', [RegisteredUserController::class, 'create'])->middleware('permission:' . Permission::NewUser->name)
        ->name('register');
    Route::post('/admin/register', [RegisteredUserController::class, 'store'])->middleware('permission:' . Permission::NewUser->name);

    Route::get('/admin/editusers', [\App\Http\Controllers\Admin\EditUserController::class, 'index'])->middleware('permission:' . Permission::EditUser->name)->name('EditUsers');

    Route::get('/admin/edituser/{id}', [\App\Http\Controllers\Admin\EditUserController::class, 'EditUser'])->middleware('permission:' . Permission::EditUser->name);

    Route::post('/admin/edituser/{id}', [\App\Http\Controllers\Admin\EditUserController::class, 'EditUserRequest'])->middleware('permission:' . Permission::EditUser->name)->name('EditUser');

    Route::get('/admin/deleteuser/{id}', [\App\Http\Controllers\Admin\EditUserController::class, 'DeleteUser'])->middleware('permission:' . Permission::DeleteUser->name)->name('DeleteUser');

});
