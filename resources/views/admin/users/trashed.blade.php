@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb', ['title' => $title, 'back' => 'admin.users.index'])
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
                <form action="{{ route('admin.users.restore',  $user->id) }}" method="post" style="display: inline">
                    @csrf
                    <button title="Restore user" type="submit" class="text-white font-bold py-1 px-3 rounded text-xs bg-orange-300 hover:bg-orange-500">Restore</button>
                </form>    
                <form action="{{ route('admin.users.force',  $user->id) }}" method="post" style="display: inline">
                    @method('DELETE') 
                    @csrf
                    <button title="Force Delete user" type="submit" class="text-white font-bold py-1 px-3 rounded text-xs bg-red-300 hover:bg-red-500">Delete</button>
                </form>  
            </td>
          </tr>
          <!-- /.blog-post -->
        @empty
            <p>No trashed users yet...</p>
        @endforelse
      </tbody>
    </table>
    {{ $users->links() }}
  </div>
</div>
@endsection
