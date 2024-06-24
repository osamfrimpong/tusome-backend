<?php

namespace App\Repositories;

use App\Interfaces\ProgressRepositoryInterface;
use App\Models\Progress;

class ProgressRepository implements ProgressRepositoryInterface
{
    public function all($userId)
    {
        return Progress::where('user_id',$userId)->get();
    }

    public function find($id)
    {
        return Progress::findOrFail($id);
    }

    public function create(array $data)
    {
        return Progress::create($data);
    }

    public function update(array $data, $id)
    {
        $progress = Progress::findOrFail($id);
        return $progress->update($data);
    }

    public function delete($id)
    {
        $progress = Progress::findOrFail($id);
        return $progress->delete();
    }
}
