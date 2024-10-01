<?php

namespace App\Infrastructure\Http\Controllers\Book\Create;

use App\Application\UseCases\Book\Create\CreateBookInput;
use App\Application\UseCases\Book\Create\CreateBookUseCase;
use App\Infrastructure\Http\Controllers\Book\Create\CreateBookRequest;
use Illuminate\Routing\Controller;

class CreateBookController extends Controller
{
    private readonly CreateBookUseCase $usecase;

    public function __construct(CreateBookUseCase $usecase)
    {
        $this->usecase = $usecase;
    }

    public function create(CreateBookRequest $request)
    {
        $this->usecase->execute(new CreateBookInput(
            $request->title,
            $request->publisher,
            $request->edition,
            $request->publicationYear,
            $request->price,
            $request->authors,
            $request->subjects
        ));

        return response()->json(['message' => 'Livro criado com sucesso'], 201);
    }
}