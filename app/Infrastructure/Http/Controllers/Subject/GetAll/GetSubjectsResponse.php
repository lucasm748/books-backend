<?php

namespace App\Infrastructure\Http\Controllers\Subject\GetAll;

use App\Domain\Entities\Subject;
use JsonSerializable;


class GetSubjectsResponse implements JsonSerializable
{
    public array $subjects;

    public function __construct(array $subjects)
    {
        $this->subjects = $subjects;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'subjects' => array_map(function (Subject $subject) {
                return [
                    'id' => $subject->getId(),
                    'description' => $subject->getDescription(),

                ];
            }, $this->subjects)
        ];
    }
}