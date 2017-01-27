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
        if ($request->file('image')) {
            $imagepath = $request->file('image')
                                 ->storeAs('images', 
                                    $request->name . '-' . date('dmy',strtotime($request->datetime)));
        }
        if ($request->file('banner')) {
            $bannerpath = $request->file('banner')
                                  ->storeAs('banners', 
                                    $request->name . '-' . date('dmy',strtotime($request->datetime)));
        }
        if ($request->file('poster')) {
            $posterpath = $request->file('poster')
                            ->storeAs('poster', 
                                    $request->name . '-' . date('dmy',strtotime($request->datetime)));
        }
        $request->offsetSet('datetime', date('Y-m-d H:i:s',strtotime($request->datetime)));
        $request->offsetSet('image', $imagepath);
        $request->offsetSet('banner',$bannerpath);
        $request->offsetSet('poster',$posterpath);
        $event = Event::create($request->all());
        foreach ($request->for as $for) {
             EventFor::create([
                'event_id'      => $event->id,
                'department_id' => $for
            ]);
        }
        return redirect("/event");;
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
