@extends('layout.layout')
@section('docTitle')
    Search student
@endsection


@section('content')
    <div class="pt-[30px]">
        <button
            class="text-white font-semibold max-sm:ml-5 max-lg:ml-10 ml-[83px] w-fit bg-darkblue px-3 py-1 rounded-lg cursor-pointer"
            style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);" id="createBtn">
            Create Student Account</button>
    </div>
    <div class="flex w-full px-10 max-lg:px-5 max-sm:px-5 pb-10 pt-5 max-xl:flex-col overflow-x-hidden justify-between hidden"
        id="createSection">
        <div class="">
            <form
                class="flex flex-col  max-sm:my-1 max-sm:mx-0 max-lg:mx-5 mx-10 gap-5 max-xl:mb-14 sm:gap-3 w-full max-sm:mb-5"
                action=" {{ route('admin.createsingle') }}" method="post">

                @csrf
                <h1 class="text-blacky font-medium text-8xl"
                    style="font-size: clamp(1.0625rem, 0.8864rem + 0.5634vw, 1.5625rem);">Single Account</h1>

                <div
                    class="flex flex-col flex-wrap max-sm:flex-nowrap max-h-[15rem] max-sm:max-h-full w-fit max-sm:w-full gap-2">
                    <input
                        class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[300px] @error('studentno') border-red-500 @enderror"
                        value="{{ old('studentno') }}" type="text" placeholder="Student Number" name="studentno">

                    @error('studentno')
                        <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    <input
                        class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[300px] @error('firstname') border-red-500 @enderror"
                        value="{{ old('firstname') }}" type="text" placeholder="First name" name="firstname">

                    @error('firstname')
                        <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    <input
                        class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[300px] @error('lastname') border-red-500 @enderror"
                        value="{{ old('lastname') }}" type="text" placeholder="Last name" name="lastname">

                    @error('lastname')
                        <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    <input
                        class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[300px] @error('middlename') border-red-500 @enderror"
                        value="{{ old('middlename') }}" type="text" placeholder="Middle name" name="middlename">

                    @error('middlename')
                        <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    {{-- <input class="py-2 border-2 rounded-xl max-sm:w-11/12 px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[450px]"
                type="text" placeholder="Sex" name="sex"> --}}

                    <select
                        class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[300px]"
                        name="sex">

                        <option class="bg-darkblue text-white" value="Male">Male</option>
                        <option class="bg-darkblue text-white" value="Female">Female</option>

                    </select>

                    <input
                        class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[300px] @error('year') border-red-500 @enderror"
                        value="{{ old('year') }}" type="text" placeholder="Year" name="year">

                    @error('year')
                        <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    <input
                        class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[300px] @error('course') border-red-500 @enderror"
                        value="{{ old('course') }}" type="text" placeholder="Course" name="course">

                    @error('course')
                        <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    <input
                        class="py-2 border-2 rounded-xl max-sm:w-full px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[300px] @error('section') border-red-500 @enderror"
                        value="{{ old('section') }}" type="text" placeholder="Section" name="section">

                    @error('section')
                        <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button
                    class="py-2 rounded-xl px-5 w-[610px] max-sm:w-full placeholder:text-sm lg:py-3   bg-darkblue text-white hover:bg-sky-700">Submit</button>
            </form>
        </div>

        <div class="pl-10 max-sm:pl-0 border-l max-xl:border-l-0 max-xl:border-t max-xl:pt-5 border-gray-300">
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

        <form action="{{ route('search.student') }}" method="post" class="relative">
            @csrf
            <input type="text" name="search"
                class="border-2 text-gray-700 rounded-xl py-2 pl-5 pr-4 focus:outline-none focus:shadow-outline w-full xl:w-[500px]"
                placeholder="Search...">
            <button class="absolute right-0 top-0 mt-3 mr-4">
                <svg class="h-5 w-5 text-gray-600" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </form>

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
                    <th class="text-left pl-5">Action</th>
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
                <div class="absolute z-50 bg-white py-5 px-5 rounded-lg ">
                    <form action="{{ route('edit.student') }}" method="post"
                        class="flex justify-center items-center">
                        @csrf

                        <div class="flex max-sm:flex-col items-center">
                            <div class="flex w-[53rem] max-sm:w-full  flex-wrap gap-2 justify-center items-center max-sm:flex-col">
                                <div class="flex flex-col max-sm:w-full">
                                    <label for="a" class="font-semibold text-sm">Student Number</label>
                                    <input type="text"
                                        class="w-[200px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="a" placeholder="Student No" name="studentno">
                                </div>

                                <div class="flex flex-col">
                                    <label for="b" class="font-semibold text-sm">First Name</label>
                                    <input type="text"
                                        class="w-[200px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="b" placeholder="First Name" name="firstname">
                                </div>

                                <div class="flex flex-col">
                                    <label for="c" class="font-semibold text-sm">Last Name</label>
                                    <input type="text"
                                        class="w-[200px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="c" placeholder="Last Name" name="lastname">
                                </div>

                                <div class="flex flex-col">
                                    <label for="d" class="font-semibold text-sm">Middle Name</label>
                                    <input type="text"
                                        class="w-[200px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="d" placeholder="Middle Name" name="middlename">
                                </div>


                                <div class="flex flex-col">
                                    <label for="e" class="font-semibold text-sm">Gender</label>

                                    <input type="text"
                                        class="w-[200px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="e" placeholder="Sex" name="sex">
                                </div>

                                <div class="flex flex-col">
                                    <label for="f" class="font-semibold text-sm">Year</label>
                                    <input type="text"
                                        class="w-[200px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="f" placeholder="Year" name="year">
                                </div>

                                <div class="flex flex-col">
                                    <label for="g" class="font-semibold text-sm">Course</label>
                                    <input type="text"
                                        class="w-[200px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="g" placeholder="Course" name="course">
                                </div>

                                <div class="flex flex-col">
                                    <label for="h" class="font-semibold text-sm">Section</label>
                                    <input type="text"
                                        class="w-[200px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="h" placeholder="Section" name="section">
                                </div>

                                <input type="hidden" id="i" name="id">
                            </div>

                            <div class="flex flex-col gap-2  max-sm:w-full  max-sm:mt-2">
                                <span type="submit" id="cancelBtn"
                                    class=" w-[100px] max-sm:w-full bg-gray-400 hover:bg-gray-500 py-2 px-3 text-lg rounded-md text-white text-center cursor-pointer flex-1 flex items-center justify-center">Cancel</span>
                                <button type="submit"
                                    class=" w-[100px] max-sm:w-full bg-blue-500 hover:bg-blue-400 py-2 px-3 text-lg rounded-md text-white flex-1">Save</button>
                            </div>
                        </div>
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
    document.querySelector("#bgBlack").addEventListener("click", function () {

    document.getElementById("editDiaglogBox").classList.toggle("hidden");
    });

    document.querySelector("#createBtn").addEventListener("click", function () {

    document.getElementById("createSection").classList.toggle("hidden");
    });
@endsection
