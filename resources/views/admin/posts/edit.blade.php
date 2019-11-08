@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb', ['title' => $title, 'url'=>'admin/posts', 'back'=>true])
@endsection

@section('content')
    <div class="w-full mx-auto">
    <div class="bg-white shadow-md rounded my-6">
        <form class="w-full" method="POST" action="{{route('admin.posts.update', $post->id)}}">
            @csrf
            @method("PUT")
            <div class="flex flex-wrap mx-3 mb-6">
                <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-title">
                    Title
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-title" name="title" type="text" value="{{ $post->title }}">
                </div>
            </div>
            <div class="flex flex-wrap mx-3 mb-6">
                <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    Content
                </label>
                <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-content" name="content">{{ $post->content }}
                </textarea>
                
                </div>
            </div>
            <div class="flex flex-wrap mx-3 mb-12">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-status">
                    Status
                </label>
                <div class="relative">
                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-status" name="status">
                        @foreach($status as $key => $value)
                                    <option value="{{ $key }}" 
                                    @if ($key == $post->status)
                                            selected="selected"
                                        @endif
                                        >{{ $value }}
                                    </option>
                                @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-category">
                    Category
                </label>
                <div class="relative">
                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-category" name="category_id">
                        @foreach ($categories as $key => $value)
                                <option value="{{ $key }}"
                                    @if ($key == $post->category_id)
                                        selected="selected"
                                    @endif
                                    >{{ $value }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-active">
                    Active
                </label>

                <input class="mr-2 leading-tight" type="checkbox" id="grid-active" name="published">
                <span class="text-sm">
                    Active
                </span>
            </div>
            <div class="md:flex md:items-center mb-2 mt-2 mx-auto">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Save</button>
            </div>
        </form>
    </div>
    </div>   
@endsection
