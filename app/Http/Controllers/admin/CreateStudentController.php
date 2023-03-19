<?php

namespace App\Http\Controllers\admin;

use App\Models\Profiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $students = Profiles::whereRelation('user', 'role', 'student')->paginate(10);

        return view('admin.createstudent', [
            'students' => $students
        ]);
    }
}
