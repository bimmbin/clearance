<?php

namespace App\Http\Controllers\admin;

use App\Models\Keys;
use App\Models\User;
use App\Models\Profiles;
use Shuchkin\SimpleXLSX;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterStudentController extends Controller
{

    public function previewTable(Request $request)
    {
        $students = SimpleXLSX::parse($request->file);


        $username = array();

        $headings = 0;
        foreach ($students->rows() as $student) {
            if ($headings != 0 && $headings != 1) {
                array_push($username, $student[2] . $student[0]);
            }
            $headings++;
        }

        // $users = User::whereIn('identify', array_column($students, 'identify'))->get();

        $exusername = User::select('username')->whereIn('username', $username)->get();

        $exusers = array();
        foreach ($exusername as $exuser) {
            array_push($exusers, $exuser->username);
        }


        return view('admin.tablepreview')->with('students', $students)
            ->with('exusers', $exusers);
    }

    public function registerStudent(Request $request)
    {

        foreach ($request->studentno as $i => $studentnumber) {

            $ran = microtime() . floor(rand() * 10000);

            $user = User::firstOrNew(['username' => $request->lastname[$i] . $studentnumber], [
                'password' => Hash::make($studentnumber),
                'role' => 'student',
            ]);


            if (!$user->exists) {
                $user->save();
            }

            $userprofile = Profiles::firstOrNew(['user_id' => $user->id,], [
                'studentno' => $studentnumber,
                'firstname' => $request->firstname[$i],
                'lastname' => $request->lastname[$i],
                'middlename' => $request->middlename[$i],
                'sex' => $request->sex[$i],
                'year' => $request->year[$i],
                'course' => $request->course[$i],
                'section' => $request->section[$i],
            ]);

            if (!$userprofile->exists) {
                $userprofile->save();
            }
        }

        return redirect()->route('createstudent');
    }
}
