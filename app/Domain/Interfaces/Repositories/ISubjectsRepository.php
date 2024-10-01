<?php

namespace App\Domain\Interfaces\Repositories;

use App\Domain\Entities\Subject;

interface ISubjectsRepository
{
    public function getAll(): array;
    public function getById(string $id): ?Subject;
    public function getByDescription(string $description): array;
    public function create(Subject $subject): void;
    public function update(Subject $subject): void;
    public function delete(string $id): void;
}