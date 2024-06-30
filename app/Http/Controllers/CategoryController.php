<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->categoryService->getAll();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'parentId' => 'nullable|numeric',
            'isActive' => 'required|boolean',

        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
        }
        $data = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'parent_id' => $request->get('parentId'),
            'is_active' => $request->get('isActive'),
        ];

        return $this->categoryService->create($data);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->categoryService->getById($category->id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'parentId' => 'nullable|numeric',
            'isActive' => 'required|boolean',

        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
        }
        $data = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'parent_id' => $request->get('parentId'),
            'is_active' => $request->get('isActive'),
        ];

        return $this->categoryService->update($data, $category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        return $this->categoryService->deleteById($category->id);
    }
}
