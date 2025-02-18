<div class="flex px-4 py-8 max-w-xl">
    <div class="bg-white shadow-2xl">
        <a href="{{route('posts.show',$post->id)}}">
            <img class="w-64" src="{{'/storage/'.$post->prev_image}}">
        </a>
        <div class="px-4 py-2 mt-2 bg-white">
            <h2 class="font-bold text-2xl text-gray-800">{{$post->title}}</h2>
            <p class="sm:text-sm text-xs text-gray-700 px-2 mr-1 my-3">
                {!!$post->preview!!}
            </p>
        </div>
    </div>
</div>
