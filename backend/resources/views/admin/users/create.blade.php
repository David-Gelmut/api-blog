@extends('layouts.admin')
@section('title','Добавить пользовтеля')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Добавить пользовтеля</h3>
        <div class="mt-8"></div>
        <div class="mt-8">
            <form enctype="multipart/form-data"  class="space-y-5 mt-5" action="{{route('admin.users.store')}}" method="post">
                @csrf
                @error('name')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="name" value="{{old('name')}}" type="text" class="w-full h-12 border border-gray-800 @error('name') border-red-800 @enderror rounded px-3" placeholder="Имя" />
                @error('email')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="email" value="{{old('email')}}"  type="text" class="w-full h-12 border border-gray-800 @error('email') border-red-800 @enderror rounded px-3" placeholder="Email" />
                @error('password')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="password" type="password"  class="w-full h-12 border border-gray-800 @error('password') border-red-800 @enderror rounded px-3" placeholder="Пароль" />
                @error('password_confirmation')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="password_confirmation"  type="password"   class="w-full h-12 border border-gray-800 @error('password_confirmation') border-red-800 @enderror rounded px-3" placeholder="Подтверждение пароля" />
                @error('role')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                <label for="roles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Выберите Роль</label>
                <select id="roles" name="role"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Не выбрано</option>
                    @foreach(\App\Models\Enums\Roles::options() as $key=>$role)
                        <option value="{{$key}}">{{$role}}</option>
                    @endforeach
                </select>
                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
