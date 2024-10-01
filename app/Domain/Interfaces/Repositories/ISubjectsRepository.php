<?php

namespace App\Domain\Interfaces\Repositories;

use App\Domain\Entities\Subject;

class ISubjectsRepository
{
    public function getAll(): array;
    public function getById(string $id): Subject | null;
    public function getByName(string $name): array;
    public function create(Subject $subject): void;
    public function update(Subject $subject): void;
    public function delete(string $id): void;
}