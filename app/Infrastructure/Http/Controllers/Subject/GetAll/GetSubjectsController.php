<?php

namespace App\Infrastructure\Http\Controllers\Subject\GetAll;

use App\Application\UseCases\Subject\Get\GetSubjectsUseCase;
use Illuminate\Routing\Controller;

class GetSubjectsController extends Controller
{
    private GetSubjectsUseCase $useCase;

    public function __construct(GetSubjectsUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function get()
    {
        $output = $this->useCase->execute();
        $response = new GetSubjectsResponse($output->subjects);

        return response()->json($response);
    }
}