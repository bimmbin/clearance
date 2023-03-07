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
    <a href="{{ route('createOfficer') }}">create officer</a>

    {{-- <a href="{{ route('createstudent') }}"></a>
   <a href="{{ route('createstudent') }}"></a> --}}

  
@endsection
