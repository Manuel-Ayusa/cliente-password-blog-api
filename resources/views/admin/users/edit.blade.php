@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Asignar un rol</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre</p>
            <p class="form-control">{{$user->name}}</p>

            <h2 class="h5">Listado de roles</h2>
            <form action="{{route('admin.users.update', $user)}}" method="POST">
                @csrf
                @method('PUT')

                <fieldset>
                    @foreach ($roles as $role)
                    <div>
                        <input type="checkbox" name="roles[]" id="{{$role->name}}" value="{{$role->id}}" 
                        @if($rolesUser->count())
                            @foreach ($rolesUser as $roleUser)
                                @if ($roleUser->name == $role->name)
                                    checked
                                @endif
                            @endforeach                            
                        @endif>
                        <label class="ml-2" for="{{$role->name}}">{{$role->name}}</label>
                    </div>
                    @endforeach
                </fieldset>

                <input type="submit" value="Asignar rol" class="btn btn-primary mt-2">
            </form>
        </div>
    </div>
@stop

@section('js')
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop