<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use Carbon\Carbon; 
use App\Student;
use App\Event;
use App\EventFor;
use App\EventParticipant;
use Alert;
use DateTime;
use App\Mail\EventJoinMail;



class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Carbon::today()->toDateString();
        // Alert::message('Welcome Back!');
        $event_fors = DB::table('events')
                    ->select("event_id", "department_id", "departments.alias", "departments.colour")
                    ->leftJoin('event_fors', 'events.id', '=', 'event_fors.event_id')
                    ->leftJoin('departments', 'event_fors.department_id', '=', 'departments.id')
                    ->where('datetime', '>', Carbon::today()->toDateString())
                    ->orderBy('datetime', 'asc')
                    ->get();
        $events = Event::where('datetime', '>', Carbon::today()->toDateString())
                        ->where('datetime', '<=', "datetime - INTERVAL 3 DAY")
                        ->orderBy('datetime', 'asc')
                        ->get();
        if(Auth::check()){
            $profile = Student::find(Auth::user()->profile_id);
            return view('index')->with('profile', $profile)
                                ->with('events', $events)
                                ->with('event_fors', $event_fors);;
        }
        else {
            return view('index')->with('events', $events)
                                ->with('event_fors', $event_fors);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $fors = EventFor::where('event_id', $id)->get();
        $profile = Student::findOrFail(Auth::user()->profile_id);
        $same = 0;

        if($event->public){
            $same = 1;
        }
        foreach($fors as $for){
            if($for->department_id == $profile->department_id){
                $same = 1;
            }
        }
        if($same == 1){
            if($event->pay){
                $joined = Voucher::where('event_id', $id)
                                 ->where('participant_id', $profile->id);
                if($joined == null){
                    $voucher = new Voucher();
                    $voucher->event_id = $id;
                    $voucher->participant_id = Auth::user()->profile_id;
                    $voucher->status = Auth::user()->status;
                    $voucher->price = $event->price;
                    $voucher->receipt_date = Carbon::now();
                    Mail::to($profile->email)->send(new EventJoinMail($profile->name));
                }
            }
            else {
                $joined = EventParticipant::where('event_id', $id)
                                          ->where('participant_id', $profile->id);
                if($joined == null){
                    $participation = new EventParticipant();
                    $participation->event_id = $event->id;
                    $participation->participant_id = Auth::user()->profile_id;
                    $participation->barcode = $event->id . '-' . Auth::user()->profile_id;
                    $participation->save();
                    Alert::success('Thank you for your participation!');
                }
                else {
                    Alert::error('Sorry, You have already joined', 'Oops!');
                }
            }
            return redirect('/');
        }
        else {
            Alert::error('This event is not for your department.');
            return redirect('/');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
