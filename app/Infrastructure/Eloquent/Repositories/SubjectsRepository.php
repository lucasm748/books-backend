<?php

namespace App\Infrastructure\Eloquent\Repositories;

use App\Domain\Entities\Subject;
use App\Domain\Exceptions\SubjectDeleteException;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use App\Infrastructure\Eloquent\Models\SubjectModel;


class SubjectsRepository implements ISubjectsRepository
{
    public function getAll(): array
    {
        $subjects = SubjectModel::all();

        return $subjects->map(function ($subject) {
            return Subject::create($subject->id, $subject->description);
        })->toArray() ?? [];
    }

    public function getById(string $id): ?Subject
    {
        $subject = SubjectModel::find($id);

        if (!$subject) {
            return null;
        }

        return Subject::create($subject->id, $subject->description);
    }

    public function getByIds(array $ids): array
    {
        $subjects = SubjectModel::whereIn('CodAs', $ids)->get();

        return $subjects->map(function ($subject) {
            return Subject::create($subject->id, $subject->description);
        })->toArray() ?? [];
    }

    public function getByDescription(string $description): array
    {
        $subjects = SubjectModel::where('Descricao', 'like', "%$description%")->get();

        return $subjects->map(function ($subject) {
            return Subject::create($subject->id, $subject->description);
        })->toArray() ?? [];
    }

    public function create(Subject $subject): void
    {
        SubjectModel::create([
            'CodAs' => $subject->getId(),
            'Descricao' => $subject->getDescription()
        ]);
    }

    public function update(Subject $subject): void
    {
        SubjectModel::where('CodAs', $subject->getId())->update([
            'Descricao' => $subject->getDescription()
        ]);
    }

    public function delete(string $code): void
    {
        try {
            SubjectModel::where('CodAs', $code)->delete();
        } catch (\Exception $e) {
            throw new SubjectDeleteException();
        }
    }
}