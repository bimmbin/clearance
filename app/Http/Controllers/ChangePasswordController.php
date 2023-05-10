<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index() {
        return view('changepass');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        // dd($request->user_id);
        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make($request->password);
        $user->is_changed_pass = '1';
        $user->save();

        if ($user->role === 'admin') {
            return redirect()->route('createstudent');
        } elseif ($user->role === 'officer') {
            return redirect()->route('pending.view');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.clearance');
        } elseif ($user->role === 'registrar') {
            return redirect()->route('registrar.clearance');
        } 
    }
}
