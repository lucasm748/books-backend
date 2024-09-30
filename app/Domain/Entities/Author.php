<?php

namespace App\Domain\Entities;

class Author extends BaseEntity
{
    private string $name;

    public function __construct(string $name)
    {
        parent::__construct();
        $this->setName($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}