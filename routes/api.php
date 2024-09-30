<?php

use App\Infrastructure\Http\Controllers\Author\Create\CreateAuthorController;
use App\Infrastructure\Http\Controllers\Author\Delete\DeleteAuthorController;
use App\Infrastructure\Http\Controllers\Author\GetAll\GetAuthorsController;
use App\Infrastructure\Http\Controllers\Author\GetById\GetAuthorByIdController;
use App\Infrastructure\Http\Controllers\Author\GetByName\GetAuthorsByNameController;
use App\Infrastructure\Http\Controllers\Author\Update\UpdateAuthorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'OK']);
});

Route::get('/authors', [GetAuthorsController::class, 'get']);
Route::get('/authors/by-name', [GetAuthorsByNameController::class, 'getByName']);
Route::get('/authors/{id}', [GetAuthorByIdController::class, 'getById']);
Route::post('/authors', [CreateAuthorController::class, 'create']);
Route::put('/authors/{id}', [UpdateAuthorController::class, 'update']);
Route::delete('/authors/{id}', [DeleteAuthorController::class, 'delete']);