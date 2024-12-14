@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Lista de etiquetas</h1>
@stop

@section('content')

    @if (session('info'))
            
    <div class="alert alert-danger">
        <strong>{{session('info')}}</strong>
    </div>

    @endif

    <div class="card">

        <div class="card-header">
            <a href="{{route('admin.tags.create')}}" class="btn btn-info">Agregar etiqueta</a>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{$tag->id}}</td>
                            <td>{{$tag->name}}</td>
                            <td ><span class="bg-{{$tag->color}} p-2 rounded-pill">{{$tag->color}}</span></td>
                            <td width="10px">
                                <a href="{{route('admin.tags.edit', $tag->id)}}" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{route('admin.tags.destroy', $tag->id)}}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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