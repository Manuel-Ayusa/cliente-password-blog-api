@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Panel de control</h1>
@stop

@section('content')

<div class="container">
    <div class="row">
        @can('admin.posts.index')
            <div class="col">

                <div class="small-box bg-info">
                    <div class="inner">
                    <h3>{{$posts}}</h3>
                    <p>Posts</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-clipboard"></i>
                    </div>
                    <a href="{{route('admin.posts.index')}}" class="small-box-footer">
                    Mas información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>

            </div>
        @endcan

        @can('admin.categories.index')
            <div class="col">

                <div class="small-box bg-gradient-success">
                    <div class="inner">
                        <h3>{{$categories}}</h3>
                        <p>Categorias</p>
                    </div>
                    <div class="icon">
                        <i class="fa-brands fa-buffer"></i>
                    </div>
                        <a href="{{route('admin.categories.index')}}" class="small-box-footer">
                        Mas información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>

            </div>
        @endcan
    </div>
    <div class="row">
        @can('admin.tags.index')
            <div class="col">

                <div class="small-box bg-gradient-primary">
                    <div class="inner">
                        <h3>{{$tags}}</h3>
                        <p>Etiquetas</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-tag"></i>
                    </div>
                        <a href="{{route('admin.tags.index')}}" class="small-box-footer">
                        Mas información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>

            </div>
        @endcan

        @can('admin.roles.index')
            <div class="col">

                <div class="small-box bg-gradient-warning">
                    <div class="inner">
                        <h3>{{$roles}}</h3>
                        <p>Roles</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-users-cog"></i>
                    </div>
                        <a href="{{route('admin.roles.index')}}" class="small-box-footer">
                        Mas información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>

            </div>
        @endcan
    </div>

    {{-- @foreach ($posts as $post)
        <article class="w-full h-80 bg-cover bg-center @if($loop->first) md:col-span-2 @endif" style="background-image: url(@if($post->image) http://api.codersfree.test/storage/{{$post->image->url}} @else https://www.esdesignbarcelona.com/sites/default/files/inline-images/Depositphotos_333877668_S.jpg @endif)">

            <div class="w-full h-full py-8 flex flex-col justify-center">

                <div>
                    @foreach ($post->tags as $tag)
                        <a href="{{route('posts.tag', $tag->id)}}" class="inline-block px-3 h-6 bg-{{$tag->color}}-600 rounded-full text-white">{{$tag->name}}</a>
                    @endforeach
                </div>

                <h2 class="text-4xl text-white leading-8 font-bold mt-2 text-shadow" style="text-shadow: 2px 2px 2px black;">
                    <a href="{{route('posts.show', $post->id)}}">
                        {{$post->name}}
                    </a>
                </h2>

            </div>
        </article>
    @endforeach --}}

    

</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop