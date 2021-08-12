<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class ErrorController extends Controller
{
    public function not_found()
    {
        return view('error.404_not_found');
    }

    public function forbidden()
    {
        return view('error.403_forbidden');
    }
    public function suspend()
    {
        return view('error.suspend');
    }
    public function coming_soon()
    {
        return view('error.coming_soon');
    }
}
