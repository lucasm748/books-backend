<?php

namespace App\Application\UseCases\Subject\GetById;

use App\Domain\Entities\Subject;

class GetSubjectByIdOutput
{
    public Subject $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }
}