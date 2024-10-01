<?php

namespace App\Infrastructure\Http\Controllers\Book\GetById;

use App\Domain\Entities\Book;
use JsonSerializable;


class GetBookByIdResponse implements JsonSerializable
{
    public Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'book' => [
                'id' => $this->book->getId(),
                'title' => $this->book->getTitle(),
                'publisher' => $this->book->getPublisher(),
                'edition' => $this->book->getEdition(),
                'publicationYear' => $this->book->getPublicationYear(),
                'price' => $this->book->getPrice(),
                'authors' => array_map(function ($author) {
                    return [
                        'id' => $author['id'],
                        'name' => $author['name']
                    ];
                }, $this->book->getAuthors()),
                'subjects' => array_map(function ($subject) {
                    return [
                        'id' => $subject['id'],
                        'description' => $subject['description']
                    ];
                }, $this->book->getSubjects())
            ]
        ];
    }
}