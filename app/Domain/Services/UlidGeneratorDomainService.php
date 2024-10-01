<?php

namespace App\Domain\Services;

use Symfony\Component\Uid\Ulid;

class UlidGeneratorDomainService
{

    public function generate(): string
    {
        return (new Ulid())->toBase32();
    }
}