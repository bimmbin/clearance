<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
{
    public function storeStudent()
    {
        $students = session('students');
        // dd($students);
        $users = User::whereIn('identify', array_column($students, 'identify'))->get();



        $users = User::whereIn('identify', array_column($students, 'identify'))->get();
        $userIds = [];
        foreach ($users as $user) {
            $userIds[$user->identify] = $user->id;
        }

        // dd($userIds);

        $studentsprofile = [];

        foreach ($students as $i => $student) {

            $person = $userIds[$student['identify']];

            $studentsprofile[] = [
                'user_id' => $person,
                'studentno' => $student['studentno'],
                'firstname' => $student['firstname'],
                'lastname' => $student['lastname'],
                'middlename' => $student['middlename'],
                'sex' => $student['sex'],
                'year' => $student['year'],
                'course' => $student['course'],
                'section' => $student['section'],
            ];
        }

        Profiles::insert($studentsprofile);

        return view('welcome', [
            'status' => 'Student Account created successfully'
        ]);

    }
}




// $students = [];

//         foreach ($request->studentno as $i => $studentnumber) {
//             $students[] = [
//                 'studentno' => $studentnumber,
//                 'firstname' => $request->firstname[$i],
//                 'lastname' => $request->lastname[$i],
//                 'middlename' => $request->middlename[$i],
//                 'sex' => $request->sex[$i],
//                 'year' => $request->year[$i],
//                 'course' => $request->course[$i],
//                 'section' => $request->section[$i],
//             ];
//         }

//         Profiles::insert($students);



        // dd(auth()->user()->profiles);

        // return view('auth.login', [
        //     'samples' => $samples
        // ]);
