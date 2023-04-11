<?php

namespace App\Http\Controllers\registrar;

use App\Models\Profiles;
use App\Models\Clearance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class RegistrarSearchController extends Controller
{
     public function store(Request $request) {

        $search = $request->search;

        $profiles = Profiles::whereHas('user', function ($query) {
            $query->where('role', 'student');
        })->where('studentno', 'like', '%'.$search.'%')
        ->orWhere('firstname', 'like', '%'.$search.'%')
        ->orWhere('lastname', 'like', '%'.$search.'%')
        ->orWhere('middlename', 'like', '%'.$search.'%')
        ->orWhere('year', 'like', '%'.$search.'%')
        ->orWhere('course', 'like', '%'.$search.'%')
        ->orWhere('section', 'like', '%'.$search.'%')->paginate(10);

        $approvedClearances = Clearance::whereHas('profiles.user', function ($query) {
            $query->where('role', 'student');
        })->where('status', 'approved')
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

        // dd( $decryptedImages);
        return view('registrar.searchclearance', [
            'profiles' => $profiles,
            'signatures' => $decryptedImages
        ]);
    }
}
