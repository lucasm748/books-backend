<?php

namespace App\Infrastructure\Http\Controllers\Author\Create;

use App\Application\UseCases\Author\Create\CreateAuthorInput;
use App\Application\UseCases\Author\Create\CreateAuthorUseCase;
use App\Infrastructure\Http\Controllers\Author\Create\CreateAuthorRequest;
use Illuminate\Routing\Controller;

class CreateAuthorController extends Controller
{
    private readonly CreateAuthorUseCase $usecase;

    public function __construct(CreateAuthorUseCase $usecase)
    {
        $this->usecase = $usecase;
    }
    /**
     * @OA\Get(
     *   tags={"Author"},
     *   path="/api/authors",
     *   summary="Creates new author",
     *   @OA\Parameter(ref="#/components/parameters/id"),
     *   @OA\Response(response=201, description="OK"),
     *   @OA\Response(response=422, description="Validation error"),

     * )
     */
    public function create(CreateAuthorRequest $request)
    {
        $this->usecase->execute(new CreateAuthorInput($request->name));
        return response()->json(['message' => 'Autor criado com sucesso'], 201);
    }
}