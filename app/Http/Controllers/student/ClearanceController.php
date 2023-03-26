<?php

namespace App\Http\Controllers\student;

use App\Models\Profiles;
use App\Models\Clearance;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ClearanceController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->profiles->id;
        // dd($userId);
        $clearances = Auth::user()->profiles->clearance;
        // $clearance = Clearance::has('profiles')->get();
        // return view('student.studentclearance');
        $approvedClearances = Clearance::whereRelation('profiles', 'id', $userId)
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

        // dd($decryptedImages);
        // dd($approvedClearances);
        return view('student.studentclearance', [
            'clearances' => $clearances,
            'signatures' => $decryptedImages,
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