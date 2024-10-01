<?php

namespace Tests\Unit\Application\UseCases\Author\GetByName;

use App\Application\UseCases\Author\GetByName\GetAuthorsByNameOutput;
use App\Application\UseCases\Author\GetByName\GetAuthorsByNameUseCase;
use App\Domain\Entities\Author;
use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use Illuminate\Foundation\Testing\TestCase;

class GetAuthorsByNameTest extends TestCase
{
    private GetAuthorsByNameUseCase  $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(IAuthorsRepository::class);
        $this->useCase = new GetAuthorsByNameUseCase($this->repositoryMock);
    }

    public function testGetAuthorsByNameSuccessFully()
    {
        $name = 'Eric Evans';
        $authors = [];
        $authors[] = Author::create('123ABC456', 'Eric Evans');

        $this->repositoryMock->method('getByName')
            ->with($name)
            ->willReturn($authors);

        $output = $this->useCase->execute($name);

        $this->assertInstanceOf(GetAuthorsByNameOutput::class, $output);

        $this->assertEquals($authors, $output->authors);
    }

    public function testGetAuthorsByNameUseCaseAuthorNotFound()
    {
        $name = 'Eric Evans';
        $authors = [];

        $this->repositoryMock->method('getByName')
            ->with($name)
            ->willReturn([]);

        $this->expectException(AuthorNotFoundException::class);

        $this->useCase->execute($name);
    }
}