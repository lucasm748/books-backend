<?php

namespace App\Infrastructure\Http\Controllers\Subject\Create;

use App\Application\UseCases\Subject\Create\CreateSubjectInput;
use App\Application\UseCases\Subject\Create\CreateSubjectUseCase;
use App\Infrastructure\Http\Controllers\Subject\Create\CreateSubjectRequest;
use Illuminate\Routing\Controller;

class CreateSubjectController extends Controller
{
    private readonly CreateSubjectUseCase $usecase;

    public function __construct(CreateSubjectUseCase $usecase)
    {
        $this->usecase = $usecase;
    }

    public function create(CreateSubjectRequest $request)
    {
        $this->usecase->execute(new CreateSubjectInput($request->description));
        return response()->json(['message' => 'Assunto criado com sucesso'], 201);
    }
}