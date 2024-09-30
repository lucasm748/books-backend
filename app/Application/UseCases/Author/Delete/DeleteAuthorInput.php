<?php

namespace App\Application\UseCases\Author\Delete;

class DeleteAuthorInput
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}