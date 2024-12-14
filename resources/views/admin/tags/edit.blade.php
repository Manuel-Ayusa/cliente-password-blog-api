@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Editar etiqueta</h1>
@stop

@section('content')

    @if (session('info'))
            
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>

    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.tags.update', $tag->id)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="name" value="{{old('name') == true ? old('name') : $tag->name }}" class="form-control" placeholder="Ingrese el nombre de la etiqueta">
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
                        <option value="purple" {{ $tag->color == 'purpple' ? 'selected' : ''}}>Purple</option>
                        <option value="pink" {{ $tag->color == 'pink' ? 'selected' : ''}}>Pink</option>
                        <option value="yellow" {{ $tag->color == 'yellow' ? 'selected' : ''}}>Yellow</option>
                        <option value="blue" {{ $tag->color == 'blue' ? 'selected' : ''}}>Blue</option>
                    </select>
                    @error('color')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>
                    
                <input type="submit" value="Editar etiqueta" class="btn btn-primary">
            </form>
        </div>
    </div>

@stop

@section('js')
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop