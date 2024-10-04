<?php

use App\Infrastructure\Http\Controllers\Author\Create\CreateAuthorController;
use App\Infrastructure\Http\Controllers\Author\Delete\DeleteAuthorController;
use App\Infrastructure\Http\Controllers\Author\GetAll\GetAuthorsController;
use App\Infrastructure\Http\Controllers\Author\GetById\GetAuthorByIdController;
use App\Infrastructure\Http\Controllers\Author\GetByName\GetAuthorsByNameController;
use App\Infrastructure\Http\Controllers\Author\Update\UpdateAuthorController;
use App\Infrastructure\Http\Controllers\Book\Create\CreateBookController;
use App\Infrastructure\Http\Controllers\Book\Delete\DeleteBookController;
use App\Infrastructure\Http\Controllers\Book\GetAll\GetBooksController;
use App\Infrastructure\Http\Controllers\Book\GetById\GetBookByIdController;
use App\Infrastructure\Http\Controllers\Book\GetByTitle\GetBooksByTitleController;
use App\Infrastructure\Http\Controllers\Book\Update\UpdateBookController;
use App\Infrastructure\Http\Controllers\Report\ReportController;
use App\Infrastructure\Http\Controllers\Subject\Create\CreateSubjectController;
use App\Infrastructure\Http\Controllers\Subject\Delete\DeleteSubjectController;
use App\Infrastructure\Http\Controllers\Subject\GetAll\GetSubjectsController;
use App\Infrastructure\Http\Controllers\Subject\GetByDescription\GetSubjectsByDescriptionController;
use App\Infrastructure\Http\Controllers\Subject\GetById\GetSubjectByIdController;
use App\Infrastructure\Http\Controllers\Subject\Update\UpdateSubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'OK']);
});

Route::prefix('authors')->group(function () {
    Route::get('/', [GetAuthorsController::class, 'get']);
    Route::get('/by-name', [GetAuthorsByNameController::class, 'getByName']);
    Route::get('/{id}', [GetAuthorByIdController::class, 'getById']);
    Route::post('/', [CreateAuthorController::class, 'create']);
    Route::put('/{id}', [UpdateAuthorController::class, 'update']);
    Route::delete('/{id}', [DeleteAuthorController::class, 'delete']);
});

Route::prefix('subjects')->group(function () {
    Route::get('/', [GetSubjectsController::class, 'get']);
    Route::get('/by-description', [GetSubjectsByDescriptionController::class, 'getByDescription']);
    Route::get('/{id}', [GetSubjectByIdController::class, 'getById']);
    Route::post('/', [CreateSubjectController::class, 'create']);
    Route::put('/{id}', [UpdateSubjectController::class, 'update']);
    Route::delete('/{id}', [DeleteSubjectController::class, 'delete']);
});

Route::prefix('books')->group(function () {
    Route::get('/', [GetBooksController::class, 'get']);
    Route::get('/by-title', [GetBooksByTitleController::class, 'getByTitle']);
    Route::get('/{id}', [GetBookByIdController::class, 'getById']);
    Route::post('/', [CreateBookController::class, 'create']);
    Route::put('/{id}', [UpdateBookController::class, 'update']);
    Route::delete('/{id}', [DeleteBookController::class, 'delete']);
});

Route::get('report', [ReportController::class, 'generate']);
