@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Editar post</h1>
@stop

@section('content')

    @if (session('info'))
            
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>

    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="name" value="@if(old('name')) {{old('name')}} @else {{$post->name}} @endif" class="form-control" placeholder="Ingrese el nombre del post">
                
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
                            <option value="{{$category->id}}"
                                    @if ($post->category_id == $category->id) selected @endif
                                    @if(old('category_id') == $category->id) selected @endif>
                                    {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                
                    @error('category_id')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="et">Etiquetas</label>
                
                    <fieldset>
                        @foreach ($tags as $tag)
                            <input type="checkbox" name="tags[]" id="{{$tag->name}}" value="{{$tag->id}}"
                            @if (old('tags')) 
                                @if(in_array($tag->id, old('tags'))) checked @endif
                            @else
                                @foreach ($post->tags as $postTag)
                                @if ($postTag == $tag)
                                    checked
                                @endif
                            @endforeach
                            @endif 
                            
                            >
                            <label class="mr-3" for="{{$tag->name}}">{{$tag->name}}</label>
                        @endforeach
                    </fieldset>
                
                    @error('tags')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="estado">Estado</label>
                
                    <fieldset>
                        <input type="radio" name="status" id="borrador" value="1" 
                        @if($post->status == 'BORRADOR') checked @endif>
                        <label class="mr-3"  for="borrador">Borrador</label>
                        <input type="radio" name="status" id="publi" value="2"
                        @if($post->status == 'PUBLICADO') checked @endif>
                        <label for="publi" >Publicado</label>
                    </fieldset>
                
                    @error('status')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="stract">Extracto</label>
                    <textarea class="form-control" name="stract" id="stract" cols="30" rows="10">@if(!old('stract')) {!!$post->stract!!} @else {!!old('stract')!!} @endif</textarea>
                
                    @error('stract')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group editor-container editor-container_classic-editor" id="editor-container">
                    <label for="body">Cuerpo del post</label>
                    <textarea class="form-control" name="body" id="body" cols="30" rows="10">@if(!old('body')) {!!$post->body!!} @else {!!old('body')!!} @endif</textarea>
                
                    @error('body')
                    <span class="text-danger">{{'*' . $message }}</span>
                    @enderror
                </div>
                
                <div class="row mb-3">
                    <div class="col">
                        <div class="image-wrapper">
                        @if($post->image)
                            <img id="picture" src="http://api.codersfree.test/storage/{{$post->image->url}}" alt="{{$post->name}}">
                        @else 
                            <img id="picture" src="https://www.esdesignbarcelona.com/sites/default/files/inline-images/Depositphotos_333877668_S.jpg" alt="imagen por defecto">
                        @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="img">Imagen de post</label>
                            <input type="file" name="image" id="img" class="form-control" accept="image/*">
                
                            @error('image')
                            <span class="text-danger">{{'*' . $message }}</span>
                            @enderror
                        </div>
                
                        <p class="text-secondary">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis explicabo rem doloribus repudiandae ut autem corrupti, nihil maiores? Assumenda sunt atque earum quas labore maiores sed expedita quasi inventore voluptatem!</p>
                    </div>
                </div>   

                <input type="submit" value="Actualizar post" class="btn btn-primary">

            </form>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" />
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
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

             
        document.getElementById("img").addEventListener('change', cambiarImagen);

        function cambiarImagen(event){
        var file = event.target.files[0];

        var reader = new FileReader();
        reader.onload = (event) => {
            document.getElementById("picture").setAttribute('src', event.target.result);
        };

        reader.readAsDataURL(file);
        }
    </script>
@stop