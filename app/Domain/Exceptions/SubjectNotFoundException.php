<?php

namespace App\Domain\Exceptions;

use Exception;

class SubjectNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Assunto não encontrado');
    }
}