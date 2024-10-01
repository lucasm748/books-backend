<?php

namespace App\Application\UseCases\Subject\Update;

class UpdateSubjectInput
{
    public $id;
    public $description;

    public function __construct($id, $description)
    {
        $this->id = $id;
        $this->description = $description;
    }
}