@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Editar categoria</h1>
@stop

@section('content')

    @if (session('info'))
        
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
        
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.categories.update', $category->id)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="name" value="{{$category->name}}" class="form-control" placeholder="Ingrese el nombre de la categoria">
                    @error('name')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                    @error('slug')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>

                <input type="submit" value="Actualizar categoria" class="btn btn-primary">
            </form>
        </div>
    </div>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop