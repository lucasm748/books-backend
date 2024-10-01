<?php

namespace App\Domain\Entities;

use App\Domain\Payloads\CreateBookPayload;

class Book
{
    private string $id;
    private string $title;
    private string $publisher;
    private int $edition;
    private int $publicationYear;
    private float $price;
    private array $authors;
    private array $subjects;

    private function __construct(string $id, CreateBookPayload $payload)
    {
        $this->id = $id;
        $this->title = $payload->title;
        $this->publisher = $payload->publisher;
        $this->edition = $payload->edition;
        $this->publicationYear = $payload->publicationYear;
        $this->price = $payload->price;
        $this->authors = $payload->authors;
        $this->subjects = $payload->subjects;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function setPublisher(string $publisher): void
    {
        $this->publisher = $publisher;
    }

    public function getEdition(): int
    {
        return $this->edition;
    }

    public function setEdition(int $edition): void
    {
        $this->edition = $edition;
    }

    public function getPublicationYear(): int
    {
        return $this->publicationYear;
    }

    public function setPublicationYear(int $publicationYear): void
    {
        $this->publicationYear = $publicationYear;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function setAuthors(array $authors): void
    {
        $this->authors = $authors;
    }

    public function getSubjects(): array
    {
        return $this->subjects;
    }

    public function setSubjects(array $subjects): void
    {
        $this->subjects = $subjects;
    }

    public static function create(string $id, CreateBookPayload $payload): self
    {
        return new self($id, $payload);
    }
}