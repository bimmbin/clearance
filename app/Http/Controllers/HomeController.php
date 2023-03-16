<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {

        return view('welcome');
    }

    public function store(Request $request)
    {
       
        $signatureData = $request->signature;
        
        //  dd($signatureData);

         $signatureData1 = explode(",", $signatureData)[1];
        // $signatureData1 = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData2 = str_replace(' ', '+', $signatureData1);
        $signatureImage = base64_decode($signatureData2);


    

        $filename = 'signature_' . time() . '.jpeg';
        $filePath = storage_path('app/public/' . $filename);
        file_put_contents($filePath, $signatureImage);

        return back();
    }
}
