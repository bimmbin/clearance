@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <form action="{{ route('previewTable') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>

    

@endsection
