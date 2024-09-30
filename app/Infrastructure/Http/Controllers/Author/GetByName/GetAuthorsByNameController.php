<?php

namespace App\Infrastructure\Http\Controllers\Author\GetByName;

use App\Application\UseCases\Author\GetByName\GetAuthorsByNameUseCase;

class GetAuthorsByNameController
{
    private GetAuthorsByNameUseCase $useCase;

    public function __construct(GetAuthorsByNameUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function getByName(GetAuthorsByNameRequest $request): GetAuthorsByNameResponse
    {
        $output = $this->useCase->execute($request->name);
        return new GetAuthorsByNameResponse($output->authors);
    }
}
