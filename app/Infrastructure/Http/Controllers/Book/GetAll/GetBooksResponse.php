<?php

namespace App\Infrastructure\Http\Controllers\Book\GetAll;

use App\Domain\Entities\Book;
use JsonSerializable;


class GetBooksResponse implements JsonSerializable
{
    public array $books;

    public function __construct(array $books)
    {
        $this->books = $books;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'books' => array_map(function (Book $book) {
                return [
                    'id' => $book->getId(),
                    'title' => $book->getTitle(),
                    'publisher' => $book->getPublisher(),
                    'edition' => $book->getEdition(),
                    'publicationYear' => $book->getPublicationYear(),
                    'price' => $book->getPrice(),
                    'authors' => array_map(function ($author) {
                        return [
                            'id' => $author['id'],
                            'name' => $author['name']
                        ];
                    }, $book->getAuthors()),
                    'subjects' => array_map(function ($subject) {
                        return [
                            'id' => $subject['id'],
                            'description' => $subject['description']
                        ];
                    }, $book->getSubjects())
                ];
            }, $this->books)
        ];
    }
}