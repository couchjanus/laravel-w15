@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb', ['title' => $title, 'url'=>'admin.permissions.create'])
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
      @forelse ($permissions as $permission)
        <tr>
          <td>{{$permission->id}}</td>
          <td>{{$permission->name}}</td>
          <td>
            <a href="{{route('admin.permissions.edit', $permission->id)}}" class="bg-green-300 hover:bg-green-500">Edit</a>
            <a href="#" class="bg-blue-300 hover:bg-blue-500">View</a>
            <form action="{{ route('admin.permissions.destroy',  $permission->id) }}" method="post" style="display: inline">@method('DELETE') @csrf
              <button title="Delete permission" type="submit" class="text-white font-bold py-1 px-3 rounded text-xs bg-red-300 hover:bg-red-500">Delete</button>
            </form>  
            
          </td>
        </tr>
        
        @empty
            <p>No permissions yet...</p>
        @endforelse
      </tbody>
    </table>
    {{ $permissions->links() }}
  </div>
</div>
@endsection
