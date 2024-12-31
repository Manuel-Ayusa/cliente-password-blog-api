<x-app-layout>

    <x-container class="py-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($posts as $post)
                <article class="w-full h-80 bg-cover bg-center @if($loop->first) md:col-span-2 @endif" style="background-image: url(http://api.codersfree.test/storage/{{$post->image->url}})">

                    <div class="w-full h-full py-8 flex flex-col justify-center">

                        <div>
                            @foreach ($post->tags as $tag)
                                <a href="{{route('posts.tag', $tag->id)}}" class="inline-block px-3 h-6 bg-{{$tag->color}}-600 rounded-full">{{$tag->name}}</a>
                            @endforeach
                        </div>

                        <h2 class="text-4xl text-white leading-8 font-bold mt-2">
                            <a href="{{route('posts.show', $post->id)}}">
                                {{$post->name}}
                            </a>
                        </h2>

                    </div>
                </article>
            @endforeach

        </div>

        <div class="mt-4">
            {{$posts->links()}}
        </div>

    </x-container>

</x-app-layout>