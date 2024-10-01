<?php

namespace App\Domain\Interfaces\Repositories;

use App\Domain\Entities\Author;

interface IAuthorsRepository
{
    public function getAll(): array;
    public function getById(string $id): ?Author;
    public function getByIds(array $ids): array;
    public function getByName(string $name): array;
    public function create(Author $author): void;
    public function update(Author $author): void;
    public function delete(string $id): void;
}