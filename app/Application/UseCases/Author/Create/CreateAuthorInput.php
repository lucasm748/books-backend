<?php

namespace App\Application\UseCases\Author\Create;

class CreateAuthorInput
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}