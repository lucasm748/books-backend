<?php

namespace App\Domain\Factories;

use App\Domain\Entities\Author;
use App\Domain\Services\UlidGeneratorDomainService;

class AuthorFactory
{
    private UlidGeneratorDomainService $ulidGenerator;

    public function __construct(UlidGeneratorDomainService $ulidGenerator)
    {
        $this->ulidGenerator = $ulidGenerator;
    }

    public function create(string $name): Author
    {
        return Author::create($this->ulidGenerator->generate(), $name);
    }
}