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

    public static function getLatestByConnectTime($appliesUser)
    {
        $result = null;
        foreach($appliesUser as $applyUser)
        {
            $apply = Apply::find($applyUser->apply_id);
            if($result === null || $result->connect_time < $apply->connect_time)
                $result = $apply;
        }
        return $result;
    }

    public function setMarkBy(User $user, $mark)
    {
        $this->{Roles::getNameOfNum($user->role_id) . "_rate"} = $mark;
    }

    public function setCommentBy(User $user, $comment)
    {
        $this->{Roles::getNameOfNum($user->role_id) . "_comment"} = $comment;
    }
}
