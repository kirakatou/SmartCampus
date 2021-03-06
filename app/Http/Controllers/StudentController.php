<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Department;
use App\Student;
use App\User;
use Alert;

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
        $student = new Student($request->except(['nim', 'name', 'gender', 'dob', 'email',
                                                 'religion', 'department_id', 'classname']));
        if($request->file('photo')){
            $file = $request->file('photo');
            $path = $file->storeAs('/public/images/photos', 
                    $request->nim . '.' . $file->getClientOriginalExtension());
            $student->image = $path;
        }
        $student->nim = $request->nim;
        $student->name = $request->name;
        $student->gender = $request->gender;
        $student->dob = date('Y-m-d',strtotime($request->dob));
        $student->email = $request->email;
        $student->religion = $request->religion;
        $student->department_id = $request->department;
        $student->classname = $request->class;
        $student->save();
        Alert::success('Student registered');

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
        $departments = Department::all();
        $classes = DB::table('students')->select('classname')->distinct()->get();
        $student = Student::findOrFail($id);
        return view('forms/student', compact('student'))->with('departments', $departments)
                                                        ->with('classes', $classes);
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
        $classes = DB::table('students')->select('classname')->distinct()->get();
        $student = Student::findOrFail($id);
        return view('forms/student')->with("student", $student) ->with('departments', $departments)
                                                                ->with('classes', $classes);
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
        $student = Student::findOrFail($id);
        $student->fill($request->except(['dob', 'photo']));
        if($request->file('photo')){
            $file = $request->file('photo');
            $path = $file->storeAs('/public/images/photos', 
                    $student->nim . '.' . $file->getClientOriginalExtension());
            $student->image = $path;
        }
        $student->dob = date('Y-m-d',strtotime($request->dob));
        $student->save();
        DB::table('users')->where('profile_id', '=', $student->id)->update(array('password' => bcrypt(date('dmY',strtotime($student->dob)))));
        Alert::success('Update success');
        return redirect("/student");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        DB::table('users')->where('profile_id', '=', $student->id)->delete();
    }
}
