<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;


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
Route::get('/', [TodoListController::class, 'index'])->name('index');

/*Route::get('/', function () {
    return view('index');
});*/

Route::post('AddList', [TodoListController::class, 'store'])->name('AddList');

Route::delete('delete/{id}', [TodoListController::class, 'delete'])->name('delete_item');

Route::patch('update/{id}', [TodoListController::class, 'update']);



