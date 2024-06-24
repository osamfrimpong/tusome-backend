<?php

namespace App\Repositories;

use App\Interfaces\QuestionRepositoryInterface;
use App\Models\Question;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function all()
    {
        return Question::all();
    }

    public function find($id)
    {
        return Question::findOrFail($id);
    }

    public function create(array $data)
    {
        return Question::create($data);
    }

    public function update(array $data, $id)
    {
        $question = Question::findOrFail($id);
        return $question->update($data);
    }

    public function delete($id)
    {
        $question = Question::findOrFail($id);
        return $question->delete();
    }
}
