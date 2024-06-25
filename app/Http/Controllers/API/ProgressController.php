<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use App\Services\ProgressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgressController extends Controller
{
    protected ProgressService $progressService;

    public function __construct(ProgressService $progressService)
    {
        $this->progressService = $progressService;
    }

    /**
     * Display a listing of the resource
     */
    public function index()
    {
        $userId = auth()->id();  
        return $this->progressService->getAll($userId);
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'question_id' => 'required|integer|exists:questions,id',
            'status' => 'required|string',
            'score' => 'nullable|integer',
            'completed_at' => 'nullable|date',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
        }

        $data = [
            'user_id' => auth()->id(),
            'question_id' => $request->get('question_id'),
            'status' => $request->get('status'),
            'score' => $request->get('score'),
            'completed_at' => $request->get('completed_at'),
        ];

        return $this->progressService->create($data);
    }

    /**
     * Display the specified resource
     */
    public function show(Progress $progress)
    {
        return $this->progressService->getById($progress->id);
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Progress $progress)
    {
        $validation = Validator::make($request->all(), [
            'question_id' => 'required|integer|exists:questions,id',
            'status' => 'required|string',
            'score' => 'nullable|integer',
            'completed_at' => 'nullable|date',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
        }

        $data = [
            'question_id' => $request->get('question_id'),
            'status' => $request->get('status'),
            'score' => $request->get('score'),
            'completed_at' => $request->get('completed_at'),
        ];

        return $this->progressService->update($data, $progress->id);
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(Progress $progress)
    {
        return $this->progressService->deleteById($progress->id);
    }
}
