<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Shuchkin\SimpleXLSX;
use App\Models\SchoolYear;
use App\Models\CurrentYear;
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
            'school_year_id' => '1',
            'is_changed_pass' => '1',
        ]);

        //Creating years
        // $years = ['2023-2024','2024-2025','2025-2026'];

        // foreach ($years as $year) {
        //     $skulyear = SchoolYear::firstOrNew(['year' => $year]);
    
        //     if (!$skulyear->exists) {
        //         $skulyear->save();
        //     }
        // }

        if (!CurrentYear::count() > 0) {

            $currYear = CurrentYear::firstOrNew(['school_year_id' => '1']);
    
            if (!$currYear->exists) {
                $currYear->save();
            }
            
        } 
        

        auth()->attempt($request->only('username', 'password'));

        return redirect()->route('admin.currentview');
    }
}
