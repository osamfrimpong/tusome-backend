<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class QuestionController extends Controller
{
    protected QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->questionService->getAll();

        if (request()->expectsJson()) {
            // API response
            return response()->json($result);
        }

        // Web response
        if ($result['status'] === 'success') {
            return view('admin.questions.index', ['questions' => $result['data']]);
        } else {
            return view('admin.questions.index')->with('error', $result['message']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $categories = Category::whereNull('parent_id')->get();
        $subCategories = collect();

        if ($request->has('category_id')) {
            $subCategories = Category::where('parent_id', $request->input('category_id'))->get();
        }

        return view('admin.questions.create', compact('categories', 'subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'question_content' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (json_decode($value) === null) {
                        $fail('The '.$attribute.' must be a valid JSON string.');
                    }
                },
            ],
            'is_active' => 'required|boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($validation->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
            }
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }

        $data = $request->only(['category_id', 'sub_category_id', 'year', 'is_active', 'published_at']);
        $data['question_content'] = json_decode($request->get('question_content'), true);

        $result = $this->questionService->create($data);

        if ($result['status'] === 'success') {
            return redirect()->route('admin.questions.index')->with('success', 'Question created successfully.');
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $result = $this->questionService->getById($question->id);

        if (request()->expectsJson()) {
            // API response
            return response()->json($result);
        }

        if ($result['status'] === 'success') {
            return view('admin.questions.show', ['question' => $result['data']]);
        } else {
            return view('admin.questions.show')->with('error', $result['message']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $categories = Category::whereNull('parent_id')->get();
        $subCategories = Category::where('parent_id', $question->category_id)->get();

        return view('admin.questions.edit', compact('question', 'categories', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $validation = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'question_content' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (json_decode($value) === null) {
                        $fail('The '.$attribute.' must be a valid JSON string.');
                    }
                },
            ],
            'is_active' => 'required|boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($validation->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
            }
            return redirect()->back()->withInput()->withErrors($validation->errors());
        }

        $data = $request->only(['category_id', 'sub_category_id', 'year', 'is_active', 'published_at']);
        $data['question_content'] = json_decode($request->get('question_content'), true);

        $result = $this->questionService->update($data, $question->id);

        if ($result['status'] === 'success') {
            return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully.');
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $result = $this->questionService->deleteById($question->id);

        if ($result['status'] === 'success') {
            return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully.');
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function getSubCategories($categoryId)
    {
        $subCategories = Category::where('parent_id', $categoryId)->get();
        return response()->json($subCategories);
    }
}
