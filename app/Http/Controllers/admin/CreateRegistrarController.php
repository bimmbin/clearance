<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Profiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CreateRegistrarController extends Controller
{
    public function index() {

        $registrar = Profiles::whereRelation('user', 'role', 'registrar')->first();

        return view('admin.createregistrar', [
            'registrar' => $registrar
        ]);
        // return view('admin.createregistrar');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'employeeno' => 'required',
        ]);

        $spacelessUsername = str_replace(' ', '', $request->firstname);
        $user = User::firstOrNew(['username' => $spacelessUsername . $request->employeeno], [
            'password' => Hash::make($request->employeeno),
            'role' => 'registrar',
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
        ]);

        if (!$userprofile->exists) {
            $userprofile->save();
        }

        return redirect()->back();
    }
}
