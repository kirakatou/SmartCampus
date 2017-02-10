<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Staff;
use App\User;
use Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::All();
        return view('lists/staff')->with('staffs', $staffs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function create()
    {
        return view('forms/staff')->with('staff', null);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $staff = new Staff($request->except(['sid', 'name', 'gender', 'birthdate']));
        if($request->file('image')){
            $file = $request->file('image');
            $path = $file->storeAs('/staffPhotos', 
                    $request->name . '.' . $file->getClientOriginalExtension());
            $staff->image = $path;
        }
        $staff->sid = $request->sid;
        $staff->name = $request->name;
        $staff->gender = $request->gender;
        $staff->birthdate = date('Y-m-d',strtotime($request->birthdate));

        $staff->save();
        // $image=$request->file('photo');
        // $filename=$image->getClientOriginalExtension();
        // Storage::put('/staffPhotos/' . $request->sid . '.' . $filename,file_get_contents($image->getRealPath()));

        // $staff =  Staff::create([
        //                 'sid'           => $request->sid,
        //                 'name'          => $request->name,
        //                 'gender'        => $request->gender,
        //                 'birthdate'     => date('Y-m-d',strtotime($request->birthdate)),
        //                 'image'         => $filename
        //             ]);
        User::create([
            'username'      => $staff->sid,
            'password'      => bcrypt(date('dmY',strtotime($staff->birthdate))),
            'status'        => 'STAFF',
            'profile_id'    => $staff->id
        ]);
        return Redirect::to('/staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::findOrFail($id);
        return view('forms/staff', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('forms/staff')->with("staff", $staff);
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

        $staff = Staff::findOrFail($id);
        $staff->name = $request->name;
        $staff->gender = $request->gender;
        $staff->birthdate = date('Y-m-d',strtotime($request->birthdate));
        $staff->save();
        return redirect("/staff");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return redirect("/staff");
    }
}
