<?php

namespace App\Http\Controllers\registrar;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index() {
        // dd("asdfsdf");
        $logs = Log::latest()->get();
        return view('registrar.reports', [
            'reports' => $logs
        ]);
    }
}
