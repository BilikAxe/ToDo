<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
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
    return view('home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('tasks', 'TaskController');
    Route::post('/create-task', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'delete'])->name('tasks.delete');
    Route::get('/tasks', [TaskController::class, 'filter'])->name('tasks.filter');
    Route::post('/tasks-share', [TaskController::class, 'share'])->name('tasks.share');
    Route::post('/logout', [UserController::class, 'signOut'])->name('signOut');
    Route::get('/share/{id?}', [TaskController::class, 'getSharedTasks'])->name('tasks.shared');
    Route::post('/share/{id?}', [TaskController::class, 'getSharedTasks'])->name('tasks.shared');
    Route::get('/my-tasks', [TaskController::class, 'showMyTasks'])->name('tasks.showMyTasks');
    Route::get('/lists', [TaskListController::class, 'getMyLists'])->name('lists');
    Route::get('/list/{id?}', [TaskController::class, 'showMyTasks'])->name('lists.showMyTasks');
    Route::post('/create-task-list', [TaskListController::class, 'store'])->name('lists.store');
    Route::delete('/lists/{list}', [TaskListController::class, 'delete'])->name('lists.delete');
    Route::get('/shared-list', [TaskListController::class, 'getSharedTaskLists'])->name('lists.shared');
});

Route::middleware('guest')->group(function () {
    Route::get('/sign-in', [UserController::class, 'signIn'])->name('signIn');
    Route::post('/sign-in', [UserController::class, 'login']);
    Route::get('/sign-up', [UserController::class, 'signUp'])->name('signUp');
    Route::post('/sign-up', [UserController::class, 'registrate']);
});



