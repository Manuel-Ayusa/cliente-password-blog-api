@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Lista de usuarios</h1>
@stop

@section('content')
    @livewire('admin.users-index')
@stop

@section('js')
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop