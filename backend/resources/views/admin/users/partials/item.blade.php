<div class="flex px-4 py-8 max-w-xl">
    <div class="bg-white shadow-2xl">
        <a href="{{route('admin.users.show',$user->id)}}">
           Show
        </a>
        <div class="px-4 py-2 mt-2 bg-white">
            <h2 class="font-bold text-2xl text-gray-800">{{$user->name}}</h2>
            <p class="sm:text-sm text-xs text-gray-700 px-2 mr-1 my-3">
                test
            </p>
        </div>
    </div>
</div>
