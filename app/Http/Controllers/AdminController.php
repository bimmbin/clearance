<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use App\Models\Department;

class AdminController extends Controller
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

    public function createOfficer()
    {
        $officers = Profiles::whereRelation('user', 'role', 'officer')->latest()->get();

        $departments = Department::doesntHave('profiles')->latest()->get();
        // return view('admin.createOfficer');


        // dd($officers);
        return view('admin.createofficer', [
            'officers' => $officers,
            'departments' => $departments
        ]);
    }
}
