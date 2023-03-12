@extends('layout.layout')
@section('docTitle')
    Student Clearance
@endsection


@section('content')
    <div class="flex flex-col pt-10 pb-5 px-5 gap-4 md:px-10 xl:flex-row xl:justify-between">

        <h1 class="text-blacky font-semibold" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">Student
            Clearance</h1>

        <div class="relative">
            <input type="text" id="searchInput"
                class="border-2 text-gray-700 rounded-xl py-2 pl-5 pr-4 focus:outline-none focus:shadow-outline w-full xl:w-[500px]"
                placeholder="Search...">
            <button class="absolute right-0 top-0 mt-3 mr-4">
                <svg class="h-5 w-5 text-gray-600" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </div>

    </div>

    <!-- table here -->

    <div class="w-full h-fit pb-28 overflow-x-auto px-3 lg:px-10 xl:px-10 overflow-y-hidden">

        <table id="dataTable" class="pl-5 table-auto text-center w-[1920px] max-lg:w-[1280px] max-sm:w-[900px] text-lg xl:w-full"
            style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem); ">
            <thead>
                <tr class="space-y-3 text-sm md:text-base lg:text-lg font-bold text-start">
                    <th class="text-left pl-10">No.</th>
                    <th class="text-left pl-10">Student No.</th>
                    <th class="text-left pl-10">First Namer</th>
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
                        <td class="py-2  pl-10">{{ $loop->iteration }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->studentno }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->firstname }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->lastname }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->middlename }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->year }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->course }}</td>
                        <td class="py-2  pl-10">{{ $clearance->profiles->section }}</td>
                        <td class="py-2  pl-10 flex gap-2">
                    
                            <div class="relative whitespace-nowrap">
                                <div class="bg-btnbg cursor-pointer hover:bg-btnhoverbg rounded-md"
                                    onclick="dropEdit{{ $loop->index }}()">
                                    <img class="max-w-[29px] max-h-[29px]" src="img/icons/edit-icon.png" alt="">

                                </div>
                                <div class="absolute bg-btnbg  rounded-md top-7 right-0 z-10 hidden"
                                    id="edit-{{ $loop->index }}">
                                    <form action="" method="post" class="flex flex-col">
                                        @csrf
                                        <button class="py-3 px-5 hover:bg-btnhoverbg">Edit Name</button>
                                        <button class="py-3 px-5 hover:bg-btnhoverbg">Edit Lastname</button>
                                    </form>
                                </div>
                            </div>
                            <div class="relative">
                                <div class="bg-btnbg cursor-pointer hover:bg-btnhoverbg rounded-md"
                                    onclick="dropSetting{{ $loop->index }}()">
                                    <img class="max-w-[29px] max-h-[29px]" src="img/icons/setting-icon.png" alt="">

                                </div>
                                <div class="absolute bg-btnbg  rounded-md top-7 right-0 z-10 hidden"
                                    id="setting-{{ $loop->index }}">
                                    <form action="{{ route('disapprove.clearance', $clearance->id) }}" method="post" class="flex flex-col">
                                        @csrf
                                        <button class="py-3 px-5 hover:bg-btnhoverbg">Disapprove</button>
                                    </form>
                                </div>
                            </div>
                          
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $clearances->links() }}
    </div>
@endsection



@section('script')
    
@endsection
