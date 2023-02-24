@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
   <a href="{{ route('createstudent') }}">create student</a>

   {{-- <a href="{{ route('createstudent') }}"></a>
   <a href="{{ route('createstudent') }}"></a> --}}

@endsection
