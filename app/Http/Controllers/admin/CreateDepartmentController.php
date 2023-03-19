<?php

namespace App\Http\Controllers\admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateDepartmentController extends Controller
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