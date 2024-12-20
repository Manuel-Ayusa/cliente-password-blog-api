@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Listado de Posts</h1>
@stop

@section('content')
    @livewire('admin.posts-index')
@stop

@section('js')
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop