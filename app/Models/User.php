<?php

namespace App\Models;

use App\Exceptions\CommentNotSetException;
use App\Exceptions\MarkNotSetException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

abstract class User extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function role()
    {
        return Role::find($this->role_id);
    }

    public function skill_user()
    {
        return $this->belongsTo(Skill_User::class);
    }

    public function specialization_user()
    {
        return $this->belongsTo(Specialization_User::class);
    }

    public function apply_user()
    {
        return $this->belongsTo(Apply_User::class);
    }

    public function getApplies() : Collection
    {
        $applyUserCol = null;
        if($this->role()->name == 'customer')
        {
            $applyUserCol = Apply_User::where('customer_id', $this->id)->get();
        }
        else
        {
            $applyUserCol = Apply_User::where('specialist_id', $this->id)->get();
        }

        $applies = collect();
        foreach($applyUserCol as $applyUser)
        {
            $apply = Apply::find($applyUser->apply_id);
            $conTime = strtotime($apply->connect_time);
            $endTime = time() + Zoom_Api::PLUS_TIME; 
            if(!is_null($apply->connect_time) && $conTime <= $endTime) 
            {
                $apply->status = ApplyStatuses::STATUSES['ended'];
                $apply->save();
            }
            $applies->push($apply);
        }

        return $applies;
    }

    public abstract function getRoleName();

    public function getOutName() : string
    {
        $result = "";
        if(!empty($this->surname) && !empty($this->name) && !empty($this->patronymic))
        {
            $result = $this->surname . " " . mb_substr($this->name, 0, 1, "UTF-8") . ". " . mb_substr($this->patronymic, 0, 1, "UTF-8") . ".";
        }
        else 
        {
            $result = $this->email;
        }
        return $result;
    }

    public function getMarks() : Collection
    {
        $marks = collect();

        $myApplies = $this->getApplies();
        foreach($myApplies as $apply)
        {
            try 
            {
                $anotherUserMarkOfMe = $apply->getMarkOfAnotherUser($this);
                $marks->push($anotherUserMarkOfMe);
            } catch (MarkNotSetException $ex) { }
        }

        return $marks;
    }

    public function getAvgMark() : float 
    {
        $avg = 0;

        $allMyMarks = $this->getMarks();
        if($allMyMarks->count() != 0)
        {
            $sumMarks = $allMyMarks->sum();
            $avg = $sumMarks / $allMyMarks->count();
        }

        return $avg;
    }

    public function getComments() : Collection 
    {
        $comments = collect();

        $myApplies = $this->getApplies();
        foreach($myApplies as $apply)
        {
            try 
            {
                $anotherUserCommentOfMe = $apply->getCommentOfAnotherUser($this);
                $comments->push($anotherUserCommentOfMe);
            } catch (CommentNotSetException $ex) {}
        }

        return $comments;
    }

    public function reviews() : Collection
    {
        $reviews = collect();

        $myApplies = $this->getApplies();
        foreach($myApplies as $apply)
        {
            $mark = null;
            $comment = null;
            $reviewBy = null;

            try 
            {
                $anotherUserMarkOfMe = $apply->getMarkOfAnotherUser($this);
                $mark = $anotherUserMarkOfMe;
            } catch (MarkNotSetException $ex) { }

            try 
            {
                $anotherUserCommentOfMe = $apply->getCommentOfAnotherUser($this);
                $comment = $anotherUserCommentOfMe;
            } catch (CommentNotSetException $ex) {}

            $reviewBy = $apply->getInterlocutorOf($this);
            $reviews->push(new Review($reviewBy, $apply, $mark, $comment));
        }

        return $reviews;
    }

    public static function getInstance($id) : User
    {
        $userWithOnlyRoleId = DB::table('users')->where('id', $id)->select('role_id')->first();
        if($userWithOnlyRoleId === null) abort(4040);
        $roleId = $userWithOnlyRoleId->role_id;
        if($roleId === null) abort(404);
        else 
        {
            /*if($roleId == Roles::ROLES['customer']) return Customer::find($id);
            elseif($roleId == Roles::ROLES['specialist']) return Specialist::find($id);
            else abort(404);
            */

            
            $className = "App\\Models\\";
            $className .= ucfirst(Roles::getNameOfNum($roleId));
            $user = $className::find($id);
            return $user;
        }
        
    }

    public function getAvatarSrc() : string 
    {
        if(Storage::exists('/public/images/users/avatars/' . $this->id))
            return Storage::url('images/users/avatars/' . $this->id);
        else 
            return Storage::url('images/users/avatars/default_avatar.jpg');
    }
}
