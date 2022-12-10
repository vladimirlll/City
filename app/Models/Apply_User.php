<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply_User extends Model
{
    use HasFactory;

    public function apply()
    {
        return $this->belongsTo(Apply::class);
    }

    public function getCustomer()
    {
        return User::find($this->customer_id);
    }

    public function getSpecialist()
    {
        return User::find($this->specialist_id);
    }
}
