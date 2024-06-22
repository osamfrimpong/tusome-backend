<?php

namespace App\Services;


use App\Interfaces\CategoryRepositoryInterface;


class CategoryService{

    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
}
