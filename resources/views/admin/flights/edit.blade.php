@extends('admin.layouts.master')
@section('title', 'Edit Flight')
@section('content')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form action="{{route('admin.update-flight', $flight->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Area</span>
                <input type="text" name="area" value="{{$flight->area}}"
                       class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                />
            </label>
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Date</span>
                <input type="datetime-local" name="date" value="{{$flight->date}}"
                       class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                />
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Country Image</span>
                <input type="file" name="image"
                       class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                />
                <img src="{{asset($flight->country_image)}}" width="200px" height="180px"/>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Select Pilot
                </span>
                <select name="pilot_id"
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    @foreach($pilots as $pilot)
                        <option value="{{$pilot->id}}" @if($flight->pilot_id == $pilot->id) selected @endif>{{$pilot->fullname}}</option>
                    @endforeach
                </select>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Select Plane
                </span>
                <select name="plane_id"
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    @foreach($planes as $plane)
                        <option value="{{$plane->id}}" @if($flight->plane_id == $plane->id) selected @endif>{{$plane->title}}</option>
                    @endforeach
                </select>
            </label>

            <div class="mt-4">
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
