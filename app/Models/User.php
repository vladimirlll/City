<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;

    public function city()
    {
        return $this->belongsTo('cities');
    }

    public function role()
    {
        return $this->belongsTo('roles');
    }

    public function skill_user()
    {
        return $this->belongsTo('skill_user');
    }

    public function specialization_user()
    {
        return $this->belongsTo('specialization_user');
    }

    public function apply_user()
    {
        return $this->belongsTo('apply_user');
    }
}
