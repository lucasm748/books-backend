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
            'assuntos' => array_map(function (Subject $subject) {
                return [
                    'codigo' => $subject->getId(),
                    'descricao' => $subject->getDescription(),

                ];
            }, $this->subjects)
        ];
    }
}