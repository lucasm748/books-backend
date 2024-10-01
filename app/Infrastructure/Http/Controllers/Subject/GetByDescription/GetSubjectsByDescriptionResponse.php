<?php

namespace App\Infrastructure\Http\Controllers\Subject\GetByDescription;

use JsonSerializable;

class GetSubjectsByDescriptionResponse implements JsonSerializable
{
    private array $subjects;

    public function __construct(array $subjects)
    {
        $this->subjects = $subjects;
    }

    public function jsonSerialize(): mixed
    {
        return  [
            'assuntos' => array_map(function ($subject) {
                return [
                    'codigo' => $subject->getId(),
                    'descricao' => $subject->getDescription()
                ];
            }, $this->subjects)
        ];
    }
}