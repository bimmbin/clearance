<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Profiles;
use App\Models\CurrentYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterOfficerController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'employeeno' => 'required|unique:profiles,employeeno',
        ]);
       
        $currentyear = CurrentYear::first();

        $spacelessUsername = str_replace(' ', '', $request->firstname);
        $user = User::firstOrNew(['username' => $spacelessUsername . $request->employeeno], [
            'password' => Hash::make($request->employeeno),
            'role' => 'officer',
            'school_year_id' => $currentyear->schoolyear->year,
            'is_changed_pass' => '0',
        ]);

        if (!$user->exists) {
            $user->save();
        }

        $userprofile = Profiles::firstOrNew(['user_id' => $user->id,], [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'employeeno' => $request->employeeno,
            'sex' => $request->sex,
            'department_id' => $request->department,
        ]);

        if (!$userprofile->exists) {
            $userprofile->save();
        }

        return redirect()->route('admin.officerview');
    }
}
