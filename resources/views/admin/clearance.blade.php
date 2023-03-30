@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection

@section('content')
    <div class="px-10 max-sm:px-4 py-5 flex justify-between max-lg:flex-col">
        <div class="max-sm:pb-5 ">
            <h1 class="text-blacky font-semibold" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">
                Deploy student clearances</h1>
            <h1 class="text-green-600 " style="font-size: clamp(1.0625rem, 0.9471rem + 0.5128vw, 1.5625rem);">
                @if (count($profiles) == 0)
                    All clearances are deployed
                @else
                    There are {{ count($profiles) }} student clearance ready to be deployed
                @endif


            </h1>
        </div>

        <div>
            <button
                class="py-2 rounded-xl px-5 max-sm:w-full placeholder:text-sm cursor-pointer w-[400px] lg:py-3 lg:w-[350px] bg-darkblue text-white hover:bg-sky-700"
                onclick="deploy()">Deploy
                clearance</button>
        </div>
    </div>

    <div class="absolute left-0 top-0 w-[100vw] h-[100vh] flex flex-col justify-center items-center hidden"
        id="editDiaglogBox">
        <div class="absolute z-50 bg-white py-5 px-5 rounded-lg">
            <form method="POST" action="{{ route('store.clearance') }}"
                class="flex flex-col justify-center items-center gap-2">
                @csrf

                <h1 class="" style="font-size: clamp(1.0625rem, 0.9471rem + 0.5128vw, 1.5625rem);">Enter Year</h1>
                <select class="w-[200px] border border-gray-300 py-2 px-3 text-lg rounded-md"
                    style="font-size: clamp(0.9375rem, 0.8942rem + 0.1923vw, 1.125rem);" name="id">

                    @foreach ($schoolyears as $schoolyear)
                        <option class="bg-darkblue text-white" value="{{ $schoolyear->id }}">{{ $schoolyear->year }}</option>

                    @endforeach
                </select>


                <button type="submit"
                    class=" w-full bg-blue-500 hover:bg-blue-400 py-2 px-3 text-lg rounded-md text-white">Deploy</button>

            </form>
        </div>
        <div class="absolute bg-black opacity-60 w-[100vw] h-[100vh] z-20" id="bgBlack"></div>

    </div>

    <h1 class="text-blacky font-semibold px-10 mt-10" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">
        Clearances</h1>
    <div class="w-full h-fit pb-28 overflow-x-auto px-3 lg:px-10 xl:px-10 overflow-y-hidden">

        <table id="dataTable"
            class="pl-5 table-auto text-center w-[1920px] max-lg:w-[1280px] max-sm:w-[900px] text-lg xl:w-full"
            style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem); whitespace-nowrap">
            <thead>
                <tr class="space-y-3 pl-10">
                    <th class="text-center pl-5">No.</th>
                    <th class="text-left pl-10">Year</th>
                    <th class="text-left pl-10">Students</th>
                    <th class="text-left pl-10">Action</th>


                </tr>
            </thead>

            <tbody class="space-y-6 border text-left">

                @foreach ($schoolyears as $schoolyear)
                    <tr class="border bg-tablebg">
                        <td class="py-2 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="py-2  pl-10">{{ $schoolyear->year }}</td>
                        <td class="py-2  pl-10">{{ $studentcount[$loop->index]['count'] }}</td>
                        {{-- <td class="py-2  pl-10">{{ $clearance->year }}</td> --}}


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    function deploy() {
    document.getElementById("editDiaglogBox").classList.toggle("hidden");

    };
    document.querySelector("#bgBlack").addEventListener("click", function () {

    document.getElementById("editDiaglogBox").classList.toggle("hidden");
    });
@endsection










{{-- <h1 class="text-blacky font-semibold px-10 mt-10" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">
        Create
        Student Clearance</h1>
    <div class="w-full h-fit pb-28 overflow-x-auto px-3 lg:px-10 xl:px-10 overflow-y-hidden">

        <table id="dataTable"
            class="pl-5 table-auto text-center w-[1920px] max-lg:w-[1280px] max-sm:w-[900px] text-lg xl:w-full"
            style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem); whitespace-nowrap">
            <thead>
                <tr class="space-y-3 pl-5">
                    <th class="text-left pl-9">No.</th>
                    <th class="text-left pl-10">Student No.</th>
                    <th class="text-left pl-10">First Namer</th>
                    <th class="text-left pl-10">Last Name</th>
                    <th class="text-left pl-10">Middle Name</th>
                    <th class="text-left pl-10">Year</th>
                    <th class="text-left pl-10">Course</th>
                    <th class="text-left pl-10">Section</th>
                    <th class="text-left pl-10">Status</th>

                </tr>
            </thead>

            <tbody class="space-y-6 border text-left">

                @foreach ($clearances as $clearance)
                    <tr class="border bg-tablebg">
                        <td class="py-2 pl-5 text-center">
                            {{ ($clearances->currentPage() - 1) * $clearances->perPage() + $loop->iteration }}
                        </td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->studentno }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->firstname }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->lastname }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->middlename }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->year }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->course }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->section }}</td>
                        <td class="py-2  pl-10">{{ $clearance->status }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $clearances->links() }}
    </div> --}}
