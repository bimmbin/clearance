@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <div class="w-full h-[80vh] bg-dirtywhite flex items-center justify-around gap-10">
        <div class="w-[25rem] h-[15rem] bg-white relative">
            <div class="absolute top-0 left-0 bg-green-500 h-full w-2"></div>
            <div class="h-full w-full flex items-center justify-center flex-col gap-8">
                <div class="">
                    <h1 class="text-center font-semibold text-3xl">Approved</h1>
                    <h1 class="text-center font-semibold text-3xl">Clearance</h1>
                </div>
                <div class="">
                    <h1 class="text-center font-semibold text-3xl">{{ $clearances->where('status', 'approved')->count() }}</h1>
                </div>
            </div>
        </div>

        <div class="w-[25rem] h-[15rem] bg-white relative">
            <div class="absolute top-0 left-0 bg-red-500 h-full w-2"></div>
            <div class="h-full w-full flex items-center justify-center flex-col gap-8">
                <div class="">
                    <h1 class="text-center font-semibold text-3xl">Dispproved</h1>
                    <h1 class="text-center font-semibold text-3xl">Clearance</h1>
                </div>
                <div class="">
                    <h1 class="text-center font-semibold text-3xl">{{ $clearances->where('status', 'disapproved')->count() }}</h1>
                </div>
            </div>
        </div>

        <div class="w-[25rem] h-[15rem] bg-white relative">
            <div class="absolute top-0 left-0 bg-gray-500 h-full w-2"></div>
            <div class="h-full w-full flex items-center justify-center flex-col gap-8">
                <div class="">
                    <h1 class="text-center font-semibold text-3xl">Pending</h1>
                    <h1 class="text-center font-semibold text-3xl">Clearance</h1>
                </div>
                <div class="">
                    <h1 class="text-center font-semibold text-3xl">{{ $clearances->where('status', 'pending')->count() }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
