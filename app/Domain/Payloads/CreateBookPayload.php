<?php

namespace App\Domain\Payloads;

class CreateBookPayload
{

    public function __construct(
        public string $title,
        public string $publisher,
        public int $edition,
        public int $publicationYear,
        public float $price,
        public array $authors,
        public array $subjects
    ) {}
}