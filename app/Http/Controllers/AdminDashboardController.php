<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use App\Services\CategoryService;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    protected QuestionService $questionService;
    protected CategoryService $categoryService;

    public function __construct(QuestionService $questionService, CategoryService $categoryService)
    {
        $this->questionService = $questionService;
        $this->categoryService = $categoryService;
    }
    public function home(){
        $users = User::query()->where('user_type', 'user')->get();
        $categories = Category::query()->get();
        $questions = Question::query()->get();

        return view('admin.home', compact('users', 'categories', 'questions'));
    }


    public function users()
    {
        $users = User::query()->where('user_type', 'user')->paginate(50);
        return view('admin.users.index', compact('users'));
    }
}
