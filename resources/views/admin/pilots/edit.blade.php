@extends('admin.layouts.master')
@section('title', 'Edit Pilot')
@section('content')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form action="{{route('admin.update-pilot', $pilot->id)}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Fullname</span>
                <input type="text" name="fullname" value="{{$pilot->fullname}}"
                       class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                />
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">About</span>
                <textarea name="about"
                          class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          rows="5">{{$pilot->about}}</textarea>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Image</span>
                <input type="file" name="image"
                       class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                       value="{{asset($pilot->image)}}"
                />
                <img src="{{asset($pilot->image)}}" width="200px" height="200px"/>
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
