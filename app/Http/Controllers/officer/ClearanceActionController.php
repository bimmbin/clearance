<?php

namespace App\Http\Controllers\officer;

use App\Models\Clearance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        $clearance->save();

        return redirect()->route('pending.clearance');
    }

    public function disapprove($id) {
        $clearance = Clearance::findOrFail($id);

        $clearance->status = 'disapproved';
        $clearance->signature = '';

        $clearance->save();

        return redirect()->route('disapprove.clearance');
    }
}
