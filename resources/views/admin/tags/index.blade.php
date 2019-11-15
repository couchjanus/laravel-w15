@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb', ['title' => $title, 'url'=>'admin.tags.create', 'back' => 'admin.tags.index'])
@endsection
@section('content')
<div class="w-11/12 mx-auto">
  <div class="bg-white shadow-md rounded my-6">
    <table> 
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Actions</th>
        </tr>
      </thead>
    
      <tbody>
      @foreach ($tags as $tag)
        <tr>
          <td>{{$tag->id}}</td>
          <td>{{$tag->name}}</td>
          <td>
            <a href="{{route('admin.tags.edit', $tag->id)}}" class="bg-green-300 hover:bg-green-500">Edit</a>
            <a href="#" class="bg-blue-300 hover:bg-blue-500">View</a>
            <form action="{{ route('admin.tags.destroy',  $tag->id) }}" method="post" style="display: inline">@method('DELETE') @csrf
              <button title="Delete category" type="submit" class="text-white font-bold py-1 px-3 rounded text-xs bg-red-300 hover:bg-red-500">Delete</button>
            </form>  
            
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $tags->links() }}
  </div>
</div>
@endsection
