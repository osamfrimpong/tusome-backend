<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

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
        $result = $this->categoryService->getAll();

        if (request()->expectsJson()) {
            // API response
            return response()->json($result);
        }

        // Web response
        if ($result['status'] === 'success') {
            return view('admin.categories.index', ['categories' => $result['data']]);
        } else {
            return view('admin.categories.index')->with('error', $result['message']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'parent_id' => 'nullable|exists:categories,id',
            'is_active' => 'required|boolean',
        ]);

        if ($validation->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
            }
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'parent_id' => $request->input('parent_id'),
            'is_active' => $request->input('is_active'),
        ];

        $result = $this->categoryService->create($data);

        if ($result['status'] === 'success') {
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $result = $this->categoryService->getById($category->id);

        if (request()->expectsJson()) {
            // API response
            return response()->json($result);
        }

        if ($result['status'] === 'success') {
            return view('admin.categories.show', ['category' => $result['data']]);
        } else {
            return view('admin.categories.show')->with('error', $result['message']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'parent_id' => 'nullable|exists:categories,id',
            'is_active' => 'required|boolean',
        ]);

        if ($validation->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
            }
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'parent_id' => $request->input('parent_id'),
            'is_active' => $request->input('is_active'),
        ];

        $result = $this->categoryService->update($data, $category->id);

        if ($result['status'] === 'success') {
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $result =  $this->categoryService->deleteById($category->id);

        if ($result['status'] === 'success') {
            return redirect()->route('admin.categories.index')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

   public function getSubCategories($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $subcategories = $category->children()->get();

        return response()->json(['subcategories' => $subcategories]);
    }
}
