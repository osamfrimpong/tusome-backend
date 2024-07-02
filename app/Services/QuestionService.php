<?php

namespace App\Services;

use App\Interfaces\QuestionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class QuestionService{
    protected QuestionRepositoryInterface $questionRepository;

    public function __construct(QuestionRepositoryInterface $questionRepository){
        $this->questionRepository = $questionRepository;
    }

    /**
     * Get all questions
     * Returns a list of all questions
     */
    public function getAll(){
        $questions = $this->questionRepository->all();
        if($questions){
            return ['status' => 'success', 'data' => $questions];
        }
        return ['status' => 'fail', 'message' => "could not find any questions"];
    }

    /**
     * Create a new question
     * Creates a new question with the provided data and returns it
     */
    public function create(array $data){
        $user = Auth::user();
        $data['user_id'] = $user->id;
        $question = $this->questionRepository->create($data);
        if($question){
            return ['status' => 'success', 'data' => $question];
        }
        return ['status' => 'fail', 'message' => "could not create question"];
    }

    /**
     * Get a question by its ID
     * Retrieves a specific question by its ID
     */
    public function getById($id){
        $question = $this->questionRepository->find($id);
        if($question){
            return ['status' => 'success', 'data' => $question];
        }
        return ['status' => 'fail', 'message' => "question not found"];
    }

    /**
     * Update a question
     * Updates the specified question with the provided data and returns the updated question
     */
    public function update(array $data, $id){
        $question = $this->questionRepository->update($data, $id);
        if($question){
            return ['status' => 'success', 'data' => $question];
        }
        return ['status' => 'fail', 'message' => "could not update question"];
    }

    /**
     * Delete a question by its ID
     * Deletes the specified question and returns a success or failure message
     */
    public function deleteById($id){
        $question = $this->questionRepository->find($id);
        if($question){
            if($this->questionRepository->delete($id)){
                return ['status' => 'success', 'message' => "question successfully deleted"];
            }
            return ['status' => 'fail', 'message' => "question could not be deleted"];
        }
        return ['status' => 'fail', 'message' => "question not found"];
    }
}
