<?php

namespace App\Application\UseCases\Book\GetByTitle;

class GetBooksByTitleOutput
{
    public array $books;

    public function __construct(array $books)
    {
        $this->books = $books;
    }
}