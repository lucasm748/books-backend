<?php

namespace App\Domain\Interfaces\Repositories;

use App\Domain\Entities\Book;

interface IBooksRepository
{
    public function getAll(): array;
    public function getById(string $id): ?Book;
    public function getByTitle(string $title): array;
    public function getByAuthor(string $authorId): array;
    public function getBySubject(string $subjectId): array;
    public function create(Book $book): void;
    public function update(Book $book): void;
    public function delete(string $id): void;
}