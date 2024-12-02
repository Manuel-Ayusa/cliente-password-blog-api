@props(['post'])

<article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">

    <img class="w-full h-72 object-cover object-center" src="http://api.codersfree.test/storage/{{$post->images->url}}" alt="">
    
    <div class="px-6 py-4">
        <h2 class="font-bold text-xl mb-2">
            <a href="{{route('posts.show', $post->id)}}">{{$post->name}}</a>
        </h2>
        <div class="text-gray-700 text-base">
            {{$post->stract}}
        </div>

        <div class="pt-4 pb-2">
            @foreach ($post->tags as $tag)
                <a href="{{route('posts.tag', $tag->id)}}" class="inline-block bg-{{$tag->color}}-600 rounded-full px-3 py-1 text-sm text-white mr-2">{{$tag->name}}</a>
            @endforeach
        </div>

    </div>

</article>