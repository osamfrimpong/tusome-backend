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
        $result = $this->categoryService->getById($category->id);
         $this->categoryService->getAll();

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
    public function destroy(Category $category): RedirectResponse
    {
        $result =  $this->categoryService->deleteById($category->id);

        if ($result['status'] === 'success') {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', ['category' => $category]);
    }
}
