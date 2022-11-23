<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Skill_User extends Model
{
    use HasFactory;

    public function skill()
    {
        return $this->belongsTo('skills');
    }

    public function specialist()
    {
        return $this->belongsTo('users');
    }
}
