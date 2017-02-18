<?php

namespace App\Http\Controllers;

use Mail;
use Alert;
use DateTime;
use Carbon\Carbon; 
use App\Student;
use App\Voucher;
use App\Event;
use App\EventFor;
use App\EventParticipant;
use App\Mail\EventJoinMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        if(Auth::user()->status = 'GUEST'){
            if(Auth::user()->activated = '1'){
                $verified = 1;
                $profile = Member::findOrFail(Auth::user()->profile_id);
            }
        }else {
            $verified = 1;
            $profile = Student::findOrFail(Auth::user()->profile_id);
        }
        $verified = 0;
        if($verified == 1){
            $same = 0;
            if($event->public){
                $same = 1;
            }
            else {
                foreach($fors as $for){
                    if($for->department_id == $profile->department_id){
                        $same = 1;
                    }
                }
            }
            
            if($same == 1){
                if($event->pay){
                    $pending_participant = DB::table('vouchers')
                                            ->leftJoin('event_participants', 'vouchers.participant_id', '=', 'event_participants.participant_id')
                                            ->whereNull('event_participants.id')
                                            ->where(DB::raw('DATE_ADD(created_at, INTERVAL 1 DAY)'), '>', Carbon::now())
                                            ->count();
                    $fixed_participant = EventParticipant::where('event_id', $id)->count();
                    if(($pending_participant + $fixed_participant) < $event->capacity){
                        $joined = Voucher::where('event_id', $id)
                                     ->where('participant_id', $profile->id)
                                     ->where(DB::raw('DATE_ADD(created_at, INTERVAL 1 DAY)'), '>', Carbon::now())
                                     ->count();
                        if($joined == 0){
                            $voucher = new Voucher();
                            $voucher->event_id = $id;
                            $voucher->participant_id = Auth::user()->profile_id;
                            $voucher->status = Auth::user()->status;
                            $voucher->price = $event->price;
                            $voucher->receipt_date = Carbon::now();
                            $voucher->save();
                            $voucher->no = 'SC-' . sprintf("%06d", $voucher->id);
                            $voucher->save();
                            Mail::to($profile->email)->send(new EventJoinMail($profile->name));
                            Alert::message('Please confirm your invoice on your email', 'Thanks for your participation!')->persistent('Close');
                        }else {
                            Alert::error('Sorry, You have already joined', 'Oops!');
                        }
                    }
                    
                }
                else {
                    $participant = EventParticipant::where('event_id', $id)->count();
                    if($participant < $event->capacity){
                        $joined = EventParticipant::where('event_id', $id)
                                                  ->where('participant_id', $profile->id)
                                                  ->count();;
                        if($joined == 0){
                            $participation = new EventParticipant();
                            $participation->event_id = $event->id;
                            $participation->participant_id = Auth::user()->profile_id;
                            $participation->barcode = $event->id . "/" . Auth::user()->profile_id;
                            $participation->save();
                            Alert::success('Thanks for your participation!');
                        }
                        else {
                            Alert::error('Sorry, You have already joined', 'Oops!');
                        }
                    }
                    else {
                        Alert::error('Sorry, Event already Full', 'Oops!');
                    }
                }
            }
            else {
                Alert::error('This event is not for your department.');
                
            }
        }
        else {
            Alert::error('Please Verify your account first', 'Oops!');
        }
        return redirect('/');
        
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

    public function verify($token)
    {
        $activation = UserActivation::where('token', $token)->get()->last();
        $user = User::findOrFail($activation['user_id']);
        $user->activated = 1;
        $user->save();
        return redirect("/");
    }
}
