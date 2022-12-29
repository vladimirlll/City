<?php

namespace App\Models;

use App\Exceptions\CommentNotSetException;
use App\Exceptions\MarkNotSetException;
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

    public function getMarkOfAnotherUser(User $user) : int
    {
        $mark = 0;
        if($user->role_id == Roles::ROLES['customer']) $mark = $this->specialist_rate;
        else $mark = $this->customer_rate;

        if($mark == null) throw new MarkNotSetException("Оценка от другого пользователя не установлена", 600);

        return $mark;
    }

    public function getCommentOfAnotherUser(User $user) : string 
    {
        $comment = "";

        if($user->role_id == Roles::ROLES['customer']) $comment = $this->specialist_comment;
        else $comment = $this->customer_comment;

        if($comment == null) throw new CommentNotSetException("Комментарий от другого пользователя не задан", 601);

        return $comment;
    }

    public function getMarkOfThisUser(User $user) : int 
    {
        $mark = $this->{Roles::getNameOfNum($user->role_id) + "_rate"};
        if($mark == null) throw new MarkNotSetException("Оценка не установлена", 600); 
        return $mark;
    }

    public function getCommentOfThisUser(User $user) : string 
    {
        $comment = $this->{Roles::getNameOfNum($user->role_id) + "_comment"};
        if($comment == null) throw new CommentNotSetException("Комментарий от другого пользователя не задан", 601);
        return $comment;
    }

    public function getInterlocutorOf(User $user) : User 
    {
        $au = Apply_User::where('apply_id', $this->id)->first();
        if($user->role_id == Roles::ROLES['customer']) return User::getInstance($au->specialist_id);
        else return User::getInstance($au->customer_id);
    }
}
