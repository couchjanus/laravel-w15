@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb', ['title' => $title, 'back'=>'admin.pictures.index'])
@endsection
@section('content')
<div class="w-11/12 mx-auto">
  <div class="bg-white shadow-md rounded my-6">
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <div class="card">
                <div class="card-header">Add files</div>

                <div class="card-body">
                    <upload-files :input_name="'pictures[]'" :post_url="'admin/pictures/upload-file'"></upload-files>
                </div>
            </div>
        </div>
    </div>
    
  </div>
</div>   
@endsection
