<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $profile = Profiles::find(auth()->user()->id);

         return view('dashboard', [
            'profile' => $profile
        ]);
        // return view('dashboard');
    }
}
