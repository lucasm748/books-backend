<?php

namespace App\Domain\Exceptions;

class AuthorHasBooksException  extends \Exception
{
    public function __construct()
    {
        parent::__construct("O autor está sendo utilizado em um ou mais livros");
    }
}