<?php

namespace App\Services;


use App\Interfaces\CategoryRepositoryInterface;


class CategoryService{

    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }



    public function getAll(){
        $categories = $this->categoryRepository->all();
        if($categories){
            return ['status' => 'success', 'data' => $categories];
        }
        return ['status' => 'fail', 'message' => "could not find any category"];
    }

    public function create(array $data){
        $category = $this->categoryRepository->create($data);
        if($category){
            return ['status' => 'success', 'data' => $category];
        }
        return ['status' => 'fail', 'message' => "could not create category"];
    }

    public function getById($id){
        $category = $this->categoryRepository->find($id);

        if($category){
            return ['status' => 'success', 'data' => $category];
        }
        return ['status' => 'fail', 'message' => "category not found"];
    }

    public function update(array $data, $id){
        $category = $this->categoryRepository->update($data, $id);
        if($category){
            return ['status' => 'success', 'data' => $category];
        }
        return ['status' => 'fail', 'message' => "could not update category"];
    }

    public function deleteById($id){
        $category = $this->categoryRepository->find($id);
        if($category){
            if($this->categoryRepository->delete($id))
            {
                return ['status' => 'success', 'message' => "category successfully deleted"];
            }
            return ['status' => 'fail', 'message' => "category not be deleted"];
        }
        return ['status' => 'fail', 'message' => "category not found"];
    }
}
