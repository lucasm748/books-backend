<?php

namespace App\Application\UseCases\Subject\Create;

class CreateSubjectInput
{
    public string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }
}