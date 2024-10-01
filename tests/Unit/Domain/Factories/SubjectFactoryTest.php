<?php

namespace Tests\Unit\Domain\Factories;

use App\Domain\Entities\Subject;
use App\Domain\Factories\SubjectFactory;
use App\Domain\Services\UlidGeneratorDomainService;
use Illuminate\Foundation\Testing\TestCase;

class SubjectFactoryTest extends TestCase
{

    public function testCreateReturnsSubjectInstance()
    {
        $ulidGeneratorMock = $this->createMock(UlidGeneratorDomainService::class);
        $ulidGeneratorMock->method('generate')->willReturn('01F8MECHZX3TBDSZ7XRADM79XE');

        $factory = new SubjectFactory($ulidGeneratorMock);

        $subject = $factory->create('Lucas Andrade');

        $this->assertInstanceOf(Subject::class, $subject);

        $this->assertEquals('01F8MECHZX3TBDSZ7XRADM79XE', $subject->getId());
        $this->assertEquals('Lucas Andrade', $subject->getDescription());
    }
}