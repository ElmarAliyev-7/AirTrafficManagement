@extends('admin.layouts.master')
@section('title', 'About Us')
@section('content')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form action="{{route('admin.about-us')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Title</span>
                <input type="text" name="title"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    value="{{$about_us->title}}"
                />
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Description</span>
                <textarea name="description" value="{{$about_us->description}}"
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    rows="5">{{$about_us->description}}</textarea>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Image</span>
                <input type="file" name="image"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    value="{{asset($about_us->image)}}"
                />
                <img src="{{asset($about_us->image)}}" width="200px" height="200px"/>
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
