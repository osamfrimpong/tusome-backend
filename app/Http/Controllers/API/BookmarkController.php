<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Services\BookmarkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookmarkController extends Controller
{
    protected BookmarkService $bookmarkService;

    public function __construct(BookmarkService $bookmarkService)
    {
        $this->bookmarkService = $bookmarkService;
    }

    /**
     * Display a listing of the resource
     */
    public function index()
    {
        $userId = auth()->id();  
        return $this->bookmarkService->getAll($userId);
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'question_id' => 'required|integer|exists:questions,id',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
        }

        $data = [
            'user_id' => auth()->id(), 
            'question_id' => $request->get('question_id'),
        ];

        return $this->bookmarkService->create($data);
    }

    /**
     * Display the specified resource
     */
    public function show(Bookmark $bookmark)
    {
        return $this->bookmarkService->getById($bookmark->id);
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Bookmark $bookmark)
    {
        $validation = Validator::make($request->all(), [
            'question_id' => 'required|integer|exists:questions,id',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validation->errors()->all()]);
        }

        $data = [
            'question_id' => $request->get('question_id'),
        ];

        return $this->bookmarkService->update($data, $bookmark->id);
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(Bookmark $bookmark)
    {
        return $this->bookmarkService->deleteById($bookmark->id);
    }
}
