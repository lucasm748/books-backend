<?php

namespace App\Domain\Exceptions;

class AuthorDeleteException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Ocorreu um erro ao tentar remover o autor");
    }
}