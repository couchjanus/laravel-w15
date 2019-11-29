@extends('layouts.blog')

@section('title')
  @parent
  {{ $title }}
@endsection

@section('content')
<h2>{{ $title }}</h2>
  @each('articles.partials._post', 
    $posts, 
    'post', 
    'articles.partials._post-none'
  )

  {{--  {{ $posts->links() }}  --}}
@endsection
