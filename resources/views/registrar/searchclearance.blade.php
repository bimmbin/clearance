@extends('layout.layout')
@section('docTitle')
    Search Clearance
@endsection


@section('content')
    <div class="flex flex-col pt-10 pb-5 px-5 gap-4 md:px-10 xl:flex-row xl:justify-between">

        <h1 class="text-blacky font-semibold" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">Student
            Clearance</h1>

        <form action="{{ route('registrar.search') }}" method="post" class="relative">
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
                @foreach ($profiles as $profile)
                    <tr class="bg-tablebg border">
                        <td class="py-2  pl-10">
                            {{ ($profiles->currentPage() - 1) * $profiles->perPage() + $loop->iteration }}</td>
                        <td class="py-2  pl-10">{{ $profile->studentno }}</td>
                        <td class="py-2  pl-10">{{ $profile->firstname }}</td>
                        <td class="py-2  pl-10">{{ $profile->lastname }}</td>
                        <td class="py-2  pl-10">{{ $profile->middlename }}</td>
                        <td class="py-2  pl-10">{{ $profile->year }}</td>
                        <td class="py-2  pl-10">{{ $profile->course }}</td>
                        <td class="py-2  pl-10">{{ $profile->section }}</td>
                        <td class="py-2  pl-10 flex gap-2">

                            <button class="bg-darkblue hover:bg-blue-900  px-4 py-1 rounded-lg text-white"
                                style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem)"
                                onclick="clearance{{ $loop->iteration }}()">Clearance</button>

                            <div class="absolute left-0 top-0 w-[100vw] h-[100vh] flex flex-col justify-center items-center hidden"
                                id="editDiaglogBox{{ $loop->iteration }}">
                                <div class="absolute z-50 bg-white py-5 px-5 rounded-lg">
                                    <table id="dataTable"
                                        class="pl-5 table-auto text-center w-full whitespace-nowrap text-lg"
                                        style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);">
                                        <thead>
                                            <tr class="space-y-3 text-sm md:text-base lg:text-lg font-bold text-start">
                                                <th class="text-left pl-10 py-2 px-5">No.</th>
                                                <th class="text-left pl-10 py-4 px-5">Department</th>
                                                <th class="text-left pl-10 py-4 px-5">Officer</th>
                                                <th class="text-left pl-10 py-4 px-5">Status</th>
                                                <th class="text-left pl-10 py-4 px-5">Signature/Remarks</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-left">
                                            @foreach ($profile->clearance()->whereHas('schoolyear.currentyear', function ($query) {
                                                $query->where('id', '1');
                                            })->get() as $clearans)
                                                <tr
                                                    class="border text-sm md:text-base lg:text-lg font-regular bg-{{ $clearans->status == 'approved' ? 'green-300' : ($clearans->status == 'disapproved' ? 'red-300' : 'tablebg') }}">
                                                    <td class="pl-10 py-4 px-5">{{ $loop->iteration }}</td>
                                                    <td class="pl-10 py-4 px-5">{{ $clearans->department->name }}</td>
                                                    <td class="pl-10 py-4 px-5">
                                                        {{ $clearans->department->profiles->firstname . ' ' . $clearans->department->profiles->lastname }}
                                                    </td>
                                                    <td class="pl-10 py-4 px-5">{{ $clearans->status }}</td>
                                                    <td class="max-w-[30rem] whitespace-normal">
                                                        @php
                                                            $itereytOnce = 0;
                                                        @endphp

                                                        {{-- //if this clearance equals to signature['id'] then get the signature cipher code  --}}
                                                        @foreach ($signatures as $signature)
                                                            @if ($clearans->id == $signature['clearance_id'])
                                                                <img class="w-48"
                                                                    src="data:image/jpeg;base64,{{ $signature['signature'] }}" />
                                                            @else
                                                                @if ($itereytOnce == 0)
                                                                    {{ $clearans->remarks }}
                                                                    @php
                                                                        $itereytOnce++;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="absolute bg-black opacity-60 w-[100vw] h-[100vh] z-20"
                                    id="bgBlack{{ $loop->iteration }}"></div>

                            </div>

                            {{-- <div class="absolute left-0 top-0 w-[100vw] h-[100vh] flex justify-center items-center">
                                
                               
                                {
                            </div> --}}

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $profiles->links() }}
    </div>
@endsection




@section('script')
    @foreach (range(1, 10) as $i)
        function clearance{{ $i }}() {
        document.getElementById("editDiaglogBox{{ $i }}").classList.toggle("hidden");
        }
        document.querySelector("#bgBlack{{ $i }}").addEventListener("click", function () {
        document.getElementById("editDiaglogBox{{ $i }}").classList.toggle("hidden");
        });
    @endforeach
@endsection








{{-- @foreach (range(1, 10) as $i)
    document.querySelector("#approve-{{ $i }}").addEventListener("click", function (event) {
        document.getElementById("signature").value = signatureData;
      });
    @endforeach --}}
