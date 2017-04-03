<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use DB;
use DNS2D;
use App\Event;
use App\Voucher;
use App\Student;
use App\Member;
use App\EventParticipant;
use Carbon\Carbon; 
use App\Mail\EventJoinMail;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class ConfirmationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('datetime', '>', Carbon::now())
                       ->where('pay', '1')
                       ->get();
        return view('forms/confirmation')->with('events', $events)
                                         ->with('voucher', null);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * show voucher data
     */
    public function create($id)
    {   
        $voucher = Voucher::findOrFail($id);
        if($voucher->status == 'STUDENT'){
            $data = DB::table('vouchers')
                      ->leftJoin('students', 'vouchers.participant_id', '=', 'students.id')
                      ->where('vouchers.id', $id)
                      ->get();
        }else {
            $data = DB::table('vouchers')
                      ->leftJoin('members', 'vouchers.participant_id', '=', 'members.id')
                      ->where('vouchers.id', $id)
                      ->get();
        }
        return $data;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Voucher::where('event_id', $id)
                       ->where('paid', 0)
                       ->where(DB::raw('DATE_ADD(created_at, INTERVAL 1 DAY)'), '>', Carbon::now())
                       ->get();
        return $data;
        // return response()->json([
        //         'data' -> $data
        //        ]); 
    }

    public function update($id, $paid = 1)
    {
        $voucher = Voucher::findOrFail($id);
        if ($paid = 'on')
            $voucher->paid = '1';
        else 
            $voucher->paid = '0';
        $voucher->save();
        if($voucher->paid){
            $participation = new EventParticipant();
            $participation->event_id = $voucher->event_id;
            $participation->participant_id = $voucher->participant_id;
            $participation->status = $voucher->status;
            $participation->barcode = str_random(18);
            $participation->save();
            $event = Event::findOrFail($voucher->event_id);
            if($participation->status = 'GUEST'){
                $profile = Member::findOrFail($participation->participant_id);
            }else {
                $profile = Student::findOrFail($participation->participant_id);
            }
            Mail::to($profile->email)
                ->send(new EventJoinMail($event->name, $voucher->price, 
                                       Carbon::createFromFormat('Y-m-d H:i:s', $event->datetime)
                                             ->format('d-m-Y, H:i'),
                                       $event->location, '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG($participation->barcode, "QRCODE") . '" alt="barcode"   />'
                                       ));
        }
       
        $data = array('status' => 'success');
        return $data;
    }
}
