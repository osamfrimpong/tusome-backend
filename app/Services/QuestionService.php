<?php

namespace App\Services;

use App\Interfaces\QuestionRepositoryInterface;


class QuestionService{
    protected QuestionRepositoryInterface $questionRepository;

    public function __construct(QuestionRepositoryInterface $questionRepository){
        $this->questionRepository = $questionRepository;
    }
}
