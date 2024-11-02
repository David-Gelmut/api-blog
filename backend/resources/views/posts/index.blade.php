@extends('layouts.app')
@section('title','Статьи')
@section('content')
    @include('partials.header')
    <div class="flex flex-wrap gap-10 mt-10 mb-20">
            @foreach($posts as $post)
                @include('posts.partials.item',compact('post'))
            @endforeach
        {{--<div class="flex items-center gap-4 m-auto">
            {{$posts->links()}}
        </div>--}}
    </div>
@endsection
