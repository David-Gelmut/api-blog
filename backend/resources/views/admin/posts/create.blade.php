@extends('layouts.admin')
@section('title','Добавить статью')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Добавить новую</h3>
        <div class="mt-8"></div>
        <div class="mt-8">
            <form enctype="multipart/form-data" class="space-y-5 mt-5" action="{{route('admin.posts.store')}}"
                  method="post">
                @csrf
                @error('title')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="title" type="text"
                       class="w-full h-12 border border-gray-800 @error('title') border-red-800 @enderror rounded px-3"
                       placeholder="Название"/>
                @error('preview')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="preview" type="text"
                       class="w-full h-12 border border-gray-800 @error('preview') border-red-800 @enderror rounded px-3"
                       placeholder="Превью"/>
                @error('description')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="description" type="text"
                       class="w-full h-12 border border-gray-800 @error('description') border-red-800 @enderror rounded px-3"
                       placeholder="Описание"/>
                <input name="prev_image" type="file" class="w-full h-12" placeholder="Изображение"/>
                <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Выберите
                    категорию</label>
                <select id="categories" name="category_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Выберите
                    Тэги</label>
                <select id="tags" multiple name="tags[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach(\App\Models\Tag::all() as $tag)
                        <option value="{{$tag->id}}">{{$tag->title}}</option>
                    @endforeach
                </select>

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">
                    Сохранить
                </button>
            </form>
        </div>
    </div>
@endsection
