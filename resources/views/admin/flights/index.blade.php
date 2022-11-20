@extends('admin.layouts.master')
@section('title', 'Flights')
@section('content')
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Area</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Country Image</th>
                    <th class="px-4 py-3">Pilot</th>
                    <th class="px-4 py-3">Plane</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($flights as $flight)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">{{$loop->iteration}}</td>
                        <td class="px-4 py-3 text-sm">{{$flight->area}}</td>
                        <td class="px-4 py-3 text-sm">{{$flight->date}}</td>
                        <td class="px-4 py-3 text-sm"><img src="{{asset($flight->country_image)}}" width="60px" height="45px"/></td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div
                                    class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                                >
                                    <img
                                        class="object-cover w-full h-full rounded-full"
                                        src="{{asset($flight->pilot->image)}}"
                                        alt=""
                                        loading="lazy"
                                    />
                                    <div
                                        class="absolute inset-0 rounded-full shadow-inner"
                                        aria-hidden="true"
                                    ></div>
                                </div>
                                <div>
                                    <p class="font-semibold">{{$flight->pilot->fullname}}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div
                                    class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                                >
                                    <img
                                        class="object-cover w-full h-full rounded-full"
                                        src="{{asset($flight->plane->image)}}"
                                        alt=""
                                        loading="lazy"
                                    />
                                    <div
                                        class="absolute inset-0 rounded-full shadow-inner"
                                        aria-hidden="true"
                                    ></div>
                                </div>
                                <div>
                                    <p class="font-semibold">{{$flight->plane->title}}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{route('admin.update-flight', $flight->id)}}">
                                <button
                                    class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                >
                                    Edit
                                </button>
                            </a>

                            <form method="post" action="{{route('admin.delete-flight', $flight->id)}}" style="margin-top: 4px;">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
