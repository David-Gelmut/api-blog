@extends('layouts.admin')
@section('title','Добавить статью')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Добавить новую</h3>
        <div class="mt-8"></div>
        <div class="mt-8">
            <form enctype="multipart/form-data" class="space-y-5 mt-5" action="{{route('admin.posts.store')}}" method="post">
                @csrf

                @error('title')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="title" type="text" class="w-full h-12 border border-gray-800 @error('title') border-red-800 @enderror rounded px-3" placeholder="Название" />

                @error('preview')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="preview"  type="text" class="w-full h-12 border border-gray-800 @error('preview') border-red-800 @enderror rounded px-3" placeholder="Превью" />

                @error('description')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="description"  type="text" class="w-full h-12 border border-gray-800 @error('description') border-red-800 @enderror rounded px-3" placeholder="Описание" />

                <input name="prev_image" type="file" class="w-full h-12" placeholder="Изображение" />

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
