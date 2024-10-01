<?php

namespace App\Application\UseCases\Subject\Delete;

class DeleteSubjectInput
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}