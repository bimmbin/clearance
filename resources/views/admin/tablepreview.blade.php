@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    {{-- <form action="{{ route('registerStudent') }}" method="post" class="">
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
                            <td>{{ $student[0] }} <input type="hidden" name="studentno[]" value="{{ $student[0] }}">
                            </td>
                            <td>{{ $student[1] }} <input type="hidden" name="lastname[]" value="{{ $student[1] }}">
                            </td>
                            <td>{{ $student[2] }} <input type="hidden" name="firstname[]" value="{{ $student[2] }}">
                            </td>
                            <td>{{ $student[3] }} <input type="hidden" name="middlename[]" value="{{ $student[3] }}">
                            </td>
                            <td>{{ $student[4] }} <input type="hidden" name="sex[]" value="{{ $student[4] }}"></td>
                            <td>{{ $student[5] }} <input type="hidden" name="year[]" value="{{ $student[5] }}"></td>
                            <td>{{ $student[6] }} <input type="hidden" name="course[]" value="{{ $student[6] }}">
                            </td>
                            <td>{{ $student[7] }} <input type="hidden" name="section[]" value="{{ $student[7] }}">
                            </td>
                        </tr>
                    @endif
                    @php $headings++; @endphp
                @endforeach
            </tbody>
        </table>
        <button class="">submit</button>
    </form> --}}
    <div class="flex flex-col py-5 px-5 gap-4 md:px-10 xl:flex-row xl:justify-between">

        <h1 class="text-blacky font-semibold" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">Excel file
            info</h1>

    </div>
    <form action="{{ route('registerStudent') }}" method="post" class="relative">
        @csrf

        <div class="w-full h-fit pb-28 overflow-x-auto px-3 lg:px-10 xl:px-10 overflow-y-hidden">

            <table id="dataTable"
                class=" table-auto text-center w-[1920px] max-lg:w-[1280px] max-sm:w-[900px] text-lg xl:w-full whitespace-nowrap"
                style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem); ">
                <thead>
                    <tr class="space-y-3 pl-5">
                        <th class="pl-5">Number</th>
                        <th class="text-left pl-5">Student No.</th>
                        <th class="text-left pl-5">First Name</th>
                        <th class="text-left pl-5">Last Name</th>
                        <th class="text-left pl-5">Middle Name</th>
                        <th class="text-left pl-5">Sex</th>
                        <th class="text-left pl-5">Year</th>
                        <th class="text-left pl-5">Course</th>
                        <th class="text-left pl-5">Section</th>
                    </tr>
                </thead>

                <tbody class="space-y-6 border text-left">

                    @php $headings = 0; @endphp
                    @foreach ($students->rows() as $student)
                        @if ($headings != 0 && $headings != 1)
                            <tr class="border bg-tablebg">
                                <td class="py-2 text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="pl-5">{{ $student[0] }} <input type="hidden" name="studentno[]"
                                        value="{{ $student[0] }}"></td>

                                <td class="pl-5">{{ $student[1] }} <input type="hidden" name="firstname[]"
                                        value="{{ $student[1] }}"></td>

                                <td class="pl-5">{{ $student[2] }} <input type="hidden" name="lastname[]"
                                        value="{{ $student[2] }}"></td>

                                <td class="pl-5">{{ $student[3] }} <input type="hidden" name="middlename[]"
                                        value="{{ $student[3] }}"></td>

                                <td class="pl-5">{{ $student[4] }} <input type="hidden" name="sex[]"
                                        value="{{ $student[4] }}"></td>

                                <td class="pl-5">{{ $student[5] }} <input type="hidden" name="year[]"
                                        value="{{ $student[5] }}"></td>

                                <td class="pl-5">{{ $student[6] }} <input type="hidden" name="course[]"
                                        value="{{ $student[6] }}"></td>

                                <td class="pl-5">{{ $student[7] }} <input type="hidden" name="section[]"
                                        value="{{ $student[7] }}"></td>

                            </tr>
                        @endif
                        @php $headings++; @endphp
                    @endforeach

                </tbody>
            </table>
        </div>
        <button
            class="absolute top-0 right-0 mr-[2%] mt-[-3.5rem] py-2 rounded-xl px-2 placeholder:text-sm w-[100px] lg:py-3 lg:w-[150px] bg-darkblue text-white hover:bg-sky-700">Submit</button>
        {{-- <button class="absolute top-0 right-0 mr-[5%] mt-[-3rem]">submit</button> --}}
    </form>
@endsection
