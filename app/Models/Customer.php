<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends User
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';

    /*public function __construct()
    {
        parent::__construct();
    }
    */

    public function __construct()
    {
        
    }

    public function getDataFromDB($id)
    {
        
    }

    /*public static function find($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        dd($user);
        //return DB::table('users')->where('id', $id)->first();
    }*/
}
