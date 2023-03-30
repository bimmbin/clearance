<?php

namespace App\Http\Controllers\officer;

use App\Models\Clearance;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SearchClearanceController extends Controller
{
    public function index() {

        // dd($request->search);
        return view('officer.searchclearance');
    }
    public function store(Request $request) {

        $deptId = Auth::user()->profiles->department->id;
        $skulyear = SchoolYear::has('currentyear')->first();
        // dd($request->search);
        $search = $request->search;

        $clearanceSearch = Clearance::whereHas('profiles', function ($query) use ($search) {

            $query->where('studentno', 'like', '%'.$search.'%')
                  ->orWhere('firstname', 'like', '%'.$search.'%')
                  ->orWhere('lastname', 'like', '%'.$search.'%')
                  ->orWhere('middlename', 'like', '%'.$search.'%')
                  ->orWhere('year', 'like', '%'.$search.'%')
                  ->orWhere('course', 'like', '%'.$search.'%')
                  ->orWhere('section', 'like', '%'.$search.'%');

        })->whereHas('department', function ($query) use ($deptId) {

            $query->where('id', $deptId);

        })->whereHas('schoolyear', function ($query) use ($skulyear) {

            $query->where('year', $skulyear->year);

        })->paginate(10);
        
        // dd($clearanceSearch);
        
        return view('officer.searchclearance', [
            'clearances' => $clearanceSearch
        ]);
    }
}
