@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb', ['title' => $title, 'url'=>'admin.users.create', 'back' => 'admin.users.index', 'trash'=>'admin.users.trashed','search'=>true])
@endsection

@section('content')
<div class="w-11/12 mx-auto">
  <div class="bg-white shadow-md rounded my-6">
    <table> 
      <thead>
        <tr>
          <th>Id</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>
    
      <tbody>
      @forelse($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->email}}</td>
            <td>
              <a href="{{route('admin.users.edit', $user->id)}}" class="bg-green-300 hover:bg-green-500">Edit</a>
              <a href="#" class="bg-blue-300 hover:bg-blue-500">View</a>
              <form action="{{ route('admin.users.destroy',  $user->id) }}" method="post" style="display: inline">@method('DELETE') @csrf
              <button title="Delete user" type="submit" class="text-white font-bold py-1 px-3 rounded text-xs bg-red-300 hover:bg-red-500">Delete</button>
            </form>  
            </td>
          </tr>
          <!-- /.blog-post -->
        @empty
            <p>No users yet...</p>
        @endforelse
      </tbody>
    </table>
    {{ $users->links() }}
  </div>
</div>
@endsection
