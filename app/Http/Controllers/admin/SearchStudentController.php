<?php

namespace App\Http\Controllers\admin;

use App\Models\Profiles;
use App\Models\CurrentYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchStudentController extends Controller
{
    public function index() {

        // dd($request->search);
        return view('admin.searchstudent');
    }
    public function store(Request $request) {

        $search = $request->search;
        $currentyear = CurrentYear::first();

        $studentSearch = Profiles::with('user')
                ->where(function($query) use ($search) {
                    $query->where('studentno', 'like', '%'.$search.'%')
                        ->orWhere('firstname', 'like', '%'.$search.'%')
                        ->orWhere('lastname', 'like', '%'.$search.'%')
                        ->orWhere('middlename', 'like', '%'.$search.'%')
                        ->orWhere('year', 'like', '%'.$search.'%')
                        ->orWhere('course', 'like', '%'.$search.'%')
                        ->orWhere('section', 'like', '%'.$search.'%');
                })
                ->whereHas('user', function ($query) use ($currentyear) {
                    $query->where('school_year_id', $currentyear->school_year_id);
                })
                ->paginate(10);
        
        // dd($clearanceSearch);
        
        return view('admin.searchstudent', [
            'students' => $studentSearch
        ]);
    }
}
