<x-app-layout>

    <div class="max-w-5xl mx-auto px-2 sm:px-6 lg:px-8 py-8">
            <h1 class="uppercase text-3xl font-bold text-gray-600 text-center mb-4">
                Categoria: {{$category->name}}
            </h1>

            @foreach ($posts as $post)
                <article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">

                    <img class="w-full h-72 object-cover object-center" src="http://api.codersfree.test/storage/{{$post->image->url}}" alt="">
                    
                    <div class="px-6 py-4">
                        <h2 class="font-bold text-xl mb-2">
                            <a href="{{route('posts.show', $post->id)}}">{{$post->name}}</a>
                        </h2>
                        <div class="text-gray-700 text-base">
                            {{$post->stract}}
                        </div>

                        <div class="pt-4 pb-2">
                            @foreach ($post->tags as $tag)
                                <a href="#" class="inline-block bg-{{$tag->color}}-600 rounded-full px-3 py-1 text-sm text-white mr-2">{{$tag->name}}</a>
                            @endforeach
                        </div>

                    </div>

                </article>
            @endforeach

            <div class="mt-4">
                {{$posts->links()}}
            </div>
            
        </div>

</x-app-layout>