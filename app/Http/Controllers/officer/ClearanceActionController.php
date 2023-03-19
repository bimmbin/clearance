<?php

namespace App\Http\Controllers\officer;

use App\Models\Clearance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClearanceActionController extends Controller
{
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
