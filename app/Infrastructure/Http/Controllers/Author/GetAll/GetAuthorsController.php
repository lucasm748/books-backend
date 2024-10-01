<?php

namespace App\Infrastructure\Http\Controllers\Author\GetAll;

use App\Application\UseCases\Author\Get\GetAuthorsOutput;
use App\Application\UseCases\Author\Get\GetAuthorsUseCase;
use Illuminate\Routing\Controller;

class GetAuthorsController extends Controller
{
    private GetAuthorsUseCase $useCase;

    public function __construct(GetAuthorsUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function get()
    {
        $output = $this->useCase->execute();
        $response = new GetAuthorsResponse($output->authors);

        return response()->json($response);
    }
}