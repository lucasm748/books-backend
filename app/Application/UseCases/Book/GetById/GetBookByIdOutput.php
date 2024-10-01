<?php

namespace App\Application\UseCases\Book\GetById;

use App\Domain\Entities\Book;

class GetBookByIdOutput
{
    public Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }
}