<?php

namespace App\Application\UseCases\Subject\GetByDescription;

class GetSubjectsByDescriptionOutput
{
    public array $subjects;

    public function __construct(array $subjects)
    {
        $this->subjects = $subjects;
    }
}