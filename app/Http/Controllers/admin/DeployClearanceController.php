<?php

namespace App\Http\Controllers\admin;

use App\Models\Profiles;
use App\Models\Clearance;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeployClearanceController extends Controller
{
    public function store(Request $request) {

        // dd($request->id)
        $users = Profiles::whereRelation('user', 'role', 'student')->get();

        $departments = Department::all();


        foreach ($users as $user) {

      
            foreach ($departments as $department) {
                $clearance = Clearance::firstOrNew([
                    'department_id' => $department->id,
                    'profile_id' => $user->id,
                    'school_year_id' => $request->id,
                ], [
                    
                    'status' => 'pending',
                ]);
        
                if (!$clearance->exists) {
                    $clearance->save();
                }
            }
        }



        return back();


        // return redirect()->route('store.clearance');
    }
}
