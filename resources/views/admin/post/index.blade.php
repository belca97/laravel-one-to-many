@extends('admin.layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <a href="{{route('admin.posts.create')}}" class="btn btn-primary mb-4">Crea un post</a>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Contenuto</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Azioni</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as  $post)
                    
                            <tr>

                                <td>{{$posts->id}}</td>
                                <td>{{$posts->title}}</td>
                                <td>{{substr($post->content, 0, 30)}}</td>
                                <td>{{$posts->slug}}</td>
                            </tr>
                    @endforeach
                  
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection