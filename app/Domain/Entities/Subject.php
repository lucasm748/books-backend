<?php

namespace App\Domain\Entities;

class Subject
{
    private string $id;
    private string $description;

    private function __construct(string $id, string $description)
    {
        $this->id = $id;
        $this->description = $description;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public static function create(string $id, string $description): self
    {
        return new self($id, $description);
    }
}