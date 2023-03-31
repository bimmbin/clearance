@extends('layout.layout')
@section('docTitle')
    Student Clearance
@endsection


@section('content')
    <div class="flex flex-col pt-10 pb-5 px-5 gap-4 md:px-10 xl:flex-row xl:justify-between">

        <h1 class="text-blacky font-semibold" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">Student
            Clearance</h1>

        <form action="{{ route('search.clearance') }}" method="post" class="relative">
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

    <!-- table here -->

    <div class="w-full pb-10 overflow-x-auto px-3 lg:px-10 xl:px-10">

        <table id="dataTable"
            class="pl-5 table-auto text-center w-[1920px] max-lg:w-[1280px] max-sm:w-[900px] whitespace-nowrap text-lg xl:w-full"
            style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);">
            <thead>
                <tr class="space-y-3 text-sm md:text-base lg:text-lg font-bold text-start">
                    <th class="text-left pl-10">No.</th>
                    <th class="text-left pl-10">Student No.</th>
                    <th class="text-left pl-10">First Name</th>
                    <th class="text-left pl-10">Last Name</th>
                    <th class="text-left pl-10">Middle Name</th>
                    <th class="text-left pl-10">Year</th>
                    <th class="text-left pl-10">Course</th>
                    <th class="text-left pl-10">Section</th>
                    <th class="text-left pl-10">Action</th>
                </tr>
            </thead>

            <tbody class="text-left">
                @foreach ($clearances as $clearance)
                    <tr
                        class="border text-sm md:text-base lg:text-lg font-regular bg-{{ $clearance->status == 'approved' ? 'green-300' : ($clearance->status == 'disapproved' ? 'red-300' : 'tablebg') }}">
                        <td class="py-2  pl-10">
                            {{ ($clearances->currentPage() - 1) * $clearances->perPage() + $loop->iteration }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->studentno }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->firstname }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->lastname }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->middlename }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->year }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->course }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->section }}</td>
                        <td class="py-2  pl-10 flex gap-2">

                            <button class="bg-green-700 hover:bg-green-600 px-4 py-1 rounded-lg text-white"
                                style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem)"
                                onclick="approve('{{ $clearance->id }}')">Approve</button>
                            <button class="bg-red-700 hover:bg-red-600 px-4 py-1 rounded-lg text-white"
                                style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem)" onclick="disapprove('{{ $clearance->id }}')">Disapprove</button>



                            {{-- <div class="absolute left-0 top-0 w-[100vw] h-[100vh] flex justify-center items-center">
                                
                               
                                {
                            </div> --}}

                        </td>
                    </tr>
                @endforeach
                <div class="" id="passId"></div>
                <div class="absolute left-0 top-0 w-[100vw] h-[100vh] flex flex-col justify-center items-center hidden"
                    id="sig-pad">
                    <form method="POST" action="{{ route('approve.clearance') }}">
                        @csrf
                        <canvas id="signature-pad" class="absolute z-50 bg-white"></canvas>
                        <input type="hidden" name="signature" id="signature">
                        <input type="hidden" name="clearanceId" id="clearanceId">
                        <button type="submit" id="signatureBtn"
                            class="absolute z-50 mt-60 bg-blue-500 hover:bg-blue-400 rounded-sm  text-white px-5 py-2">Submit</button>
                    </form>
                    <div class="absolute bg-black opacity-50 w-[100vw] h-[100vh] z-20" id="bgBlack"></div>

                </div>

                <div class="absolute left-0 top-0 w-[100vw] h-[100vh] flex flex-col justify-center items-center hidden"
                    id="editDiaglogBox2">
                    <div class="absolute z-50 bg-white py-5 px-5 rounded-lg">
                        <form method="POST" action="{{ route('disapprove.clearance') }}"
                            class="flex flex-col justify-center items-center gap-2">
                            @csrf

                            <h1 class="text-center" style="font-size: clamp(1.0625rem, 0.9471rem + 0.5128vw, 1.5625rem);">Remarks of disapproval</h1>
      
                            <textarea name="remarks" id="" cols="50" rows="5" class="w-full border border-gray-300 py-2 px-3 text-lg rounded-md" style="font-size: clamp(0.9375rem, 0.8942rem + 0.1923vw, 1.125rem);"></textarea>
                            <input type="hidden" name="id" id="disId">
                            
                            <button type="submit"
                                class=" w-full bg-blue-500 hover:bg-blue-400 py-2 px-3 text-lg rounded-md text-white">Submit</button>

                        </form>
                    </div>
                    <div class="absolute bg-black opacity-60 w-[100vw] h-[100vh] z-20" id="bgBlack2"></div>

                </div>
            </tbody>
        </table>
        {{ $clearances->links() }}
    </div>
@endsection




@section('script')
    function approve(id) {
    {{-- alert(a); --}}
    document.getElementById("sig-pad").classList.toggle("hidden");
    const canvas = document.querySelector("canvas");

    const signaturePad = new SignaturePad(canvas);
    canvas.width = 400;
    canvas.height = 200;

    const saveJPGButton = document.querySelector("#signatureBtn");

    saveJPGButton.addEventListener("click", function (event) {
    if (signaturePad.isEmpty()) {
    alert("Please provide a signature first.");
    event.preventDefault();
    } else {
    var signatureData = signaturePad.toDataURL();
    document.getElementById("signature").value = signatureData;
    document.getElementById("clearanceId").value = id;
    }
    });
    }


    document.querySelector("#bgBlack").addEventListener("click", function () {
        document.getElementById("sig-pad").classList.add("hidden");
    });

    
    function disapprove(id) {
        document.getElementById("editDiaglogBox2").classList.toggle("hidden");
        document.getElementById("disId").value = id;
    }
    document.querySelector("#bgBlack2").addEventListener("click", function () {
        document.getElementById("editDiaglogBox2").classList.add("hidden");
    });
@endsection








{{-- @foreach (range(1, 10) as $i)
    document.querySelector("#approve-{{ $i }}").addEventListener("click", function (event) {
        document.getElementById("signature").value = signatureData;
      });
    @endforeach --}}
