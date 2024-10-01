<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Domain\Entities\Book;
use App\Domain\Interfaces\Repositories\IBooksRepository;
use App\Infrastructure\Eloquent\Mappers\BookModelToBookEntityMapper;
use App\Infrastructure\Eloquent\Models\BookModel;
use Illuminate\Support\Facades\DB;

class BooksRepository implements IBooksRepository
{
    public function getAll(): array
    {
        $books = BookModel::with('authors', 'subjects')->get();

        return $books->map(function ($book) {
            return BookModelToBookEntityMapper::mapToDomain($book);
        })->toArray() ?? [];
    }

    public function getById(string $id): ?Book
    {
        $book = BookModel::with('authors', 'subjects')->find($id);

        if (!$book) {
            return null;
        }

        return BookModelToBookEntityMapper::mapToDomain($book);
    }

    public function getByTitle(string $title): array
    {
        $books = BookModel::where('Titulo', 'like', "%$title%")->get();

        return $books->map(function ($book) {
            return BookModelToBookEntityMapper::mapToDomain($book);
        })->toArray() ?? [];
    }

    public function getByAuthor(string $authorId): array
    {
        $books = BookModel::whereHas('authors', function ($query) use ($authorId) {
            $query->where('CodAu', $authorId);
        })->get();

        return $books->map(function ($book) {
            return BookModelToBookEntityMapper::mapToDomain($book);
        })->toArray() ?? [];
    }

    public function getBySubject(string $subjectId): array
    {
        $books = BookModel::whereHas('subjects', function ($query) use ($subjectId) {
            $query->where('CodAs', $subjectId);
        })->get();

        return $books->map(function ($book) {
            return BookModelToBookEntityMapper::mapToDomain($book);
        })->toArray() ?? [];
    }

    public function create(Book $book): void
    {
        DB::transaction(function () use ($book) {
            $bookModel = BookModel::create(BookModelToBookEntityMapper::mapToPersistence($book));

            if ($book->getAuthors()) {
                $authorIds = array_map(function ($author) {
                    return $author->getId();
                }, $book->getAuthors());
                $bookModel->authors()->attach($authorIds);
            }

            if ($book->getSubjects()) {
                $subjectIds = array_map(function ($subject) {
                    return $subject->getId();
                }, $book->getSubjects());
                $bookModel->subjects()->attach($subjectIds);
            }
        });
    }

    public function update(Book $book): void
    {
        DB::transaction(function () use ($book) {
            $bookModel = BookModel::with('authors', 'subjects')->find($book->getId());
            $bookModel->update(BookModelToBookEntityMapper::mapToPersistence($book));

            if ($book->getAuthors()) {
                $authorIds = array_map(function ($author) {
                    return $author->getId();
                }, $book->getAuthors());

                $bookModel->authors()->sync($authorIds);
            }

            if ($book->getSubjects()) {
                $subjectIds = array_map(function ($subject) {
                    return $subject->getId();
                }, $book->getSubjects());

                $bookModel->subjects()->sync($subjectIds);
            }
        });
    }

    public function delete(string $code): void
    {
        BookModel::where('Codl', $code)->delete();
    }
}