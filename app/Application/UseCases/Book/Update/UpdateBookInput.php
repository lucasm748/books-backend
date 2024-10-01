<?php

namespace App\Application\UseCases\Book\Update;

class UpdateBookInput
{
    public $id;
    public $title;
    public $publisher;
    public $edition;
    public $publicationYear;
    public $price;
    public $authors;
    public $subjects;

    public function __construct(
        $id,
        $title,
        $publisher,
        $edition,
        $publicationYear,
        $price,
        $authors,
        $subjects
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->publisher = $publisher;
        $this->edition = $edition;
        $this->publicationYear = $publicationYear;
        $this->price = $price;
        $this->authors = $authors;
        $this->subjects = $subjects;
    }
}