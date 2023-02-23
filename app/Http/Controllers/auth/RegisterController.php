<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Shuchkin\SimpleXLSX;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profiles;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Profiler\Profile;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('dashboard');
    }
    
    public function previewTable(Request $request) {
        $students = SimpleXLSX::parse($request->file);

        return view('admin.tablepreview')->with('students', $students);
    }

    public function registerStudent() {

        $data = session('students');

        $studentAcc = [];
        

        foreach ($data as $i => $studentnumber) {

            // dd($studentnumber['studentno']);
            $profile = Profiles::where('studentno', '=', $studentnumber['studentno'])->first();

            $studentAcc[] = [
                'username' => $studentnumber['lastname'].$studentnumber['studentno'],
                'password' => Hash::make('123'),
                'role' => 'student',
                'profiles_id' => $profile->id,
            ];
        }


        User::insert($studentAcc);


         return view('welcome', [
            'samples' => 'Student Account created successfully'
        ]);
    }

}
