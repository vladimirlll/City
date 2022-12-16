<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Specialist extends User
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';


    public static function find($id)
    {
        return DB::table('users')->where('id', $id)->first();
    }
}
