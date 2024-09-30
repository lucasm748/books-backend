<?php

namespace App\Infrastructure\Http\Controllers\Author\GetAll;

use App\Domain\Entities\Author;
use JsonSerializable;


class GetAuthorsResponse implements JsonSerializable
{
    public array $authors;

    public function __construct(array $authors)
    {
        $this->authors = $authors;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'authors' => array_map(function (Author $author) {
                return [
                    'id' => $author->getId(),
                    'name' => $author->getName(),

                ];
            }, $this->authors)
        ];
    }
}
