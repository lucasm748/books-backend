<?php

namespace App\Domain\Exceptions;

use Exception;

class AuthorNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Autor não encontrado');
    }
}