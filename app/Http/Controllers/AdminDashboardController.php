<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function home(){
        return view('admin.home');
    }


    public function users()
    {
        return view('admin.users');
    }
}
