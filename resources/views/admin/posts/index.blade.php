@extends('layouts.admin')

@section('content')
<div class="flex flex-row flex-wrap flex-grow mt-2">
    <div class="w-full md:w-8/9 xl:w-8/9 p-3">
        <!--Table Card-->
        <div class="bg-white border-transparent rounded-lg shadow-lg">
            <div class="bg-gray-400 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-gray-600">Table</h5>
            </div>
            <div class="p-5">

                <table class="w-full p-5 text-gray-700">
                    <thead>
                    <thead>
                        <tr>
                            <th class="text-left text-blue-900">Id</th>
                            <th class="text-left text-blue-900">Title</th>
                            <th class="text-left text-blue-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                <a href="#" class="bg-green-300 hover:bg-green-500">Edit</a>
                                <a href="#" class="bg-blue-300 hover:bg-blue-500">View</a>
                                <a href="#" class="bg-red-300 hover:bg-red-500">Delete</a>
                            </td>
                        </tr>
                        <!-- /.row -->
                        @endforeach
                    </tbody>
                </table>
                <p class="py-2"><a href="#">See More issues...</a></p>

            </div>
        </div>
        <!--/table Card-->
    </div>
</div>
@endsection
