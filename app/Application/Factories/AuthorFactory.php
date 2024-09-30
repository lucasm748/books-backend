<?php

namespace App\Application\Factories;

use App\Domain\Entities\Author;
use Symfony\Component\Uid\Ulid;

class AuthorFactory
{
    public static function create(string $name): Author
    {
        return new Author((new Ulid())->toRfc4122(), $name);
    }
}
