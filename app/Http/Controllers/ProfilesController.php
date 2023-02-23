<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
{
    public function storeStudent(Request $request)
    {
        $students = [];

        foreach ($request->studentno as $i => $studentnumber) {
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

        
        session(['students' => $students]);

        Profiles::insert($students);



        return redirect()->route('registerStudent');
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
