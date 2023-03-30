<?php

namespace App\Http\Controllers\admin;

use App\Models\Profiles;
use App\Models\Clearance;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewClearanceController extends Controller
{
    public function index()
    {
        // $clearances = Clearance::paginate(10);

        $profiles = Profiles::whereRelation('user', 'role', 'student')
            ->whereDoesntHave('clearance')
            ->latest()
            ->get();


         $schoolyears = SchoolYear::all();       

        $studentcount = [];
        foreach ($schoolyears as $schoolyear) {
            $studentsCount = Clearance::where('school_year_id', '=', $schoolyear->id)
            ->where('department_id', '=', '1')
            ->select('year')
            ->count();

            $studentcount[] = [
                'year' => $schoolyear->year,
                'count' => $studentsCount,
            ];
        }
    
            // dd($studentcount);
  
        return view('admin.clearance', [
            'studentcount' => $studentcount,
            'schoolyears' => $schoolyears,
            'profiles' => $profiles
        ]);
    }
}
