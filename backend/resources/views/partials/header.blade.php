<nav
    class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full">
    <div class="mb-2 sm:mb-0 inner">
        <a href="{{route('home')}}"
           class="text-2xl no-underline text-grey-darkest hover:text-blue-dark font-sans font-bold">Главная</a><br>
        <span class="text-xs text-grey-dark">Описание</span>
    </div>
    <a href="{{route('posts.index')}}">Посты</a>
    <a href="{{route('contacts')}}"> Контакты </a>
    <div class="sm:mb-0 self-center">
        @auth('web')
            <a href="{{route('logout')}}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Выйти</a>
        @endauth
        @guest('web')
            <a href="{{route('login')}}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Войти1</a>
        @endguest
    </div>
</nav>
