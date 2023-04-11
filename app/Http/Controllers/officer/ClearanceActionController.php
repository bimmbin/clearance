<?php

namespace App\Http\Controllers\officer;

use App\Models\Log;
use App\Models\Clearance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ClearanceActionController extends Controller
{
    public function approve(Request $request) {

        // dd($request->clearanceId);
         $signatureData1 = explode(",", $request->signature)[1];
        // $signatureData1 = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData2 = str_replace(' ', '+', $signatureData1);
        $signatureImage = base64_decode($signatureData2);


        $encryptedImage = Crypt::encrypt($signatureImage);
        
        $clearance = Clearance::findOrFail($request->clearanceId);

        $clearance->status = 'approved';
        $clearance->signature = $encryptedImage;
        $clearance->remarks = '';
        $clearance->save();

        Log::create([
            'clearance_id' => $clearance->id,
            'profile_id' => Auth::user()->profiles->id,
            'details' => 'approved',
        ]);

        return redirect()->route('pending.view');
    }

    public function disapprove(Request $request) {
        $clearance = Clearance::findOrFail($request->id);

        $clearance->status = 'disapproved';
        // $clearance->signature = '';
        $clearance->signature = '';
        $clearance->remarks = $request->remarks;
        $clearance->save();

        Log::create([
            'clearance_id' => $clearance->id,
            'profile_id' => Auth::user()->profiles->id,
            'details' => 'disapproved',
        ]);


        return redirect()->route('pending.view');
    }
}
