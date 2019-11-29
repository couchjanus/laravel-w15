@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb', ['title' => $title, 'url'=>'admin.pictures.create'])
@endsection
@section('content')
<div class="w-11/12 mx-auto">
  <div class="bg-white shadow-md rounded my-6">

    @if($files->count())
        <table class="table">
          <thead>
            <th>Name</th>
            <th>Size</th>
          </thead>
          <tbody>
          @foreach($files as $file)
            <tr>
                <td>{{ $file->filename }}</td>
                <td>{{ $file->size }} Bytes</td>
            </tr>
          @endforeach
          </tbody>
        </table>
    @else
        You have no files yet!
    @endif
      
    {{ $files->links() }}
  </div>
</div>
@endsection
