<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Shuchkin\SimpleXLSX;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:255',
            // 'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'role' => $request->role,
            // 'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->attempt($request->only('username', 'password'));

        return redirect()->route('createstudent');
    }

    public function previewTable(Request $request)
    {
        $students = SimpleXLSX::parse($request->file);

        return view('admin.tablepreview')->with('students', $students);
    }

    public function registerStudent(Request $request)
    {



        // $studentAcc = [];

        $students = [];
        $studentsprofile = [];


        // dd($ran);
        $studentPasswords = [];


        foreach ($request->studentno as $i => $studentnumber) {

            $ran = microtime() . floor(rand() * 10000);

            $students[] = [
                'username' => $request->lastname[$i] . $studentnumber,
                'password' => Hash::make($studentnumber),
                'role' => 'student',
                'identify' => $ran,
            ];
            $studentsprofile[] = [
                'studentno' => $studentnumber,
                'firstname' => $request->firstname[$i],
                'lastname' => $request->lastname[$i],
                'middlename' => $request->middlename[$i],
                'sex' => $request->sex[$i],
                'year' => $request->year[$i],
                'course' => $request->course[$i],
                'section' => $request->section[$i],
                'identify' => $ran,
            ];
        }

        User::insert($students);

        session(['students' => $studentsprofile]);



        return redirect()->route('storeStudent');
    }

    public function registerOfficer(Request $request)
    {

        // dd();

        $ran = microtime() . floor(rand() * 10000);

        User::create([
            'username' => $request->firstname.$request->employeeno,
            'password' => Hash::make($request->employeeno),
            'role' => 'officer',
            'identify' => $ran,
        ]);


        $officer = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'employeeno' => $request->employeeno,
            'username' => $request->lastname,
            'sex' => $request->lastname,
            'department_id' => $request->department_id,
            'identify' => $ran,

        ];

        session(['officer' => $officer]);



        return redirect()->route('storeOfficer');
    }
}




 // foreach ($data as $i => $studentnumber) {

        //     // dd($studentnumber['studentno']);
        //     $profile = Profiles::where('studentno', '=', $studentnumber['studentno'])->first();

        //     $studentAcc[] = [
        //         'username' => $studentnumber['lastname'].$studentnumber['studentno'],
        //         'password' => Hash::make('123'),
        //         'role' => 'student',
        //         'profiles_id' => $profile->id,
        //     ];
        // }


        // User::insert($studentAcc);