<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 
use App\Student;
use App\Event;



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
        $event_fors = DB::table('events')
                    ->select("event_id", "department_id", "departments.alias", "departments.colour")
                    ->leftJoin('event_fors', 'events.id', '=', 'event_fors.event_id')
                    ->leftJoin('departments', 'event_fors.department_id', '=', 'departments.id')
                    ->where('datetime', '>', Carbon::today()->toDateString())
                    ->get();
        $events = Event::All()->where('datetime', '>', Carbon::today()->toDateString());    
        if(Auth::check()){
            $profile = Student::find(Auth::user()->profile_id);
            return view('index')->with('profile', $profile)->with('events', $events)->with('event_fors', $event_fors);;
        }
        else {
            return view('index')->with('events', $events)->with('event_fors', $event_fors);
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
    public function store(Request $request)
    {
        //
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
