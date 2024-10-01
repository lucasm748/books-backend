<?php

namespace App\Domain\Exceptions;

class BookDeleteException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Ocorreu um erro ao tentar remover o livro.");
    }
}