@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Crear nueva etiqueta</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.tags.store')}}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="name" value="{{old('name')}}" class="form-control" placeholder="Ingrese el nombre de la etiqueta">
                    @error('name')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                    @error('slug')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="color">Color</label>
                    <select name="color" id="color" class="form-control">
                        <option value="purple">Purple</option>
                        <option value="pink">Pink</option>
                        <option value="yellow">Yellow</option>
                        <option value="blue">Blue</option>
                    </select>
                    @error('color')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>
                    
                <input type="submit" value="Crear etiqueta" class="btn btn-primary">
            </form>
        </div>
    </div>

@stop

@section('js')
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop