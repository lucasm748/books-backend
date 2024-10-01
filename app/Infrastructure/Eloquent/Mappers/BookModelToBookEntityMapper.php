<?php

namespace App\Infrastructure\Eloquent\Mappers;

use App\Domain\Entities\Book;
use App\Domain\Payloads\CreateBookPayload;
use App\Infrastructure\Eloquent\Models\BookModel;

class BookModelToBookEntityMapper
{
    public static function mapToDomain(BookModel $model): Book
    {
        $bookPayload = new CreateBookPayload(
            $model->Titulo,
            $model->Editora,
            $model->Edicao,
            $model->AnoPublicacao,
            $model->Preco,
            $model->authors->map(fn($author) => [
                'id' => $author->id,
                'name' => $author->name,
            ])->toArray(),
            $model->subjects->map(fn($subject) => [
                'id' => $subject->id,
                'description' => $subject->description,
            ])->toArray()
        );

        return Book::create($model->id, $bookPayload);
    }

    public static function mapToPersistence(Book $entity): array
    {
        return [
            'Codl' => $entity->getId(),
            'Titulo' => $entity->getTitle(),
            'Editora' => $entity->getPublisher(),
            'Edicao' => $entity->getEdition(),
            'AnoPublicacao' => $entity->getPublicationYear(),
            'Preco' => $entity->getPrice(),
        ];
    }
}