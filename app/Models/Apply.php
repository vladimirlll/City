<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    public function getPlatform() 
    {
        return Platform::find($this->platform_id);
    }

    public function apply_user() : Apply_User
    {
        return Apply_User::where('apply_id', $this->id)->first();
    }
}
