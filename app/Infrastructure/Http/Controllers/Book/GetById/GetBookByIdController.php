<?php

namespace App\Infrastructure\Http\Controllers\Book\GetById;

use App\Application\UseCases\Book\GetById\GetBookByIdUseCase;

class GetBookByIdController
{
    private GetBookByIdUseCase $useCase;

    public function __construct(GetBookByIdUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function getById(string $id)
    {
        $output = $this->useCase->execute($id);
        $response = new GetBookByIdResponse($output->book);

        return response()->json($response);
    }
}