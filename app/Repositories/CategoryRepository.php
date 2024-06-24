<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::all();
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        $category = Category::findOrFail($id);
        return $category->update($data);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }
}
