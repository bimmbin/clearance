<?php

namespace App\Http\Controllers\admin;

use App\Models\Profiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditStudentController extends Controller
{
    public function store(Request $request)
    {

        $student = Profiles::findOrFail($request->id);

        $student->studentno = $request->studentno;
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->middlename = $request->middlename;
        $student->sex = $request->sex;
        $student->year = $request->year;
        $student->course = $request->course;
        $student->section = $request->section;

        $student->save();

        return back();
    }
}
