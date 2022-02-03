<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function indexhome()
    {
        return view('/internal/home/index');
    }
    
    public function indexcompleteprofile()
    {
        return view('/internal/completeprofile');
    }
}
