<?php

namespace App\Domain\Entities;

class Author
{
    private string $id;
    private string $name;

    private function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public static function create(string $id, string $name): self
    {
        return new self($id, $name);
    }
}