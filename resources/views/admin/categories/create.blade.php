@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Crear nueva categoria</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.categories.store')}}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="name" value="{{old('name')}}" class="form-control" placeholder="Ingrese el nombre de la categoria">
                    @error('name')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                    @error('slug')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>

                <input type="submit" value="Crear categoria" class="btn btn-primary">
            </form>
        </div>
    </div>

@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop