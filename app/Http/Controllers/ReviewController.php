<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Apply_User;
use App\Models\ApplyStatuses;
use App\Models\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private function canReview(User $from, User $to)
    {
        $appliesOfFrom = $from->getApplies();
        $appliesOfFrom = $appliesOfFrom->sortBy('connect_time');
        if($appliesOfFrom->isNotEmpty())
        {
            $latestApply = $appliesOfFrom->last();
            if($latestApply->status == ApplyStatuses::STATUSES['ended'])
            {
                return true;
            }
            else return false;
        }
        else return false;
    }

    public function show($myId, $anotherId)
    {
        $me = User::getInstance($myId);
        $another = User::getInstance($anotherId);
        if(Auth::check())
        {
            if(Auth::user()->id == $myId && $this->canReview($me, $another))
            {
                $title = $me->getOutName();
                $appliesUsers = Apply_User::getAllOf($me, $another);
                $latestApply = Apply::getLatestByConnectTime($appliesUsers);
                return view('components.user.review', ['title' => $title, 'me' => $me, 'another' => $another, 'apply' =>$latestApply]);
            }
            else return view('components.review.cant-review');
        }
        else abort(404);
    }

    public function save(Request $request, $applyId, $meId, $anotherId)
    {
        $apply = Apply::findOrFail($applyId);
        $au = Apply_User::where('apply_id', $apply->id)->first();
        $me = User::getInstance($meId);
        $another = User::getInstance($anotherId);
        if($me === null || $another == null) abort(404);
        $appliesUser = Apply_User::getAllOf(User::getInstance($au->customer_id), User::getInstance($au->specialist_id));
        
        if($appliesUser->isNotEmpty())
        {
            $latestApply = Apply::getLatestByConnectTime($appliesUser);
            if($latestApply->status == ApplyStatuses::STATUSES['ended'])
            {
                $mark = $request->input('mark');
                $comment = $request->input('comment');

                $latestApply->setMarkBy($me, $mark);
                $latestApply->setCommentBy($me, $comment);
                $latestApply->save();
                return redirect()->route('profile', ['id' => $another->id]);
            }
            else abort(404);
        }
        else abort(404);
    }
}
