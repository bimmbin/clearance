<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AdminController extends Controller
{
    public function index()
    {
        // $students = Profiles::whereRelation('user', 'role', 'student')->get();
  

        $students = Profiles::whereRelation('user', 'role', 'student')->paginate(10);

        // $students = Profiles::paginate(10);
    //   dd($students);
        return view('admin.createstudent', [
            'students' => $students
        ]);
    }
}
