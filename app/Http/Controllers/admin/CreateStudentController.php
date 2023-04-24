<?php

namespace App\Http\Controllers\admin;

use App\Models\Profiles;
use App\Models\CurrentYear;
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

        $currentyear = CurrentYear::first();

        // dd($currentyear->id);
        $students = Profiles::whereRelation('user', 'role', 'student')
        ->whereRelation('user', 'school_year_id', $currentyear->school_year_id)->paginate(10);

        return view('admin.createstudent', [
            'students' => $students,
            'currentyear' => $currentyear->schoolyear->year,
        ]);
    }
}
