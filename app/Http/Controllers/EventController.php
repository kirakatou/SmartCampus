<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Department;
use App\EventFor;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::All();
        return view('lists/event')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::All();
        return view('forms/event')->with("event", null)
                                  ->with('eventfors', null)
                                  ->with("departments", $departments);
                                  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event($request->except(['datetime']));
        if ($request->file('image')) {
            $file = $request->file('image');
            $path = $file->storeAs('/public/images/images', 
                    $request->name . '-' . date('dmy',strtotime($request->datetime)) 
                    . '.' . $file->getClientOriginalExtension());
            $event->image = '/images/images/' . $request->name . '-' . date('dmy',strtotime($request->datetime)) 
                                              . '.' . $file->getClientOriginalExtension();
        }
        if ($request->file('poster')) {
            $file = $request->file('poster') ;
            $path = $file->storeAs('/public/images/poster', 
                    $request->name . '-' . date('dmy',strtotime($request->datetime)) 
                    . '.' . $file->getClientOriginalExtension());
            $event->poster = '/images/poster/' . $request->name . '-' . date('dmy',strtotime($request->datetime)) 
                                               . '.' . $file->getClientOriginalExtension();
        }
        $event->datetime = date('Y-m-d H:i:s', strtotime($request->datetime));
        $event->save();

        if($request->for != null){
            foreach ($request->for as $for) {
                EventFor::create([
                    'event_id'      => $event->id,
                    'department_id' => $for
                ]);
            }
        }
        
        return redirect("/admin/event");;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departments = Department::all();
        $eventfors = EventFor::where('event_id', $id)->get();
        $event = Event::findOrFail($id);
        return view('forms/event', compact('event'))->with('departments', $departments)
                                                    ->with('eventfors', $eventfors);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::all();
        $eventfors = EventFor::where('event_id', $id)->get();
        $event = Event::findOrFail($id);
        return view('forms/event')->with("event", $event)->with('departments', $departments)
                                                         ->with('eventfors', $eventfors);   
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
        $eventfor = EventFor::findOrFail($id);
        $eventfor->delete();
        $event = Event::findOrFail($id);
        $event->delete();
    }
}
