<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization_User extends Model
{
    use HasFactory;

    public function specialization()
    {
        return $this->belongsTo('specializations');
    }

    public function specialist()
    {
        return $this->belongsTo('users');
    }
}
