@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb', ['title' => $title, 'url'=>'admin.categories.create', 'getStatus' => 'admin.categories.status'])
@endsection
@section('content')
<div class="w-11/12 mx-auto">
  <div class="bg-white shadow-md rounded my-6">
    <table> 
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th><a href="{{ route('admin.categories.index', ['order' => ($order=='desc')?'asc':'desc']) }}">Modified</a></th>
          <th>Actions</th>
        </tr>
      </thead>
    
      <tbody>
      @foreach ($categories as $category)
        <tr>
          <td>{{$category->id}}</td>
          <td>{{$category->name}}</td>
          <td>{{$category->updated_at}}</td>
          <td>
            <a href="{{route('admin.categories.edit', $category->id)}}" class="bg-green-300 hover:bg-green-500">Edit</a>
            <a href="#" class="bg-blue-300 hover:bg-blue-500">View</a>
            <form action="{{ route('admin.categories.destroy',  $category->id) }}" method="post" style="display: inline">@method('DELETE') @csrf
              <button title="Delete category" type="submit" class="text-white font-bold py-1 px-3 rounded text-xs bg-red-300 hover:bg-red-500">Delete</button>
            </form>  
            
          </td>
        </tr>
        <!-- /.blog-post -->
        @endforeach
      </tbody>
    </table>
    {{ $categories->links() }}
  </div>
</div>
@endsection

