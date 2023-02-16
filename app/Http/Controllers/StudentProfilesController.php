<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentProfiles;

class StudentProfilesController extends Controller
{

    public function storeStudent(Request $request)
    {

        for ($i = 0; $i < count($request->studentno); $i++) {
            StudentProfiles::create([
                'studentno' => $request->studentno[$i],
                "firstname" => $request->firstname[$i],
                "lastname" => $request->lastname[$i],
                "middlename" => $request->middlename[$i],
                "sex" => $request->sex[$i],
                "year" => $request->year[$i],
                "course" => $request->course[$i],
                "section" => $request->section[$i],
            ]);
        }
        // dd(count($request->studentno));
        // $samples = $request->studentno;

        // foreach ($request->studentno as $data) {
        //     StudentProfiles::create($data);
        // }

        // StudentProfiles::insert($request->studentno);
        // StudentProfiles::insert($request->firstname);
        // StudentProfiles::insert($request->lastname);
        // StudentProfiles::insert($request->middlename);
        // StudentProfiles::insert($request->sex);
        // StudentProfiles::insert($request->year);
        // StudentProfiles::insert($request->course);
        // StudentProfiles::insert($request->section);


        // foreach ($request->studentno as $student) {
        //     StudentProfiles::create([
        //         'studentno' => $student,
        //         "firstname" => $request->firstname,
        //         "lastname" => $request->lastname,
        //         "middlename" => $request->middlename,
        //         "sex" => $request->sex,
        //         "year" => $request->year,
        //         "course" => $request->course,
        //         "section" => $request->section,
        //     ]);
        // }



        // foreach ($request as $student) {
        //     StudentProfiles::create([
        //         "studentno" => $request->studentno,
        //         "firstname" => $request->firstname,
        //         "lastname" => $request->lastname,
        //         "middlename" => $request->middlename,
        //         "sex" => $request->sex,
        //         "year" => $request->year,
        //         "course" => $request->course,
        //         "section" => $request->section,
        //     ]);
        // }


        // return view('auth.login', [
        //     'samples' => $samples
        // ]);

        return redirect()->route('home');
    }
}


// $studentProf->studentno = $student->studentno;
//             $studentProf->lastname = $student->lastname;
//             $studentProf->firstname = $student->firstname;
//             $studentProf->middlename = $student->middlename;
//             $studentProf->sex = $student->sex;
//             $studentProf->year = $student->year;
//             $studentProf->course = $student->course;
//             $studentProf->section = $student->section;