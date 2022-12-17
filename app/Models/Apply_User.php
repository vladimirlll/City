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
        return User::getInstance($this->customer_id);
    }

    public function getSpecialist()
    {
        return User::getInstance($this->specialist_id);
    }

    public static function getAllOf(User $firstUser, User $secondUser)
    {
        $appliesUser = Apply_User::where(Roles::getNameOfNum($firstUser->role_id) . "_id", $firstUser->id)
        ->where(Roles::getNameOfNum($secondUser->role_id) . "_id", $secondUser->id)->get();
        return $appliesUser;
    }
}
