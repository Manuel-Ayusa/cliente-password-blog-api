@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Editar rol</h1>
@stop

@section('content')

    @if (session('info'))
                    
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>

    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.roles.update', $role)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="name" value="{{$role->name}}" class="form-control">
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
                            @if($permissionsUser->count())
                            @foreach ($permissionsUser as $permissionUser)
                                @if ($permissionUser->name == $permission->name)
                                    checked
                                @endif
                            @endforeach                            
                            @endif>
                            <label class="ml-1" for="{{$permission->name}}">{{$permission->description}}</label>
                        </div>
                        @endforeach
                    </fieldset>
                </div>

                <input type="submit" value="Editar rol" class="btn btn-primary">
            </form>
        </div>
    </div>
@stop

@section('js')
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop