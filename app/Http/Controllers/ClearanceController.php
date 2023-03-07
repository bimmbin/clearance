<?php

namespace App\Http\Controllers;


use App\Models\Profiles;
use App\Models\Clearance;
use App\Models\Department;
use Illuminate\Http\Request;

class ClearanceController extends Controller
{
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
}








                // Clearance::create([
                //     'department_id' => $department->id,
                //     'profile_id' => $user->id,
                //     'status' => 'pending',
                // ]);
