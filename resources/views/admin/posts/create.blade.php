@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Crear post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.posts.store')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="name" value="{{old('name')}}" class="form-control" placeholder="Ingrese el nombre del post">
                    @error('name')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                    @error('slug')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cat">Categoria</label>
                    <select name="category_id" id="cat" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="et">Etiquetas</label>

                    <fieldset>
                        @foreach ($tags as $tag)
                            <input type="checkbox" name="tags" id="{{$tag->name}}" value="{{$tag->name}}">
                            <label class="mr-3" for="{{$tag->name}}">{{$tag->name}}</label>
                        @endforeach
                       
                    </fieldset>
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>

                    <fieldset>
                        <input type="radio" name="status" id="borrador" value="1" checked>
                        <label class="mr-3"  for="borrador">Borrador</label>
                        <input type="radio" name="status" id="publi" value="2">
                        <label for="publi" >Publicado</label>
                    </fieldset>
                </div>

                <div class="form-group">
                    <label for="stract">Extracto</label>
                    <textarea class="form-control" name="stract" id="stract" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group editor-container editor-container_classic-editor" id="editor-container">
                    <label for="body">Cuerpo del post</label>
                    <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                </div>

                <input type="submit" value="Crear post" class="btn btn-primary">

            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" />
@stop

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js" crossorigin></script>
	<script src="https://cdn.ckbox.io/ckbox/2.6.1/ckbox.js" crossorigin></script>
    <script src="https://kit.fontawesome.com/271243e33d.js" crossorigin="anonymous"></script>

    <script>
        const {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } = CKEDITOR;

        ClassicEditor
            .create( document.querySelector( '#stract' ), {
                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NjYzNjE1OTksImp0aSI6ImJhZTg2MjUxLTRhZTctNGI5Zi04MDliLWI0M2MxM2UwMGI5NyIsImxpY2Vuc2VkSG9zdHMiOlsiMTI3LjAuMC4xIiwibG9jYWxob3N0IiwiMTkyLjE2OC4qLioiLCIxMC4qLiouKiIsIjE3Mi4qLiouKiIsIioudGVzdCIsIioubG9jYWxob3N0IiwiKi5sb2NhbCJdLCJ1c2FnZUVuZHBvaW50IjoiaHR0cHM6Ly9wcm94eS1ldmVudC5ja2VkaXRvci5jb20iLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIl0sImxpY2Vuc2VUeXBlIjoiZGV2ZWxvcG1lbnQiLCJmZWF0dXJlcyI6WyJEUlVQIl0sInZjIjoiZTNhNTE1MmIifQ.jW5jr4ttGnTDtrnoL5It7xW4m6lPaHtJVRKsdZgLwL0Xowb1fE5QENISoF-e7RgzjzBtUFUJSvjEI7a_KHWCwQ',
                plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ],
            } )
            .then( /* ... */ )
            .catch( /* ... */ );

            ClassicEditor
            .create( document.querySelector( '#body' ), {
                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NjYzNjE1OTksImp0aSI6ImJhZTg2MjUxLTRhZTctNGI5Zi04MDliLWI0M2MxM2UwMGI5NyIsImxpY2Vuc2VkSG9zdHMiOlsiMTI3LjAuMC4xIiwibG9jYWxob3N0IiwiMTkyLjE2OC4qLioiLCIxMC4qLiouKiIsIjE3Mi4qLiouKiIsIioudGVzdCIsIioubG9jYWxob3N0IiwiKi5sb2NhbCJdLCJ1c2FnZUVuZHBvaW50IjoiaHR0cHM6Ly9wcm94eS1ldmVudC5ja2VkaXRvci5jb20iLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIl0sImxpY2Vuc2VUeXBlIjoiZGV2ZWxvcG1lbnQiLCJmZWF0dXJlcyI6WyJEUlVQIl0sInZjIjoiZTNhNTE1MmIifQ.jW5jr4ttGnTDtrnoL5It7xW4m6lPaHtJVRKsdZgLwL0Xowb1fE5QENISoF-e7RgzjzBtUFUJSvjEI7a_KHWCwQ',
                plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ],
            } )
            .then( /* ... */ )
            .catch( /* ... */ );

    </script>
@stop