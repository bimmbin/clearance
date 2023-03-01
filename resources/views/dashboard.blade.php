@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    @auth
        Hello {{ Auth::user()->profiles->firstname." ".Auth::user()->profiles->lastname}}
    @endauth
@endsection
