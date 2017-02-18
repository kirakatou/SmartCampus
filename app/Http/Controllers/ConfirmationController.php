<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Event;
use App\Voucher;
use App\EventParticipant;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Input;

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
        $data = DB::table('vouchers')
                ->leftJoin('students', 'vouchers.participant_id', '=', 'students.id')
                ->where('vouchers.id', $id)
                ->get();
        // $data->receipt_date = date('d-m-Y',strtotime($data->receipt_date));
        // $data = Voucher::findOrFail($id);
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
            $participation->barcode = $voucher->event_id . "/" . $voucher->participant_id;
            $participation->save();
        }
       
        $data = array('status' => 'success');
        return $data;
    }
}
