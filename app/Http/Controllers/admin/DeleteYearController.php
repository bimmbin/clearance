<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class DeleteYearController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $schoolYear = SchoolYear::findOrFail($request->id);
        
        $schoolYear->delete();

        return redirect()->back();
    }
}
