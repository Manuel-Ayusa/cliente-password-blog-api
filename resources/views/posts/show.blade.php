<x-app-layout>

    <x-container class="py-8">
        <h1 class="text-4xl font-bold text-gray-600">
            {{$post->name}}
        </h1>
 
        <div class="text-lg text-gray-500 mb-2">
            {!! $post->stract !!}
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Contenido principal --}}
            <div class="lg:col-span-2">

                <figure>
                    @if($post->image)
                        <img class="w-full h-80 object-cover object-center" src="http://api.codersfree.test/storage/{{$post->image->url}}" alt="{{$post->name}}">
                    @else 
                        <img class="w-full h-80 object-cover object-center" src="https://www.esdesignbarcelona.com/sites/default/files/inline-images/Depositphotos_333877668_S.jpg" alt="{{$post->name}}">
                    @endif
                </figure>

                <div class="text-base text-gray-500 mt-4">
                    {!! $post->body !!}
                </div>

            </div>

            {{-- Contenido relacionado --}}
            <aside>
                <h1 class="text-2xl font-bold text-gray-600 mb-4">
                    Más en {{$post->category->name}}
                </h1>

                <ul>
                    @foreach ($similares as $similar)
                        @if($similar->id != $post->id)
                            <li class="mb-4">
                                <a class="flex" href="{{route('posts.show', $similar->id)}}">
                                    @if($similar->image)
                                        <img class="w-36 h-20 object-cover object-center" src="http://api.codersfree.test/storage/{{$similar->image->url}}" alt="{{$similar->name}}">
                                    @else
                                        <img class="w-36 h-20 object-cover object-center" src="https://www.esdesignbarcelona.com/sites/default/files/inline-images/Depositphotos_333877668_S.jpg" alt="{{$similar->name}}">
                                        
                                    @endif
                                    <span class="ml-2 text-gray-600 ">
                                        {{$similar->name}}
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </aside>

        </div>
    </x-container>

</x-app-layout>