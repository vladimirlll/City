<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply_User extends Model
{
    use HasFactory;

    public function apply()
    {
        return $this->belongsTo('applies');
    }

    public function customer()
    {
        return $this->belongsTo('users');
    }

    public function specialist()
    {
        return $this->belongsTo('users');
    }
}
