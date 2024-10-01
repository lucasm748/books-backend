<?php

namespace Tests\Unit\Domain\Services;

use App\Domain\Services\UlidGeneratorDomainService;
use Illuminate\Foundation\Testing\TestCase;
use Symfony\Component\Uid\Ulid;

class UlidGeneratorDomainServiceTest extends TestCase
{
    public function testGenerateReturnsValidUlid()
    {
        $ulidGenerator = new UlidGeneratorDomainService();
        $ulid = $ulidGenerator->generate();

        $this->assertIsString($ulid);

        $this->assertTrue(Ulid::isValid($ulid));
    }
}