<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Role;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function show()
    {
        dump(Role::where('name', '=', 'Специалист')->get()->count());
        //dump(Role::where('name', '=', 'Специалист')->get()[0]->id);
    }
}
