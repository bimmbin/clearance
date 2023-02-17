<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentProfiles;

class StudentProfilesController extends Controller
{

    public function storeStudent(Request $request)
    {

        // for ($i = 0; $i < count($request->studentno); $i++) {
        //     StudentProfiles::create([
        //         'studentno' => $request->studentno[$i],
        //         "firstname" => $request->firstname[$i],
        //         "lastname" => $request->lastname[$i],
        //         "middlename" => $request->middlename[$i],
        //         "sex" => $request->sex[$i],
        //         "year" => $request->year[$i],
        //         "course" => $request->course[$i],
        //         "section" => $request->section[$i],
        //     ]);
        // }
        $students = [];

        foreach ($request->studentno as $i => $studentnumber) {
            # code...
            $students[] = [
                'studentno' => $studentnumber,
                'firstname' => $request->firstname[$i],
                'lastname' => $request->lastname[$i],
                'middlename' => $request->middlename[$i],
                'sex' => $request->sex[$i],
                'year' => $request->year[$i],
                'course' => $request->course[$i],
                'section' => $request->section[$i],
            ];
        }

        StudentProfiles::insert($students);

        // return view('auth.login', [
        //     'samples' => $samples
        // ]);

        return redirect()->route('home');
    }
}
