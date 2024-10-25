@extends('layouts.app')
@section('title','Регистрация')
@section('content')
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl font-medium">Регистрация</h1>
            <form class="space-y-5 mt-5" action="{{route('register_process')}}" method="post">
                @csrf
                @error('name')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="name" value="{{old('name')}}" type="text" class="w-full h-12 border border-gray-800  @error('name') border-red-800 @enderror rounded px-3" placeholder="Имя" />
                @error('email')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="email" value="{{old('email')}}" type="text" class="w-full h-12 border border-gray-800  @error('email') border-red-800 @enderror rounded px-3" placeholder="Email" />
                @error('password')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="password" value="{{old('password')}}" type="password" class="w-full h-12 border border-gray-800   @error('password') border-red-800 @enderror rounded px-3" placeholder="Пароль" />
                @error('password_confirmation')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="password_confirmation" value="{{old('password_confirmation')}}" type="password" class="w-full h-12 border @error('password_confirmation') border-red-800 @enderror border-gray-800 rounded px-3" placeholder="Подтверждение пароля" />
                <div>
                    <a href="{{route('login')}}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Есть аккаунт?</a>
                </div>
                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Зарегистрироваться</button>
            </form>
        </div>
    </div>
@endsection
