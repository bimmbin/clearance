@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')

    Hello {{ auth()->user()->name }}
@endsection
