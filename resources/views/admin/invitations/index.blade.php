@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb', ['title' => $title])
@endsection
@section('content')
<div class="w-11/12 mx-auto">
  <div class="bg-white shadow-md rounded my-6">
   @if (!empty($invitations))
    <table> 
        <thead>
            <tr>
                <th>Email</th>
                <th>Created At</th>
                <th>Invitation Link</th>
            </tr>
        </thead>
    
        <tbody>
        @foreach ($invitations as $invitation)
            <tr>
                <td>
                    <form action="{{ route('admin.send.invite', ['id' => $invitation->id]) }}" method="post" style="display: inline"> @csrf
                        <button title="Invite user" type="submit" class="text-white font-bold py-1 px-3 rounded text-xs bg-red-300 hover:bg-red-500">{{ $invitation->email }}</button>
                    </form> 
                </td>
                <td>{{ $invitation->created_at }}</td>
                <td>
                    <kbd>{{ $invitation->getLink() }}</kbd>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>No invitation requests!</p>
    @endif
  </div>
</div>
@endsection
