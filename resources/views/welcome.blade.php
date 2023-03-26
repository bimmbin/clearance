@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    @if (session('status'))
        <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('createstudent') }}">create student</a></br>
    {{-- <a href="{{ route('createOfficer') }}">create officer</a> --}}

    {{-- <a href="{{ route('createstudent') }}"></a>
   <a href="{{ route('createstudent') }}"></a> --}}
   <form method="POST" action="{{ route('homes') }}">
    @csrf
    <canvas id="signature-pad"></canvas>
    <input type="hidden" name="signature" id="signature">
    <button type="submit" id="signatureBtn">Submit</button>
    
</form>






{{-- <img src="storage\app\public\signature_1678767153.png" alt=""> --}}
@endsection



@section('script')

const canvas = document.querySelector("canvas");

const signaturePad = new SignaturePad(canvas);



const saveJPGButton = document.querySelector("#signatureBtn");

saveJPGButton.addEventListener("click", function (event) {
    if (signaturePad.isEmpty()) {
      alert("Please provide a signature first.");
      event.preventDefault();
    } else {
      var signatureData = signaturePad.toDataURL();
        document.getElementById("signature").value = signatureData;
    }
  });
@endsection