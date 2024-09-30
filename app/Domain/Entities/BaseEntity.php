<?php

namespace App\Domain\Entities;

use Symfony\Component\Uid\Ulid;

class BaseEntity
{
    protected $id;

    public function __construct()
    {
        $this->id = (new Ulid())->toRfc4122();
    }

    public function getId(): string
    {
        return $this->id;
    }
}