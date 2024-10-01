<?php

namespace App\Infrastructure\Http\Controllers\Subject\GetById;

use App\Domain\Entities\Subject;
use JsonSerializable;


class GetSubjectByIdResponse implements JsonSerializable
{
    public Subject $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'subject' => [
                'id' => $this->subject->getId(),
                'description' => $this->subject->getDescription(),
            ]
        ];
    }
}