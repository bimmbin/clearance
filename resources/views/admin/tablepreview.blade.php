@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')

    <form action="{{ route('registerStudent') }}" method="post" class="">
        @csrf
       
    <table class="" style="border-collapse: collapse">
        <thead>
            <tr>
                <th class="text-start">studentno</th>
                <th class="text-start">lastname</th>
                <th class="text-start">firstname</th>
                <th class="text-start">middlename</th>
                <th class="text-start">sex</th>
                <th class="text-start">year</th>
                <th class="text-start">course</th>
                <th class="text-start">section</th>

            </tr>
        </thead>
        <tbody>
            @php $headings = 0; @endphp
            @foreach ($students->rows() as $student)
                @if ($headings != 0 && $headings != 1)
                    <tr>
                        <td>{{ $student[0] }} <input type="hidden" name="studentno[]" value="{{ $student[0] }}"></td>
                        <td>{{ $student[1] }} <input type="hidden" name="lastname[]" value="{{ $student[1] }}"></td>
                        <td>{{ $student[2] }} <input type="hidden" name="firstname[]" value="{{ $student[2] }}"></td>
                        <td>{{ $student[3] }} <input type="hidden" name="middlename[]" value="{{ $student[3] }}"></td>
                        <td>{{ $student[4] }} <input type="hidden" name="sex[]" value="{{ $student[4] }}"></td>
                        <td>{{ $student[5] }} <input type="hidden" name="year[]" value="{{ $student[5] }}"></td>
                        <td>{{ $student[6] }} <input type="hidden" name="course[]" value="{{ $student[6] }}"></td>
                        <td>{{ $student[7] }} <input type="hidden" name="section[]" value="{{ $student[7] }}"></td>
                    </tr>
               
            @endif
            @php $headings++; @endphp
            @endforeach
        </tbody>
    </table>
    <button class="">submit</button>
</form>
@endsection
