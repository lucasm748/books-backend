<?php

namespace App\Application\UseCases\Author\GetByName;

class GetAuthorsByNameOutput
{
    public array $authors;

    public function __construct(array $authors)
    {
        $this->authors = $authors;
    }
}
