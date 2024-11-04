@extends('layouts.app')
@section('title','Статьи')
@section('content')
    @include('partials.header')
    <div class="mt-8">
        <a href="{{route('posts.create')}}" class="text-indigo-600 hover:text-indigo-900">Добавить</a>
    </div>
    <div class="flex flex-wrap gap-10 mt-10 mb-20">
            @foreach($posts as $post)
                @include('posts.partials.item',compact('post'))
            @endforeach
        {{--<div class="flex items-center gap-4 m-auto">
            {{$posts->links()}}
        </div>--}}
    </div>
@endsection
