@extends('admin.layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <h1>Visualizza Post</h1>

          <div><strong>Titolo:</strong> {{$post->title}}</div>
          <div><strong>Contenuto:</strong> {!! $post->content !!}</div>
          <div><strong>Slug:</strong> {{$post->slug}}</div>
          <div><strong>Categoria:</strong> {{$post->category->name}}</div>

          <a href="{{route('admin.posts.index')}}" class="btn btn-primary mt-4">Torna all'elenco dei post</a>

        </div>
    </div>
</div>
@endsection