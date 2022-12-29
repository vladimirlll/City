<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\ApplyInfo;
use App\Models\ApplyStatuses;
use App\Models\Auth;
use App\Models\User;
use App\Models\Zoom_Api;
use DateTime;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    //
    public function show($id, $consId)
    {
        if(Auth::check())
        {
            if(Auth::user()->id == $id)
            {
                $user = User::getInstance($id);

                $apply = Apply::findOrFail($consId);

                $platform = $apply->getPlatform();
                $dtime = $apply->connect_time;
                
                $customer = $apply->apply_user()->getCustomer();
                $specialist = $apply->apply_user()->getSpecialist();
                $newApplyInfo = new ApplyInfo($apply, $customer, $specialist);

                return view('components.user.consultation', ['user' => $user, 'consult' => $newApplyInfo]); 
            }
            else abort(404);
        }
        else abort(404);


    }

    function getMetting($response) // возвращаем инфу про митинг
    {
        return "Meeting ID: ". $response->id."<br>"."Time: "	
        . $response->start_time."<br>"."Topic: "	. 
        $response->topic."<br>"."Join URL: ". $response->join_url .
        "<a href='". $response->join_url ."'>Open URL</a>"."<br>"."Meeting Password: ". $response->password;
    }

    public function apply($id, Request $request)
    {
        if(Auth::check())
        {
            // - Пользователь авторизован
            $apply = Apply::find($id);
            if($apply->status == ApplyStatuses::STATUSES['sended'])
            {
                $zoom_meeting = new Zoom_Api();
    
                // входные данные
                $data = array();
                $data['topic'] 		= 'Консультация'; // название конференции
                $consTime = DateTime::createFromFormat('Y-m-d\TH:i:s', $request->input('time'));
                $timestamp = strtotime($request->input('time'));
                //dump($consTime);
                //dd($request->input('time'));
                $timestamp -= 3600 * 4;
                if($timestamp <= time()) return back();
                //$data['start_date'] = date('Y-m-d\TH:i:s', strtotime($request->input('time')));
                $data['start_date'] = date('Y-m-d\TH:i:s', $timestamp);
                $data['duration'] 	= 60; // продолжительность
                $data['type'] 		= 2;
                $data['password'] 	= 'abc'; //пароль
    
    
                $response = $zoom_meeting->createMeeting($data);//создаём митинг
                $apply->connect_time = $request->input('time');
                $apply->platform_id = 2;
                $apply->link = $response->join_url;
                $apply->status = ApplyStatuses::STATUSES['replied'];
                $apply->save();

                echo 'Консультация создана и доступна по ссылке - ' . "<a href=". $response->join_url . ">" ."Ссылка</a>";
            }
            else
            {
                echo 'Консультация создана и доступна по ссылке - ' . "<a href=". $apply->link . ">" ."Ссылка</a>";
            }
        }
        else abort(404);
    }

    public function end($id)
    {
        $apply = Apply::find($id);
        $apply->status = ApplyStatuses::STATUSES['ended'];
        $apply->save();
        return back();
    }
}
