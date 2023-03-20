<?php

namespace App\Http\Controllers\admin;

use App\Models\Profiles;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateOfficerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
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
