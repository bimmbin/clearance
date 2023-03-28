<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Profiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterOfficerController extends Controller
{
    public function store(Request $request)
    {

        $spacelessUsername = str_replace(' ', '', $request->firstname);
        $user = User::firstOrNew(['username' => $spacelessUsername . $request->employeeno], [
            'password' => Hash::make($request->employeeno),
            'role' => 'officer',
        ]);

        if (!$user->exists) {
            $user->save();
        }

        $userprofile = Profiles::firstOrNew(['user_id' => $user->id,], [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'employeeno' => $request->employeeno,
            'username' => $request->lastname,
            'sex' => $request->lastname,
            'department_id' => $request->department,
        ]);

        if (!$userprofile->exists) {
            $userprofile->save();
        }

        return redirect()->route('admin.officerview');
    }
}
