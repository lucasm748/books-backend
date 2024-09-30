<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Domain\Entities\Author;
use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use App\Infrastructure\Eloquent\Models\AuthorModel;

class AuthorsRepository implements IAuthorsRepository
{
    public function getAll(): array
    {
        $authors = AuthorModel::all();

        return $authors->map(function ($author) {
            return new Author($author->id, $author->name);
        })->toArray() ?? [];
    }

    public function getById(string $id): Author
    {
        $author = AuthorModel::findOrFail($id)->first();
        return new Author($author->id, $author->name);
    }

    public function getByName(string $name): array
    {
        $authors = AuthorModel::where('name', 'like', "%$name%")->get();

        return $authors->map(function ($author) {
            return new Author($author->id, $author->name);
        })->toArray() ?? [];
    }

    public function create(Author $author): void
    {
        AuthorModel::create([
            'id' => $author->getId(),
            'name' => $author->getName()
        ]);
    }

    public function update(Author $author): void
    {
        AuthorModel::where('id', $author->getId())->update([
            'name' => $author->getName()
        ]);
    }

    public function delete(string $code): void
    {
        AuthorModel::where('id', $code)->delete();
    }
}