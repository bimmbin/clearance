<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {

        $student = User::firstWhere('role', 'student');

        $admin = User::firstWhere('role', 'admin');

        $officer = User::firstWhere('role', 'officer');
        
        return view('auth.login', [
            'student' => $student,
            'admin' => $admin,
            'officer' => $officer
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('username', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }

        // make a condition here for admin, officer and student
        return redirect()->route('home');
    }
}
