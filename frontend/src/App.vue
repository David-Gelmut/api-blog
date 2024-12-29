<template>
  <div class="flex-1 flex flex-col overflow-hidden m-auto p-6">
    <nav class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full">
      <router-link :to="{name:'home'}">
        <div  class="mb-2 sm:mb-0 inner">
          <a href="javascript:;"
             class="text-2xl no-underline text-grey-darkest  hover:text-white hover:bg-blue-400 p-2 hover:rounded-lg font-sans font-bold">Главная</a><br>
        </div>
      </router-link>
      <router-link  :to="{name:'contact'}">
        <a v-if="status" href="javascript:;"
           class="text-md no-underline text-grey-darker hover:text-white hover:bg-blue-400 p-2 hover:rounded-lg ml-2 px-1">Контакты</a>
      </router-link>
      <router-link :to="{name:'personal'}">
        <a v-if="status" href="javascript:;"
           class="text-md no-underline text-grey-darker hover:text-white hover:bg-blue-400 p-2 hover:rounded-lg ml-2 px-1">Моя страница</a>
      </router-link>
      <router-link :to="{name:'create'}">
        <a v-if="status" href="javascript:;"
           class="text-md no-underline text-grey-darker  hover:text-white hover:bg-blue-400 p-2 hover:rounded-lg ml-2 px-1">Добавить статью</a>
      </router-link>
      <router-link :to="{name:'login'}">
        <a v-if="!status" href="javascript:;"
           class="text-md no-underline text-grey-darker  hover:text-white hover:bg-blue-400 p-2 hover:rounded-lg ml-2 px-1">Войти</a>
      </router-link>
      <a v-if="status" href="http://localhost:8080/admin/posts"
         class="text-md no-underline text-grey-darker  hover:text-white hover:bg-blue-400 p-2 hover:rounded-lg ml-2 px-1">Войти в админ панель</a>
      <router-link :to="{name:'register'}">
        <a v-if="!status" href="javascript:;"
           class="text-md no-underline text-grey-darker  hover:text-white hover:bg-blue-400 p-2 hover:rounded-lg ml-2 px-1">Регистрация</a>
        </router-link>
      <a v-if="status" @click.prevent="logout" href="javascript:;"
         class="text-md no-underline text-grey-darker  hover:text-blue-50 hover:bg-blue-400 p-2 hover:rounded-lg ml-2 px-1">Выйти</a>
    </nav>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <router-view></router-view>
    </main>
  </div>
</template>
<script>
import axios from "axios";
import {useCookies} from "vue3-cookies";

export default {
  name: "App",
  setup() {
    const {cookies} = useCookies();
    return {cookies};
  },
  data() {
    return {
      status: localStorage.getItem("status")
    }
  },
  methods: {
    logout() {
      axios.get('http://localhost:8080/api/logout', {
        withCredentials: true,
        headers: {
          'X-XSRF-TOKEN': this.cookies.get("XSRF-TOKEN")
        }
      }).then(data => {
       // console.log(data);
         this.cookies.remove("XSRF-TOKEN");
         localStorage.removeItem('status');
        // localStorage.removeItem('my_token');
        // localStorage.removeItem('user_id');
         this.$router.push({name: 'home'});
         location.reload()
      }).catch(err => {
        console.log(err);

      })
    },
  },
}
</script>
