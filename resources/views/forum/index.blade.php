@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <topic-component></topic-component>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <feed-component></feed-component>
        </div>
    </div>
</div>
@endsection
