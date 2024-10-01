<?php

namespace Tests\Unit\Application\UseCases\Author\Create;

use App\Application\UseCases\Author\Create\CreateAuthorInput;
use App\Application\UseCases\Author\Create\CreateAuthorUseCase;
use App\Domain\Entities\Author;
use App\Domain\Factories\AuthorFactory;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use App\Domain\Services\UlidGeneratorDomainService;
use Illuminate\Foundation\Testing\TestCase;

class CreateAuthorUseCaseTest extends TestCase
{
    private CreateAuthorUseCase $useCase;
    private $repositoryMock;
    private $authorFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(IAuthorsRepository::class);
        $ulidGeneratorMock = $this->createMock(UlidGeneratorDomainService::class);
        $ulidGeneratorMock->method('generate')->willReturn('01E8Z6YV1KZ2JQZJYVQVXZQZQZ');

        $this->authorFactory = new AuthorFactory($ulidGeneratorMock);
        $this->useCase = new CreateAuthorUseCase($this->repositoryMock, $this->authorFactory);
    }

    public function testExecuteUseCaseSuccessFully()
    {
        $input = new CreateAuthorInput('Eric Evans');

        $this->repositoryMock->expects($this->once())
            ->method('create')
            ->with($this->callback(function ($author) use ($input) {
                return $author instanceof Author
                    && $author->getName() === $input->name
                    && $author->getId() === '01E8Z6YV1KZ2JQZJYVQVXZQZQZ';
            }));

        $this->useCase->execute($input);
    }
}