<?php

namespace App\Http\Controllers\officer;

use App\Models\Clearance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use Illuminate\Support\Facades\Auth;

class StudentClearanceController extends Controller
{
    public function approved()
    {
        $deptId = Auth::user()->profiles->department->id;

        $schoolyear = SchoolYear::has('currentyear')->first();

            //select all clearance where depatment user id and schooyear 
            $clearances = Clearance::whereHas('department', function ($query) use ($deptId) {

                $query->where('id', $deptId);
    
            })->whereHas('schoolyear', function ($query) use ($schoolyear) {
    
                $query->where('year', $schoolyear->year);
    
            })->where('status', 'approved')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);


        // dd($clearances);
        return view('officer.approvedclearance', [
            'clearances' => $clearances
        ]);
    }
    public function disapproved()
    {
        $deptId = Auth::user()->profiles->department->id;

        $schoolyear = SchoolYear::has('currentyear')->first();

            //select all clearance where depatment user id and schooyear 
            $clearances = Clearance::whereHas('department', function ($query) use ($deptId) {

                $query->where('id', $deptId);
    
            })->whereHas('schoolyear', function ($query) use ($schoolyear) {
    
                $query->where('year', $schoolyear->year);
    
            })->where('status', 'disapproved')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);


        // dd($clearances);
        return view('officer.disapprovedclearance', [
            'clearances' => $clearances
        ]);
    }
    public function pending()
    {
        $deptId = Auth::user()->profiles->department->id;

        $schoolyear = SchoolYear::has('currentyear')->first();

            //select all clearance where depatment user id and schooyear 
            $clearances = Clearance::whereHas('department', function ($query) use ($deptId) {

                $query->where('id', $deptId);
    
            })->whereHas('schoolyear', function ($query) use ($schoolyear) {
    
                $query->where('year', $schoolyear->year);
    
            })->where('status', 'pending')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);


        // dd($clearances);
        return view('officer.pendingclearance', [
            'clearances' => $clearances
        ]);
    }
}
