<?php

namespace App\Infrastructure\Http\Controllers\Book\GetAll;

use App\Application\UseCases\Book\Get\GetBooksUseCase;
use Illuminate\Routing\Controller;

class GetBooksController extends Controller
{
    private GetBooksUseCase $useCase;

    public function __construct(GetBooksUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function get()
    {
        $output = $this->useCase->execute();
        $response = new GetBooksResponse($output->books);

        return response()->json($response);
    }
}