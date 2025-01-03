@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.posts.create')}}">Nuevo post</a>

    <h1>Listado de Posts</h1>
@stop

@section('content')

    @if (session('ok'))
                    
    <div class="alert alert-success">
        <strong>{{session('ok')}}</strong>
    </div>

    @endif

    @if (session('info'))
                
        <div class="alert alert-danger">
            <strong>{{session('info')}}</strong>
        </div>

    @endif



    @livewire('admin.posts-index')
@stop

@section('js')
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop