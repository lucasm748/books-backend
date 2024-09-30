<?php

namespace App\Application\UseCases\Author\Get;

class GetAuthorsOutput
{
    public array $authors;

    public function __construct(array $authors)
    {
        $this->authors = $authors;
    }
}