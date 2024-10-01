<?php

namespace App\Domain\Factories;

use App\Domain\Entities\Subject;
use App\Domain\Services\UlidGeneratorDomainService;

class SubjectFactory
{
    private UlidGeneratorDomainService $ulidGenerator;

    public function __construct(UlidGeneratorDomainService $ulidGenerator)
    {
        $this->ulidGenerator = $ulidGenerator;
    }

    public function create(string $description): Subject
    {
        return Subject::create($this->ulidGenerator->generate(), $description);
    }
}