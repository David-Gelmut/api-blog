@extends('layouts.admin')
@section('title','Добавить тэг')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Добавить новый тэг</h3>
        <div class="mt-8"></div>
        <div class="mt-8">
            <form enctype="multipart/form-data" class="space-y-5 mt-5" action="{{route('admin.tags.store')}}" method="post">
                @csrf
                @error('title')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="title" type="text" class="w-full h-12 border border-gray-800 @error('title') border-red-800 @enderror rounded px-3" placeholder="Название" />
                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
