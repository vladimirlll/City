<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Specialist;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function all()
    {
        $specialists = Specialist::getAllBuilder()->paginate(3);
        //$specialists->withPath('/catalog/all');
        return view('components.catalog.catalog-page', ['specialists' => $specialists]);
    }
}
