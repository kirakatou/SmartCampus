<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Department;
use App\Student;
use App\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::All();
        return view('lists/student')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $classes = DB::table('students')->select('classname')->distinct()->get();
        return view('forms/student')->with("student", null)
                                   ->with('departments', $departments)
                                   ->with('classes', $classes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->file('photo')->storeAs('photos', $request->nim);
        $student =  Student::create([
                        'nim'           => $request->nim,
                        'name'          => $request->name,
                        'gender'        => $request->gender,
                        'dob'           => date('Y-m-d',strtotime($request->birthdate)),
                        'email'         => $request->email,
                        'religion'      => $request->religion,
                        'department_id' => $request->department,
                        'classname'     => $request->class,
                        'image'         => $path
                    ]);
        User::create([
                'username'      => $student->nim,
                'password'      => bcrypt(date('dmY',strtotime($student->dob))),
                'status'        => 'STUDENT',
                'profile_id'    => $student->id
            ]);
        return Redirect::to('/student');
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
