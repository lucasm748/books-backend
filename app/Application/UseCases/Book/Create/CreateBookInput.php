<?php

namespace App\Application\UseCases\Book\Create;

class CreateBookInput
{
    public string $title;
    public string $publisher;
    public int $edition;
    public int $publicationYear;
    public float $price;
    public array $authors;
    public array $subjects;

    public function __construct(
        string $title,
        string $publisher,
        int $edition,
        int $publicationYear,
        float $price,
        array $authors,
        array $subjects
    ) {
        $this->title = $title;
        $this->publisher = $publisher;
        $this->edition = $edition;
        $this->publicationYear = $publicationYear;
        $this->price = $price;
        $this->authors = $authors;
        $this->subjects = $subjects;
    }
}