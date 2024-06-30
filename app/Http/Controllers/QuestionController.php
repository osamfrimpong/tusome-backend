<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    protected QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * Display a listing of the resource
     */
    public function index()
    {
        return $this->questionService->getAll();
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'category_id' => 'required|integer|exists:categories,id',
            'subject' => 'required|string',
            'year' => 'required|integer',
            'question_content' => 'required|array',
            'is_active' => 'required|boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
        }

        $data = [
            'category_id' => $request->get('category_id'),
            'subject' => $request->get('subject'),
            'year' => $request->get('year'),
            'question_content' => $request->get('question_content'),
            'is_active' => $request->get('is_active'),
            'published_at' => $request->get('published_at'),
        ];

        return $this->questionService->create($data);
    }

    /**
     * Display the specified resource
     */
    public function show(Question $question)
    {
        return $this->questionService->getById($question->id);
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Question $question)
    {
        $validation = Validator::make($request->all(), [
            'category_id' => 'required|integer|exists:categories,id',
            'subject' => 'required|string',
            'year' => 'required|integer',
            'question_content' => 'required|array',
            'is_active' => 'required|boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
        }

        $data = [
            'category_id' => $request->get('category_id'),
            'subject' => $request->get('subject'),
            'year' => $request->get('year'),
            'question_content' => $request->get('question_content'),
            'is_active' => $request->get('is_active'),
            'published_at' => $request->get('published_at'),
        ];

        return $this->questionService->update($data, $question->id);
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(Question $question)
    {
        return $this->questionService->deleteById($question->id);
    }
}
