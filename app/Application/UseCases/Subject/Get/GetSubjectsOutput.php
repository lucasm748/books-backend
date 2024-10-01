<?php

namespace App\Application\UseCases\Subject\Get;

class GetSubjectsOutput
{
    public array $subjects;

    public function __construct(array $subjects)
    {
        $this->subjects = $subjects;
    }
}