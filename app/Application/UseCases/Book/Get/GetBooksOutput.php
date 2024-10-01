<?php

namespace App\Application\UseCases\Book\Get;

class GetBooksOutput
{
    public array $books;

    public function __construct(array $books)
    {
        $this->books = $books;
    }
}