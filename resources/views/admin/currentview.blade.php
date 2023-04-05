@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <div class="flex justify-center max-lg:justify-start  flex-col max-lg:gap-0">
        <form method="POST" action="{{ route('admin.updateview') }}"
            class="flex flex-col justify-center items-center gap-2 mt-5 max-lg:mt-5 max-sm:w-full max-sm:px-5 px-48">
            @csrf

            <h1 class="" style="font-size: clamp(1.0625rem, 0.9471rem + 0.5128vw, 1.5625rem);">The current view is</h1>
            <select class="w-full text-center border border-gray-300 py-2 px-3 text-lg rounded-md"
                style="font-size: clamp(0.9375rem, 0.8942rem + 0.1923vw, 1.125rem);" name="id">

                @foreach ($allYears as $allYear)
                    <option class="bg-darkblue text-white" value="{{ $allYear->id }}"
                        @if ($allYear->id == $currentyear->school_year_id) selected @endif>{{ $allYear->year }}</option>
                @endforeach
            </select>


            <button type="submit"
                class=" w-full bg-darkblue hover:bg-blue-900 py-2 px-3 text-lg rounded-md text-white">Update</button>

        </form>

        <div class="flex max-xl:flex-col border-t border-gray-300 mt-16 max-sm:mt-5 max-sm:py-10 mx-20 max-xl:mx-0">

            <form class="flex flex-col max-sm:m-0  items-center mx-10 gap-5 mt-14 max-xl:mb-14 sm:gap-3"
                action="{{ route('admin.addyear') }}" method="post">
                @csrf
                <h1 class="text-blacky text-center font-semibold"
                    style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">Add Year</h1>
                {{-- max-lg:w-6/12 max-sm:w-11/12 --}}
                <input
                    class="py-2 border-2 max-sm:w-11/12  rounded-md px-5 mt-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] @error('name') border-red-500 @enderror"
                    value="{{ old('year') }}" type="text" placeholder="Year" name="year" required>
    
                @error('year')
                    <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                        {{ $message }}
                    </div>
                @enderror
    
                <button
                    class="py-2 rounded-md px-5 max-sm:w-11/12 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] bg-darkblue text-white hover:bg-sky-700">Submit</button>
            </form>

            <div class="w-full pb-28 overflow-x-auto  overflow-y-hidden my-14  h-full max-sm:px-5 max-sm:my-6">
                <h1 class="text-blacky text-left font-semibold mb-5"
                    style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">List of Years</h1>
    
                <table
                    class="table-auto text-center w-[1100px] max-lg:w-[900px] max-sm:w-[640px]  text-lg xl:w-full whitespace-nowrap"
                    style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);">
                    <thead>
                        <tr class="space-y-3">
                            <th>Number</th>
                            <th>Year</th>
                            <th>Date Modified</th>
                        </tr>
                    </thead>
    
                    <tbody class="space-y-6 font-semibold bg-tablebg">
    
                        @foreach ($allYears as $allYear)
                        <tr class="border">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $allYear->year }}</td>
                            <td>{{\Carbon\Carbon::parse($allYear->updated_at)->format('F/d/Y') }}</td>
                        </tr>
                    @endforeach
                            
    
    
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    
@endsection

{{-- <form method="POST" action="{{ route('admin.updateview') }}"
    class="flex flex-col justify-center items-center gap-2 mt-[-15rem] max-lg:mt-5 max-sm:w-full max-sm:px-5">
    @csrf


    <h1 class="" style="font-size: clamp(1.0625rem, 0.9471rem + 0.5128vw, 1.5625rem);">Add Year</h1>
    <input type="text" class="w-full border border-gray-300 py-2 px-3 text-lg rounded-md" placeholder="Year"
        name="year">


    <button type="submit"
        class=" w-full bg-darkblue hover:bg-blue-900 py-2 px-3 text-lg rounded-md text-white">Add</button>

</form> --}}
