<?php

namespace Tests\Unit\Domain\Factories;

use App\Domain\Entities\Author;
use App\Domain\Factories\AuthorFactory;
use App\Domain\Services\UlidGeneratorDomainService;
use Illuminate\Foundation\Testing\TestCase;

class AuthorFactoryTest extends TestCase
{

    public function testCreateReturnsAuthorInstance()
    {
        $ulidGeneratorMock = $this->createMock(UlidGeneratorDomainService::class);
        $ulidGeneratorMock->method('generate')->willReturn('01F8MECHZX3TBDSZ7XRADM79XE');

        $factory = new AuthorFactory($ulidGeneratorMock);

        $author = $factory->create('Lucas Andrade');

        $this->assertInstanceOf(Author::class, $author);

        $this->assertEquals('01F8MECHZX3TBDSZ7XRADM79XE', $author->getId());
        $this->assertEquals('Lucas Andrade', $author->getName());
    }
}