@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
   @include('layouts.partials.admin._breadcrumb', ['title' => $title, 'url'=>'admin.roles.create'])
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
      @forelse ($roles as $role)
        <tr>
          <td>{{$role->id}}</td>
          <td>{{$role->name}}</td>
          <td>
            <a href="{{route('admin.roles.edit', $role->id)}}" class="bg-green-300 hover:bg-green-500">Edit</a>
            <a href="#" class="bg-blue-300 hover:bg-blue-500">View</a>
            <form action="{{ route('admin.roles.destroy',  $role->id) }}" method="post" style="display: inline">@method('DELETE') @csrf
              <button title="Delete role" type="submit" class="text-white font-bold py-1 px-3 rounded text-xs bg-red-300 hover:bg-red-500">Delete</button>
            </form>  
            
          </td>
        </tr>
        
        @empty
            <p>No roles yet...</p>
        @endforelse
      </tbody>
    </table>
    {{ $roles->links() }}
  </div>
</div>
@endsection
