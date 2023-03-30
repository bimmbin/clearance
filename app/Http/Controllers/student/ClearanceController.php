<?php

namespace App\Http\Controllers\student;

use App\Models\Profiles;
use App\Models\Clearance;
use App\Models\Department;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ClearanceController extends Controller
{
    public function index()
    {
        // clearance
        // $clearances = Auth::user()->profiles->clearance;
        $skulyear = SchoolYear::has('currentyear')->first();
        $schoolyear = $skulyear->year;
        //signature
        $userId = Auth::user()->profiles->id;

        $allClearances = Clearance::whereRelation('profiles', 'id', $userId)
        ->whereRelation('schoolyear', 'year', $schoolyear)
        ->get();

        $approvedClearances = Clearance::whereRelation('profiles', 'id', $userId)
        ->whereRelation('schoolyear', 'year', $schoolyear)
        ->where('status', 'approved')
        ->get();

        $decryptedImages = [];

        foreach ($approvedClearances as $approvedClearance) {

            // dd($approvedClearance->signature);
            $decryp = Crypt::decrypt($approvedClearance->signature);
            // dd($decryp);
            $decryptedImages[] = [
                'clearance_id' => $approvedClearance->id,
                'signature' => base64_encode($decryp)
            ];
        }


        return view('student.studentclearance', [
            'clearances' => $allClearances,
            'signatures' => $decryptedImages,
            'yr' => $schoolyear,
        ]);
    }
    public function store()
    {

        $users = Profiles::whereRelation('user', 'role', 'student')->get();

        $departments = Department::doesntHave('clearance')->get();
  
    

        foreach ($users as $user) {

            $clearance = [];
            // dd($user->id);
            foreach ($departments as $department) {
                $clearance[] = [
                    'department_id' => $department->id,
                    'profile_id' => $user->id,
                    'status' => 'pending',
                ];
            }
            Clearance::insert($clearance);
        }



        return back();
    }

    public function approve($id) {
        $clearance = Clearance::findOrFail($id);

        $clearance->status = 'approved';

        $clearance->save();

        return back();
    }

    public function disapprove($id) {
        $clearance = Clearance::findOrFail($id);

        $clearance->status = 'disapproved';

        $clearance->save();

        return back();
    }
}