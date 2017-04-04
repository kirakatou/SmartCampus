<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Staff;
use App\User;
use Alert;

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
        $staff = new Staff($request->except(['birthdate']));
        if($request->file('image')){
            $file = $request->file('image');
            $path = $file->storeAs('/staffPhotos', 
                    $request->sid . '.' . $file->getClientOriginalExtension());
            $staff->image = $path;
        }
        $staff->birthdate = date('Y-m-d',strtotime($request->birthdate));

        $staff->save();
        Alert::success('Staff registered');

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
        $staff->fill($request->except(['birthdate', 'image']));
        if($request->file('image')){
            $file = $request->file('image');
            $path = $file->storeAs('/staffPhotos', 
                    $request->sid . '.' . $file->getClientOriginalExtension());
            $staff->image = $path;
        }
        $staff->birthdate = date('Y-m-d',strtotime($request->birthdate));
        $staff->save();
        DB::table('users')->where('profile_id', '=', $staff->id)->update(array('password' => bcrypt(date('dmY',strtotime($staff->birthdate)))));
        Alert::success('Update success');
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
            DB::table('users')->where('profile_id', '=', $staff->id)->delete();
    }
}
