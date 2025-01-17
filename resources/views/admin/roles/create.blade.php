@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Crear nuevo rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{route('admin.roles.store')}}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="name" value="{{old('name')}}" class="form-control" placeholder="Ingrese el nombre del rol">
                    @error('name')
                        <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>

                <h2 class="h3">Lista de Permisos</h2>
                    
                <div class="form-group">
                    <fieldset>
                        @foreach ($permissions as $permission)
                        <div>
                            <input type="checkbox" name="permissions[]" id="{{$permission->name}}" value="{{$permission->id}}" 
                                    @if (old('tags')) @if(in_array($permission->id, old('tags'))) checked @endif
                                    @endif>
                            <label class="ml-1" for="{{$permission->name}}">{{$permission->description}}</label>
                        </div>
                        @endforeach
                    </fieldset>
                </div>

                <input type="submit" value="Crear rol" class="btn btn-primary">
            </form>

        </div>
    </div>
@stop

@section('js')
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop