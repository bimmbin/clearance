@extends('layout.layout')
@section('docTitle')
    Student Clearance
@endsection


@section('content')
    <div class="flex flex-col pt-10 pb-5 px-5 gap-4 md:px-10 xl:flex-row xl:justify-between">
        <div class="flex flex-col">
            <h1 class="text-blacky font-semibold" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">Student
                Clearance</h1>
            <h1 class="text-blacky" style="font-size: clamp(0.9375rem, 0.8942rem + 0.1923vw, 1.125rem);">Year: {{ $yr }}</h1>
        </div>
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

    <div class="w-full pb-10 overflow-x-auto px-3 lg:px-10 xl:px-10">

        <table id="dataTable"
            class="pl-5 table-auto text-center w-[1920px] max-lg:w-[1280px] max-sm:w-[900px] text-lg xl:w-full"
            style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);">
            <thead>
                <tr class="space-y-3 text-sm md:text-base lg:text-lg font-bold text-start">
                    <th class="text-left pl-10">No.</th>
                    <th class="text-left pl-10">Department Name</th>
                    <th class="text-left pl-10">Assigned Officer</th>
                    <th class="text-left pl-10">Status</th>
                    <th class="text-left pl-10">Signature</th>
                    <th class="text-left pl-10">Remarks</th>
                </tr>
            </thead>

            <tbody class="text-left">
                @foreach ($clearances as $clearance)
                    <tr
                        class="border text-sm md:text-base lg:text-lg font-regular bg-{{ $clearance->status == 'approved' ? 'green-300' : ($clearance->status == 'disapproved' ? 'red-300' : 'tablebg') }}">
                        <td class="py-2  pl-10">{{ $loop->iteration }}</td>
                        <td class="py-2  pl-10">{{ $clearance->department->name }}</td>
                        <td class="py-2  pl-10">
                            {{ $clearance->department->profiles->firstname . ' ' . $clearance->department->profiles->lastname }}
                        </td>
                        <td class="py-2  pl-10">{{ $clearance->status }}</td>
                        <td class="py-2  pl-10">



                            {{-- //if this clearance equals to signature['id'] then get the signature cipher code  --}}                         
                            @foreach ($signatures as $signature)
                                @if ($clearance->id == $signature['clearance_id'])
                                    <img class="w-48"
                                        src="data:image/jpeg;base64,{{ $signature['signature'] }}" />
                                @else
                                    {{-- NA --}}
                                @endif
                            @endforeach
                        </td>
                        <td class="py-2  pl-10">{{ $clearance->remarks }}</td>

                    </tr>
                @endforeach









            </tbody>
        </table>

    </div>
@endsection
