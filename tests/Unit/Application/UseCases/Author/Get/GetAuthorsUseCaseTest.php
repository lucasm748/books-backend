<?php

namespace Tests\Unit\Application\UseCases\Author\Get;

use App\Application\UseCases\Author\Get\GetAuthorsOutput;
use App\Application\UseCases\Author\Get\GetAuthorsUseCase;
use App\Domain\Entities\Author;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use Illuminate\Foundation\Testing\TestCase;

class GetAuthorsUseCaseTest extends TestCase
{
    private GetAuthorsUseCase $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(IAuthorsRepository::class);
        $this->useCase = new GetAuthorsUseCase($this->repositoryMock);
    }

    public function testGetAuthorsUseCaseSuccessFully()
    {
        $authors = [
            Author::create('123ABC', 'Author Silva'),
            Author::create('321DEF', 'Silva Author'),
        ];

        $this->repositoryMock->method('getAll')->willReturn($authors);

        $output = $this->useCase->execute();

        $this->assertInstanceOf(GetAuthorsOutput::class, $output);

        $this->assertEquals($authors, $output->authors);
    }
}