@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Lista de categorias</h1>
@stop

@section('content')

    @if (session('info'))
        
        <div class="alert alert-danger">
            <strong>{{session('info')}}</strong>
        </div>
        
    @endif

    <div class="card">

        @can('admin.categories.create')
            <div class="card-header">
                <a href="{{route('admin.categories.create')}}" class="btn btn-info">Agregar categoria</a>
            </div>    
        @endcan
        
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td width="10px">
                                @can('admin.categories.edit')
                                    <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-primary btn-sm">Editar</a>
                                @endcan
                            </td>                                                     
                            <td width="10px">
                                @can('admin.categories.destroy')
                                    <form action="{{route('admin.categories.destroy', $category->id)}}" method="POST">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                @endcan
                            </td>                  
                        </tr>    
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>
@stop