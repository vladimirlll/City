<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function show(Request $request)
    {
        return view('components.home.page');
    }
}
