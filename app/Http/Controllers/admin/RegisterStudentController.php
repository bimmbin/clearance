<?php

namespace App\Http\Controllers\admin;

use App\Models\Keys;
use App\Models\User;
use App\Models\Profiles;
use Shuchkin\SimpleXLSX;
use App\Models\CurrentYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterStudentController extends Controller
{

    public function previewTable(Request $request)
    {

        $this->validate($request, [
            'file' => 'required',
        ]);

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
        $currentyear = CurrentYear::first();


        $studentRegCount = 0;
        foreach ($request->studentno as $i => $studentnumber) {

           
            $spacelessUsername = str_replace(' ', '', $request->firstname[$i]);
            
            $user = User::firstOrNew(['username' => $spacelessUsername . $studentnumber, 
                                        'school_year_id' => $currentyear->school_year_id], [
                'password' => Hash::make($studentnumber),
                'role' => 'student',
                
            ]);


            if (!$user->exists) {
                $user->save();
                $studentRegCount++;
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

        // dd($studentRegCount);
        return redirect()->route('createstudent')->with([
            'studentRegCount' => $studentRegCount,
            'currentyear' => $currentyear->schoolyear->year,
        ]);
    }

    public function single(Request $request) {
        // dd($request); 
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'studentno' => 'required|unique:profiles,studentno',
            'sex' => 'required',
            'year' => 'required',
            'course' => 'required',
            'section' => 'required',
        ]);

        $currentyear = CurrentYear::first();

        $spacelessUsername = str_replace(' ', '', $request->firstname);

        $studentRegCount = 0;
        $user = User::firstOrNew(['username' => $spacelessUsername . $request->studentno, 
                                'school_year_id' => $currentyear->school_year_id], [
            'password' => Hash::make($request->studentno),
            'role' => 'student',
        ]);

        if (!$user->exists) {
            $user->save();
            $studentRegCount++;
        }

        $userprofile = Profiles::firstOrNew(['user_id' => $user->id], [
            'studentno' => $request->studentno,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'sex' => $request->sex,
            'year' => $request->year,
            'course' => $request->course,
            'section' => $request->section,
        ]);

        if (!$userprofile->exists) {
            $userprofile->save();
        }

        return redirect()->route('createstudent')->with([
            'studentRegCount' => $studentRegCount,
            'currentyear' => $currentyear->schoolyear->year,
        ]);
    }
}
