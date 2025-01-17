@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Lista de roles</h1>
@stop

@section('content')
    <div class="card">
        
        <div class="card-header">
            <a href="{{route('admin.roles.create')}}" class="btn btn-info">Agregar rol</a>
        </div>    

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rol</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td width="10px">
                                <a href="{{route('admin.roles.edit', $role)}}" class="btn btn-sm btn-primary">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{route('admin.roles.destroy', $role)}}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <input type="submit" value="Eliminar" class="btn btn-sm btn-danger">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop