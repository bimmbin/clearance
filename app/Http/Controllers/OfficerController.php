<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class OfficerController extends Controller
{
    public function approved()
    {
        $deptId = Auth::user()->profiles->department->id;

        $clearances = Clearance::whereRelation('department', 'id', $deptId)
            ->where('status', 'approved')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        // dd($clearances);
        return view('officer.approvedclearance', [
            'clearances' => $clearances
        ]);
    }
    public function disapproved()
    {
        $deptId = Auth::user()->profiles->department->id;

        $clearances = Clearance::whereRelation('department', 'id', $deptId)
            ->where('status', 'disapproved')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        // dd($clearances);
        return view('officer.disapprovedclearance', [
            'clearances' => $clearances
        ]);
    }
    public function pending()
    {
        $deptId = Auth::user()->profiles->department->id;

        $clearances = Clearance::whereRelation('department', 'id', $deptId)
            ->where('status', 'pending')
            ->paginate(10);

        // dd($clearances);
        return view('officer.pendingclearance', [
            'clearances' => $clearances
        ]);
    }
}
