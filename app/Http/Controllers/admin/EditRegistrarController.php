<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Profiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditRegistrarController extends Controller
{
    public function store(Request $request)
    {
        //user profile
        $registrar = Profiles::findOrFail($request->id);

        $registrar->employeeno = $request->employeeno;
        $registrar->firstname = $request->firstname;
        $registrar->lastname = $request->lastname;
        $registrar->middlename = $request->middlename;
        $registrar->section = $request->section;

        $registrar->save();

        //user account
        $user = User::findOrFail($registrar->user_id);

        $spacelessUsername = str_replace(' ', '', $request->firstname);
            
        $user->username = $spacelessUsername.$request->employeeno;
        $user->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        // dd($request);
        $officer = Profiles::findOrFail($request->id);

        // dd($officer->user_id);
        $user = User::findOrFail($officer->user_id);
        
        $user->delete();
        $officer->delete();

        return redirect()->back();
    }
}
