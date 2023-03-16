<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();

        
        // $user = User::get();

        // dd($user);

         return view('admin.createdepartment', [
            'departments' => $departments
        ]);
        // return view('admin.createdepartment');
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
        ]);

        Department::firstOrCreate([
            'name' => $request->name,
        ]);


        return redirect()->route('store.clearance');

    }
}
