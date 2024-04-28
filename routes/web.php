<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todo', [TodoListController::class, 'getAllTodo'])->name("home");
Route::get('/todo/add', [TodoListController::class, 'add'])->name("add");
Route::post('/todo/add', [TodoListController::class, 'store'])->name("store");
Route::get('/todo/edit/{id}', [TodoListController::class, 'edit'])->name("edit");
Route::put('/todo/update/{id}', [TodoListController::class, 'update'])->name("update");
Route::delete('/todo/delete/{id}', [TodoListController::class, 'delete'])->name("delete");