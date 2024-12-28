@extends('layouts.admin')
@section('title','Редактировать статью')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Редактировать статью с ID {{$post->id}}</h3>
        <div class="mt-8"></div>
        <div class="mt-8">
            <form enctype="multipart/form-data"  class="space-y-5 mt-5" action="{{route('admin.posts.update',$post)}}" method="post">
                @csrf
                @method('PUT')
                @error('title')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="title" value="{{$post->title}}" type="text" class="w-full h-12 border border-gray-800 @error('title') border-red-800 @enderror rounded px-3" placeholder="Название" />

                @error('preview')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="preview" value="{{$post->preview}}"  type="text" class="w-full h-12 border border-gray-800 @error('preview') border-red-800 @enderror rounded px-3" placeholder="Превью" />

                @error('description')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="description" value="{{$post->description}}"  type="text" class="w-full h-12 border border-gray-800 @error('description') border-red-800 @enderror rounded px-3" placeholder="Описание" />
                <div>
                    @if($post->prev_image)
                    <img class="h-64 w-64" src="{{'/storage/'.$post->prev_image}}">
                    @endif
                </div>
                <input name="prev_image" type="file" class="w-full h-12" placeholder="Изображение" />
                <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Выберите
                    категорию</label>
                <select id="categories" name="category_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach(\App\Models\Category::all() as $category)
                        <option {{$category->id==$post->category_id?'selected':''}} value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Выберите
                    Тэги</label>
                <select id="tags" multiple name="tags[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach(App\Models\Tag::all() as $tag)
                        <option {{in_array($tag->id,$post->tags->pluck('id')->toArray())?'selected':''}}  value="{{$tag->id}}">{{$tag->title}}</option>
                    @endforeach
                </select>
                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Комментарии статьи</h3>
        <div class="flex flex-col mt-8">
            @if(count($post->comments)>0)
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Текст комментария
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Автор
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Дата создания
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Дата обновления
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @foreach($post->comments as $comment)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{$comment->id}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{$comment->text}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{$comment->user->name}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{$comment->created_at}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{$comment->updated_at}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <a href="{{route('admin.comments.edit',$comment)}}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                        <form  action="{{route('admin.comments.delete',$comment)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
