<?php

namespace Tests\Unit\Domain\Factories;

use App\Domain\Entities\Book;
use App\Domain\Factories\BookFactory;
use App\Domain\Payloads\CreateBookPayload;
use App\Domain\Services\UlidGeneratorDomainService;
use Illuminate\Foundation\Testing\TestCase;

class BookFactoryTest extends TestCase
{

    public function testCreateReturnsBookInstance()
    {
        $ulidGeneratorMock = $this->createMock(UlidGeneratorDomainService::class);
        $ulidGeneratorMock->method('generate')->willReturn('01F8MECHZX3TBDSZ7XRADM79XE');

        $factory = new BookFactory($ulidGeneratorMock);

        $bookPayload = new CreateBookPayload(
            'The Book Title',
            'The Publisher',
            1,
            2021,
            100.00,
            ['Lucas Andrade', 'Andrade Lucas'],
            ['PHP', 'Laravel', 'DDD']
        );

        $book = $factory->create($bookPayload);

        $this->assertInstanceOf(Book::class, $book);

        $this->assertIsString('01F8MECHZX3TBDSZ7XRADM79XE', $book->getId());
        $this->assertEquals('The Book Title', $book->getTitle());
        $this->assertEquals('The Publisher', $book->getPublisher());
        $this->assertEquals(1, $book->getEdition());
        $this->assertEquals(2021, $book->getPublicationYear());
        $this->assertEquals(100.00, $book->getPrice());
        $this->assertEquals(['Lucas Andrade', 'Andrade Lucas'], $book->getAuthors());
        $this->assertEquals(['PHP', 'Laravel', 'DDD'], $book->getSubjects());
    }
}
