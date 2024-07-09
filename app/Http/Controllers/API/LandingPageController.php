<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{

    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function home()
    {


        $categories = Category::with('questions')->whereHas('questions')->limit(4)->get();

        return response()->json(["categories" => $categories]);

    }

    public function categories()
    {
        return $this->categoryService->getAll();
    }


    public function about()
    {

    }
}
