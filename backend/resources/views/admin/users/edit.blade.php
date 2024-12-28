@extends('layouts.admin')
@section('title','Редактировать  пользователя')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Редактировать пользователя с ID {{$user->id}}</h3>
        <div class="mt-8"></div>
        <div class="mt-8">
            <form enctype="multipart/form-data"  class="space-y-5 mt-5" action="{{route('admin.users.update',$user)}}" method="post">
                @csrf
                @method('PUT')
                @error('name')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="name" value="{{$user->name}}" type="text" class="w-full h-12 border border-gray-800 @error('name') border-red-800 @enderror rounded px-3" placeholder="Имя" />
                @error('email')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="email" value="{{$user->email}}"  type="text" class="w-full h-12 border border-gray-800 @error('email') border-red-800 @enderror rounded px-3" placeholder="Email" />
                @error('password')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="password" value="{{$user->password}}" type="password"  class="w-full h-12 border border-gray-800 @error('password') border-red-800 @enderror rounded px-3" placeholder="Пароль" />
                @error('password_confirmation')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <input name="password_confirmation" value="{{$user->password}}"  type="password"  type="text" class="w-full h-12 border border-gray-800 @error('password_confirmation') border-red-800 @enderror rounded px-3" pplaceholder="Подтверждение пароля" />
                @error('role')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <label for="roles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Выберите Роль</label>
                <select id="roles" name="role"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Не выбрано {{$user->role}}</option>
                    @foreach(\App\Models\Enums\Roles::options() as $key=>$role)
                        <option {{$user->role == $key?'selected':''}} value="{{$key}}">{{$role}}</option>
                    @endforeach
                </select>
                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Статьи пользователя</h3>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Заголовок</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Превью</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Превью изображение</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Автор</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Дата создания</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Дата обновления</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($user->posts as $post)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$post->id}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$post->title}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$post->preview}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <img class="h-20 w-20" src="{{'/storage/'.$post->prev_image}}">
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$post->user->name}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$post->created_at}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$post->updated_at}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    <a href="{{route('admin.posts.edit',$post)}}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                                    <form  action="{{route('admin.posts.destroy',$post)}}" method="post">
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
        </div>
    </div>
@endsection
