<?php

namespace App\Application\UseCases\Book\Create;

class CreateBookOutput
{
    public string $id;
    public string $title;
    public string $publisher;
    public int $edition;
    public int $publicationYear;
    public float $price;
    public array $authors;
    public array $subjects;
}