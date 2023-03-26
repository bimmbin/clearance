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
}
