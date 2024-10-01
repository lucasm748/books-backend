<?php

namespace Tests\Unit\Application\UseCases\Author\GetById;

use App\Application\UseCases\Author\GetById\GetAuthorByIdOutput;
use App\Application\UseCases\Author\GetById\GetAuthorByIdUseCase;
use App\Domain\Entities\Author;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use Illuminate\Foundation\Testing\TestCase;

class GetAuthorByIdUseCaseTest extends TestCase
{
    private GetAuthorByIdUseCase $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(IAuthorsRepository::class);
        $this->useCase = new GetAuthorByIdUseCase($this->repositoryMock);
    }

    public function testGetAuthorByIdSuccessFully()
    {
        $id = '123ABC456';
        $author = Author::create('123ABC456', 'Author Testable');

        $this->repositoryMock->method('getById')
            ->with($id)
            ->willReturn($author);

        $output = $this->useCase->execute($id);

        $this->assertInstanceOf(GetAuthorByIdOutput::class, $output);

        $this->assertEquals($author, $output->author);
    }
}