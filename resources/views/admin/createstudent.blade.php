@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <h1 class="text-blacky font-semibold ml-[83px] pt-[30px]"
        style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">
        Create Student Account</h1>
    <div class="flex w-full px-10 max-sm:px-5 pb-10 pt-5 flex-col gap-5 lg:flex-row overflow-x-hidden ">
        <div class="">
            <form class="flex flex-col max-sm:my-1 max-sm:mx-0  mx-10 gap-5 max-xl:mb-14 sm:gap-3" action=""
                method="post">
                {{-- {{ route('admin.createofficer') }} --}}
                @csrf
                <h1 class="text-blacky font-medium text-8xl"
                    style="font-size: clamp(1.0625rem, 0.8864rem + 0.5634vw, 1.5625rem);">Single Account</h1>

                <input
                    class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] @error('employeeno') border-red-500 @enderror"
                    value="{{ old('employeeno') }}" type="text" placeholder="Employee Number" name="employeeno">

                @error('employeeno')
                    <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <input
                    class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] @error('firstname') border-red-500 @enderror"
                    value="{{ old('firstname') }}" type="text" placeholder="First name" name="firstname">

                @error('firstname')
                    <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <input
                    class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] @error('lastname') border-red-500 @enderror"
                    value="{{ old('lastname') }}" type="text" placeholder="Last name" name="lastname">

                @error('lastname')
                    <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <input
                    class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] @error('middlename') border-red-500 @enderror"
                    value="{{ old('middlename') }}" type="text" placeholder="Middle name" name="middlename">

                @error('middlename')
                    <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                        {{ $message }}
                    </div>
                @enderror
                {{-- <input class="py-2 border-2 rounded-xl max-sm:w-11/12 px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[450px]"
                type="text" placeholder="Sex" name="sex"> --}}

                <select
                    class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px]">

                    <option class="bg-darkblue text-white" value="Male">Male</option>
                    <option class="bg-darkblue text-white" value="Female">Female</option>

                </select>

                <button
                    class="py-2 rounded-xl px-5 max-sm:w-full placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] bg-darkblue text-white hover:bg-sky-700">Submit</button>
            </form>
        </div>

        <div class="max-h-full w-1 border-l border-gray-300"></div>

        <div class="pl-10 max-sm:pl-0">
            <h1 class="text-blacky font-medium" style="font-size: clamp(1.0625rem, 0.8864rem + 0.5634vw, 1.5625rem);">
                Mass Create using excel</h1>


            <form action="{{ route('previewTable') }}" method="post" enctype="multipart/form-data" class="flex flex-col">
                @csrf
                <input class=" py-5  @error('employeeno') border-red-500 @enderror"
                    style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);" type="file" name="file">

                @error('file')
                    <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <button type="submit" class=" bg-darkblue text-white rounded-xl py-3 max-sm:w-full max-xl:w-[250px] w-full"
                    type="submit" style="font-size: clamp(1rem, 0.875rem + 0.3125vw, 1.25rem);">Upload</button>
            </form>
        </div>
    </div>

    <div class="border-b w-[90%] mx-auto max-xl:h-[90%] max-xl:h-0 max-xl:mx-auto max-xl:my-0"></div>

    <div class="flex flex-col py-5 px-5 gap-4 md:px-10 xl:flex-row xl:justify-between">

        <h1 class="text-blacky font-semibold" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">List
            of Students</h1>

    </div>


    <div class="w-full h-fit pb-28 overflow-x-auto px-3 lg:px-10 xl:px-10 overflow-y-hidden">

        <table id="dataTable"
            class="pl-5 table-auto text-center w-[1920px] max-lg:w-[1280px] max-sm:w-[900px] text-lg xl:w-full"
            style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem); whitespace-nowrap">
            <thead>
                <tr class="space-y-3 pl-5">
                    <th class="text-left pl-12">Number</th>
                    <th class="text-left pl-5">Student No.</th>
                    <th class="text-left pl-5">First Name</th>
                    <th class="text-left pl-5">Last Name</th>
                    <th class="text-left pl-5">Middle Name</th>
                    <th class="text-left pl-5">Sex</th>
                    <th class="text-left pl-5">Year</th>
                    <th class="text-left pl-5">Course</th>
                    <th class="text-left pl-5">Section</th>
                    <th class="text-left pl-5"">Action</th>
                </tr>
            </thead>

            <tbody class="space-y-6 border text-left">

                @foreach ($students as $student)
                    <tr class="border bg-tablebg">
                        <td class="py-2 text-center">
                            {{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}
                        </td>
                        <td class="pl-5">{{ $student->studentno }}</td>
                        <td class="pl-5">{{ $student->firstname }}</td>
                        <td class="pl-5">{{ $student->lastname }}</td>
                        <td class="pl-5">{{ $student->middlename }}</td>
                        <td class="pl-5">{{ $student->sex }}</td>
                        <td class="pl-5">{{ $student->year }}</td>
                        <td class="pl-5">{{ $student->course }}</td>
                        <td class="pl-5">{{ $student->section }}</td>
                        <td class="pl-5 py-2 flex gap-2">

                            <div class="relative">
                                <div class="bg-btnbg cursor-pointer hover:bg-btnhoverbg rounded-md"
                                    onclick="editStudent(

                                        '{{ $student->studentno }}',
                                        '{{ $student->firstname }}',
                                        '{{ $student->lastname }}',
                                        '{{ $student->middlename }}',
                                        '{{ $student->sex }}',
                                        '{{ $student->year }}',
                                        '{{ $student->course }}',
                                        '{{ $student->section }}',
                                        '{{ $student->id }}',
                                        
                                        )">
                                    <img class="max-w-[29px] max-h-[29px]" src="img/icons/edit-icon.png" alt="">

                                </div>

                            </div>


                        </td>
                    </tr>
                @endforeach
                <div class="absolute left-0 top-0 w-[100vw] h-[100vh] flex flex-col justify-center items-center hidden"
                    id="editDiaglogBox">
                    <div class="absolute z-50 bg-white py-5 px-5 rounded-lg">
                        <form method="POST" action="{{ route('edit.student') }}"
                            class="flex flex-col justify-center items-center">
                            @csrf

                            <input type="text" class="w-[200px] border border-gray-300 py-2 px-3 text-lg rounded-md"
                                id="a" placeholder="Student No" name="studentno">
                            <input type="text" class="w-[200px] border border-gray-300 py-2 px-3 text-lg rounded-md"
                                id="b" placeholder="First Name" name="firstname">
                            <input type="text" class="w-[200px] border border-gray-300 py-2 px-3 text-lg rounded-md"
                                id="c" placeholder="Last Name" name="lastname">
                            <input type="text" class="w-[200px] border border-gray-300 py-2 px-3 text-lg rounded-md"
                                id="d" placeholder="Middle Name" name="middlename">
                            <span type="submit" id="cancelBtn"
                                class=" w-[100px] bg-gray-400 hover:bg-gray-500 py-2 px-3 text-lg rounded-md text-white text-center cursor-pointer">Cancel</span>
                            </br>

                            <input type="text" class="w-[200px] border border-gray-300 py-2 px-3 text-lg rounded-md"
                                id="e" placeholder="Sex" name="sex">
                            <input type="text" class="w-[200px] border border-gray-300 py-2 px-3 text-lg rounded-md"
                                id="f" placeholder="Year" name="year">
                            <input type="text" class="w-[200px] border border-gray-300 py-2 px-3 text-lg rounded-md"
                                id="g" placeholder="Course" name="course">
                            <input type="text" class="w-[200px] border border-gray-300 py-2 px-3 text-lg rounded-md"
                                id="h" placeholder="Section" name="section">
                            <input type="hidden" id="i" name="id">
                            <button type="submit"
                                class=" w-[100px] bg-blue-500 hover:bg-blue-400 py-2 px-3 text-lg rounded-md text-white">Save</button>

                        </form>
                    </div>
                    <div class="absolute bg-black opacity-60 w-[100vw] h-[100vh] z-20" id="bgBlack"></div>

                </div>
            </tbody>
        </table>
        {{ $students->links() }}
    </div>
@endsection

@section('script')
    document.querySelector("#cancelBtn").addEventListener("click", function () {

    document.getElementById("editDiaglogBox").classList.toggle("hidden");
    });


    function editStudent(a,b,c,d,e,f,g,h,i) {
    document.getElementById("editDiaglogBox").classList.toggle("hidden");


    document.getElementById("a").value = a;
    document.getElementById("b").value = b;
    document.getElementById("c").value = c;
    document.getElementById("d").value = d;
    document.getElementById("e").value = e;
    document.getElementById("f").value = f;
    document.getElementById("g").value = g;
    document.getElementById("h").value = h;
    document.getElementById("i").value = i;

    };
@endsection
