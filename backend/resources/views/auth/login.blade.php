@extends('layouts.app')
@section('title','Войти')
@section('content')
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl font-medium">Вход</h1>
            <form class="space-y-5 mt-5" action="{{route('login_process')}}" method="post">
                @csrf
                @error('email')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input value="{{old('email')}}" name="email" type="text"
                       class="w-full h-12 border border-gray-500 @error('email') border-red-800 @enderror rounded px-3" placeholder="Email"/>
                @error('password')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input value="{{old('password')}}" name="password" type="password"
                       class=" w-full h-12 border border-gray-800 @error('password') border-red-800 @enderror rounded px-3" placeholder="Пароль"/>
                <div>
                    <a href="{{route('forgot')}}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Забыли пароль?</a>
                </div>
                <div>
                    <a href="{{route('register')}}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Регистрация</a>
                </div>
                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">
                    Войти
                </button>
            </form>
        </div>
    </div>
@endsection
