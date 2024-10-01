<?php

namespace App\Domain\Factories;

use App\Domain\Entities\Book;
use App\Domain\Payloads\CreateBookPayload;
use App\Domain\Services\UlidGeneratorDomainService;

class BookFactory
{
    private UlidGeneratorDomainService $ulidGenerator;

    public function __construct(UlidGeneratorDomainService $ulidGenerator)
    {
        $this->ulidGenerator = $ulidGenerator;
    }

    public function create(CreateBookPayload $payload): Book
    {
        return Book::create($this->ulidGenerator->generate(), $payload);
    }
}