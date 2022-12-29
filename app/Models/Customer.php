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

    public function getRoleName() {return "Заказчик";}
}
