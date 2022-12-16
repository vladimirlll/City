<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Apply_User;
use App\Models\ApplyStatuses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function show($myId, $anotherId)
    {
        $me = User::findOrFail($myId);
        $another = User::findOrFail($anotherId);
        if(Auth::check())
        {
            if(Auth::user()->id == $myId)
            {
                $title = $me->getOutName();

                return view('components.user.review', ['title' => $title, 'me' => $me, 'another' => $another]);
            }
            else abort(404);
        }
        else abort(404);
    }

    public function save(Request $request)
    {
        $appliesUser = Apply_User::getAllOf(Auth::user());
        
        if($appliesUser->isNotEmpty())
        {
            $latestApply = Apply::getLatestByConnectTime($appliesUser);
            if($latestApply->status == ApplyStatuses::STATUSES['ended'])
            {
                $mark = $request->input('mark');
                $comment = $request->input('comment');

                $latestApply->setMarkBy(Auth::user(), $mark);
                $latestApply->setCommentBy(Auth::user(), $comment);
                $latestApply->save();
            }
            else abort(404);
        }
        else abort(404);
        
    }
}
