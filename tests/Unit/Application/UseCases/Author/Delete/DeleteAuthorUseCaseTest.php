<?php

namespace Tests\Unit\Application\UseCases\Author\Delete;

use App\Application\UseCases\Author\Delete\DeleteAuthorInput;
use App\Application\UseCases\Author\Delete\DeleteAuthorUseCase;
use App\Domain\Entities\Author;
use App\Domain\Exceptions\AuthorNotFoundException;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use Tests\TestCase;

class DeleteAuthorUseCaseTest extends TestCase
{

    private DeleteAuthorUseCase $useCase;
    private $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(IAuthorsRepository::class);
        $this->useCase = new DeleteAuthorUseCase($this->repositoryMock);
    }

    public function testDeleteAuthorSuccessFully()
    {
        $input = new DeleteAuthorInput('123ABC456');

        $this->repositoryMock->method('getById')
            ->willReturn(Author::create('123ABC456', 'John Doe'));

        $this->repositoryMock->expects($this->once())
            ->method('delete')
            ->with($input->id);

        $this->useCase->execute($input);
    }

    public function testDeleteAuthorNotFound()
    {
        $input = new DeleteAuthorInput('123ABC456');

        $this->repositoryMock->method('getById')
            ->with($input->id)
            ->willReturn(null);

        $this->expectException(AuthorNotFoundException::class);

        $this->useCase->execute($input);
    }
}