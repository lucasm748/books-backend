<?php

namespace App\Domain\Entities;

use App\Domain\Services\UlidGeneratorDomainService;

class BaseEntity
{
    protected $id;

    public function __construct(UlidGeneratorDomainService $uildGenerator)
    {
        $this->id = $uildGenerator->generate();
    }

    public function getId(): string
    {
        return $this->id;
    }
}