<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AdminController extends Controller
{
    public function index()
    {
        // $students = Profiles::whereRelation('user', 'role', 'student')->get();

  
        // dd($students);

        // $students = Profiles::where('user_id', '=', 'student')->paginate(10);

        return view('admin.createstudent');
    }
}
