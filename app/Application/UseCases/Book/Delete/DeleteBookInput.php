<?php

namespace App\Application\UseCases\Book\Delete;

class DeleteBookInput
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}