<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Domain\Entities\Author;
use App\Domain\Exceptions\AuthorDeleteException;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use App\Infrastructure\Eloquent\Models\AuthorModel;

class AuthorsRepository implements IAuthorsRepository
{
    public function getAll(): array
    {
        $authors = AuthorModel::all();

        return $authors->map(function ($author) {
            return Author::create($author->id, $author->name);
        })->toArray() ?? [];
    }

    public function getById(string $id): ?Author
    {
        $author = AuthorModel::find($id);

        if (!$author) {
            return null;
        }

        return Author::create($author->id, $author->name);
    }

    public function getByIds(array $ids): array
    {
        $authors = AuthorModel::whereIn('CodAu', $ids)->get();

        return $authors->map(function ($author) {
            return Author::create($author->id, $author->name);
        })->toArray() ?? [];
    }

    public function getByName(string $name): array
    {
        $authors = AuthorModel::where('Nome', 'like', "%$name%")->get();

        return $authors->map(function ($author) {
            return Author::create($author->id, $author->name);
        })->toArray() ?? [];
    }

    public function create(Author $author): void
    {
        AuthorModel::create([
            'CodAu' => $author->getId(),
            'Nome' => $author->getName()
        ]);
    }

    public function update(Author $author): void
    {
        AuthorModel::where('CodAu', $author->getId())->update([
            'Nome' => $author->getName()
        ]);
    }

    public function delete(string $code): void
    {
        try {
            AuthorModel::where('CodAu', $code)->delete();
        } catch (\Exception $e) {
            throw new AuthorDeleteException();
        }
    }
}