<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //
    public function show()
    {
        $russianCities = City::where('country_id', '=', 
        Country::where('name', '=', 'Russia')->get()[0]->id)->get()->count();
        echo 'Городов в России - ' . $russianCities;
    }
}
