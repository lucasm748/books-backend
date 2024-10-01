<?php

namespace App\Infrastructure\Http\Controllers\Book\GetByTitle;

use App\Application\UseCases\Book\GetByTitle\GetBooksByTitleUseCase;

class GetBooksByTitleController
{
    private GetBooksByTitleUseCase $useCase;

    public function __construct(GetBooksByTitleUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function getByTitle(GetBooksByTitleRequest $request): GetBooksByTitleResponse
    {
        $output = $this->useCase->execute($request->title);
        return new GetBooksByTitleResponse($output->books);
    }
}