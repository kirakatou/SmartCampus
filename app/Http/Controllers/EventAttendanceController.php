<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\EventParticipant;
use App\Member;
use App\Student;
use Carbon\Carbon; 

class EventAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::All();
        return view('lists/eventAttendance')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signIn($id)
    {
        $event = Event::findOrFail($id);
        return view('forms/sign')->with('event', $event)->with('type', 'in');

    }

    public function signOut($id)
    {
        $event = Event::findOrFail($id);
        return view('forms/sign')->with('event', $event)->with('type', 'ot');
    }

    public function signInStore($id, $token)
    {
        $participant = EventParticipant::where('event_id', $id)
                                 ->where('barcode', $token)
                                 ->get()->last();
        if(count($participant)){
            $participant->signin = '1';
            $participant->in_time = Carbon::now();

            $participant->save();
            if($participant->status = 'GUEST'){
                $profile = Member::findOrFail($participant->participant_id);
            }else {
                $profile = Student::findOrFail($participant->participant_id);
            }
            $data = array('profile'  => $profile,
                          'status' => 'success');
            return $data;
        }else{
            $data = array('status' => 'fail');
            return $data;
        }
    }

    public function signOutStore($id, $token)
    {
        $participant = EventParticipant::where('event_id', $id)
                                 ->where('barcode', $token)
                                 ->get()->last();
        if(count($participant)){
            $participant->signout = '1';
            $participant->out_time = Carbon::now();
            
            $participant->save();
            if($participant->status = 'GUEST'){
                $profile = Member::findOrFail($participant->participant_id);
            }else {
                $profile = Student::findOrFail($participant->participant_id);
            }
            $data = array('profile'  => $profile,
                          'status' => 'success');
            return $data;
        }else{
            $data = array('status' => 'fail');
            return $data;
        }
    }


}
