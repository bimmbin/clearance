<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();

         return view('admin.createdepartment', [
            'departments' => $departments
        ]);
        // return view('admin.createdepartment');
    }
    public function store(Request $request)
    {
        Department::create([
            'name' => $request->name,
        ]);

        return back();

    }
}
