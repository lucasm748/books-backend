<?php

namespace App\Infrastructure\Http\Controllers\Subject\GetByDescription;

use App\Application\UseCases\Subject\GetByDescription\GetSubjectsByDescriptionUseCase;

class GetSubjectsByDescriptionController
{
    private GetSubjectsByDescriptionUseCase $useCase;

    public function __construct(GetSubjectsByDescriptionUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function getByDescription(GetSubjectsByDescriptionRequest $request): GetSubjectsByDescriptionResponse
    {
        $output = $this->useCase->execute($request->description);
        return new GetSubjectsByDescriptionResponse($output->subjects);
    }
}