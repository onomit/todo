<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FolderController;
use App\Http\Controllers\TaskController;

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
// すべてのURLをhttpsに統一する
URL::forceScheme('https');

//フォルダとタスクの一覧
Route::get('/folders/{id}/tasks',  [TaskController::class, 'index'])
    ->name('tasks.index');

// フォルダ作成
Route::get('/folders/create',  [FolderController::class, 'showCreateForm'])
    ->name('folders.create');
Route::post('/folders/create', [FolderController::class, 'create']);

// フォルダ編集
Route::get('/folders/{id}/edit', [FolderController::class, 'showEditForm'])
    ->name('folders.edit');
Route::post('/folders/{id}/edit', [FolderController::class, 'edit']);

// タスク作成
Route::get('/folders/{id}/tasks/create',  [TaskController::class, 'showCreateForm'])
    ->name('tasks.create');
Route::post('/folders/{id}/tasks/create', [TaskController::class, 'create']);

// タスク編集
Route::get('/folders/{id}/tasks/{task_id}/edit', [TaskController::class, 'showEditForm'])
    ->name('tasks.edit');
Route::post('/folders/{id}/tasks/{task_id}/edit', [TaskController::class, 'edit']);

// タスク削除
Route::get('/folders/{id}/tasks/{task_id}/delete', [TaskController::class, 'showDeleteForm'])
    ->name('tasks.delete');
Route::post('/folders/{id}/tasks/{task_id}/delete', [TaskController::class, 'delete']);