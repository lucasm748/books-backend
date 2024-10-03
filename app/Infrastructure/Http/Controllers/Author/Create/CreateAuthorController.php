<?php

namespace App\Infrastructure\Http\Controllers\Author\Create;

use App\Application\UseCases\Author\Create\CreateAuthorInput;
use App\Application\UseCases\Author\Create\CreateAuthorUseCase;
use App\Infrastructure\Http\Controllers\Author\Create\CreateAuthorRequest;
use Illuminate\Routing\Controller;

/**
 * @OA\Info(title="Books API", version="1.0")
 */
class CreateAuthorController extends Controller
{
    private readonly CreateAuthorUseCase $usecase;

    public function __construct(CreateAuthorUseCase $usecase)
    {
        $this->usecase = $usecase;
    }
    /**
     * @OA\Post(
     *     path="/api/authors",
     *     tags={"Authors"},
     *     summary="Create a new author",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="John Doe", description="Name of the author"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Author created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Invalid input"
     *     )
     * )
     */
    public function create(CreateAuthorRequest $request)
    {
        $this->usecase->execute(new CreateAuthorInput($request->name));
        return response()->json(['message' => 'Autor criado com sucesso'], 201);
    }
}