<?php

namespace App\Domain\Exceptions;

class SubjectDeleteException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Ocorreu um erro ao tentar remover o assunto");
    }
}