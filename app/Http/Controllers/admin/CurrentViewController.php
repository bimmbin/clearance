<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CurrentYear;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class CurrentViewController extends Controller
{
    public function index() {

        // dd($request->search);
        $allYears = SchoolYear::all();
        $currentyear = CurrentYear::first();
        // dd($currentyear);
        return view('admin.currentview', [
            'allYears' => $allYears,
            'currentyear' => $currentyear,
        ]);
    }
    public function store(Request $request) {
        
        
        $currentyear = CurrentYear::first();

        $currentyear->school_year_id = $request->id;
        $currentyear->save();

        return redirect()->back();
    }

    public function addyear(Request $request) {
        
        SchoolYear::create([
            'year' => $request->year,
        ]);

        return redirect()->back();
    }
}
