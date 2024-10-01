<?php

namespace App\Domain\Exceptions;

class SubjectHasBooksException extends \Exception
{
    public function __construct()
    {
        parent::__construct("O assunto está sendo utilizado em um ou mais livros");
    }
}