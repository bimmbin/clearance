<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Profiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditOfficerController extends Controller
{
    public function store(Request $request)
    {
        $officer = Profiles::findOrFail($request->id);

        $officer->employeeno = $request->employeeno;
        $officer->firstname = $request->firstname;
        $officer->lastname = $request->lastname;
        $officer->middlename = $request->middlename;

        $officer->save();

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
