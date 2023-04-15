<?php

namespace App\Http\Controllers\registrar;

use App\Models\Profiles;
use App\Models\Clearance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CurrentYear;
use Illuminate\Support\Facades\Crypt;

class RegistrarClearanceController extends Controller
{
    public function index() {

        $profiles = Profiles::whereHas('user', function ($query) {
            $query->where('role', 'student');
        })->paginate(10);

        $currentyear = CurrentYear::first();

        $approvedClearances = Clearance::whereHas('profiles.user', function ($query) {
            $query->where('role', 'student');
        })->whereHas('schoolyear', function ($query) use ($currentyear) {
            $query->where('id', $currentyear->id);
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
        return view('registrar.clearance', [
            'profiles' => $profiles,
            'signatures' => $decryptedImages
        ]);
    }
}
