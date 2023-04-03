@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <div class="flex justify-center max-lg:justify-start  max-lg:flex-col items-center h-[80vh] gap-48 max-lg:gap-0">
        <form method="POST" action="{{ route('admin.updateview') }}" class="flex flex-col justify-center items-center gap-2 mt-[-15rem] max-lg:mt-5 max-sm:w-full max-sm:px-5">
            @csrf

            <h1 class="" style="font-size: clamp(1.0625rem, 0.9471rem + 0.5128vw, 1.5625rem);">The current view is</h1>
            <select class="w-full text-center border border-gray-300 py-2 px-3 text-lg rounded-md"
                style="font-size: clamp(0.9375rem, 0.8942rem + 0.1923vw, 1.125rem);" name="id">

                @foreach ($allYears as $allYear)
                    <option class="bg-darkblue text-white" value="{{ $allYear->id }}" 
                        @if ($allYear->id == $currentyear->school_year_id)
                            selected
                    @endif>{{ $allYear->year }}</option>
                @endforeach
            </select>


            <button type="submit"
                class=" w-full bg-darkblue hover:bg-blue-900 py-2 px-3 text-lg rounded-md text-white">Update</button>

        </form>
        <form method="POST" action="{{ route('admin.updateview') }}" class="flex flex-col justify-center items-center gap-2 mt-[-15rem] max-lg:mt-5 max-sm:w-full max-sm:px-5">
            @csrf
        

            <h1 class="" style="font-size: clamp(1.0625rem, 0.9471rem + 0.5128vw, 1.5625rem);">Add Year</h1>
            <input type="text" class="w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                 placeholder="Year" name="year">


            <button type="submit"
                class=" w-full bg-darkblue hover:bg-blue-900 py-2 px-3 text-lg rounded-md text-white">Add</button>

        </form>
        
    </div>
@endsection
