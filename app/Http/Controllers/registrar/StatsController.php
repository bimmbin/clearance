<?php

namespace App\Http\Controllers\registrar;

use App\Models\Clearance;
use App\Models\CurrentYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    public function index() {

        $currentyear = CurrentYear::first();

        $clearances = Clearance::whereHas('profiles.user', function ($query) {
            $query->where('role', 'student');
        })->whereHas('schoolyear', function ($query) use ($currentyear) {
            $query->where('id', $currentyear->id);
        })->get();

        // dd($clearances);
        return view('registrar.stats', [
            'clearances' => $clearances
        ]);
    }
}
