<template>
  <div class="flex-1 flex flex-col overflow-hidden">
    <nav
        class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full">
      <router-link :to="{name:'home'}">
        <div v-if="status" class="mb-2 sm:mb-0 inner">
          <a href="javascript:;"
             class="text-2xl no-underline text-grey-darkest hover:text-blue-dark font-sans font-bold">Главная</a><br>
        </div>
      </router-link>
      <router-link  :to="{name:'create'}">
        <a v-if="status" href="javascript:;">Добавить статью</a>
      </router-link>
      <router-link  :to="{name:'personal'}">
        <a v-if="status" href="javascript:;">Мои посты</a>
      </router-link>
      <div class="sm:mb-0 self-center">
        <a v-if="status" @click.prevent="logout" href="javascript:;"
           class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Выйти</a>
        <router-link :to="{name:'login'}">
          <a v-if="!status" href="javascript:;"
             class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Войти</a>
        </router-link>
        <router-link :to="{name:'register'}">
          <a v-if="!status" href="javascript:;"
             class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Регистрация</a>
        </router-link>
      </div>
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
  mounted() {
    console.log(this.status);
  },
  methods: {
    logout() {

      axios.get('http://localhost:8080/api/logout', {
     //   withCredentials: true,
        headers: {
          'Authorization':'Bearer '+localStorage.getItem('my_token')
         // 'X-XSRF-TOKEN': this.cookies.get("XSRF-TOKEN")
        }
      }).then(data => {
        console.log(data);

        localStorage.removeItem('status');
        this.$router.push({name: 'login'});
        //location.reload()
      })
    },
  },
}
</script>
