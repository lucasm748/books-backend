<?php

namespace App\Domain\Entities;

class Author
{
    private string $id;
    private string $name;

    public function __construct(
        string $id,
        string $name,
    ) {
        $this->setId($id);
        $this->setName($name);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}