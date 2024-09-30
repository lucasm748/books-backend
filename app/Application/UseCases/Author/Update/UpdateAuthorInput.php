<?php

namespace App\Application\UseCases\Author\Update;

class UpdateAuthorInput
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}