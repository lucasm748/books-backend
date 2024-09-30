<?php

namespace App\Application\UseCases\Author\GetById;

use App\Domain\Entities\Author;

class GetAuthorByIdOutput
{
    public Author $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }
}
