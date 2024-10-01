<?php

use App\Domain\Exceptions\AuthorDeleteException;
use App\Domain\Exceptions\AuthorHasBooksException;
use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Exceptions\BookNotFoundException;
use App\Domain\Exceptions\SubjectDeleteException;
use App\Domain\Exceptions\SubjectHasBooksException;
use App\Domain\Exceptions\SubjectNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthorNotFoundException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 404);
            }
        });

        $exceptions->render(function (SubjectNotFoundException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 404);
            }
        });

        $exceptions->render(function (BookNotFoundException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 404);
            }
        });

        $exceptions->render(function (SubjectDeleteException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 422);
            }
        });

        $exceptions->render(function (AuthorDeleteException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 422);
            }
        });

        $exceptions->render(function (SubjectHasBooksException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 422);
            }
        });

        $exceptions->render(function (AuthorHasBooksException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 422);
            }
        });

        $exceptions->report(function (Throwable $e) {
            Log::error($e->getMessage());
        });
    })->create();