<template>
  <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
    <div class="bg-white w-96 shadow-xl rounded p-5">
      <h1 class="text-3xl font-medium">Регистрация</h1>
      <form class="space-y-5 mt-5">
        <input v-model="name" type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Имя" />
        <input v-model="email" type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Email" />
        <input v-model="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Пароль" />
        <input @click.prevent="register"  type="password" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Подтверждение пароля" />
        <div>
          <router-link :to="{name:'login'}">
            <a href="#" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Есть аккаунт?</a>
          </router-link>
        </div>
        <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Зарегистрироваться</button>
      </form>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import {useCookies} from "vue3-cookies";

export default {
  name: "Register",
  setup() {
    const {cookies} = useCookies();
    return {cookies};
  },
  data() {
    return {
      email: null,
      password: null,
      name: null
    }
  },
  methods: {
    register() {
      axios.get('http://localhost:8080/sanctum/csrf-cookie', {
        withCredentials: true,
      }).then(response => {
        axios.post('http://localhost:8080/api/register', {
              email: this.email,
              password: this.password,
              name: this.name
            }, {
              withCredentials: true,
              headers: {
                'X-XSRF-TOKEN': this.cookies.get("XSRF-TOKEN")
              }
            }
        ).then(res => {
         // console.log(res);
          localStorage.setItem('my_token',res.data.token)
          localStorage.setItem("status",'authorization');
          this.$router.push({name: 'home'});
       //   location.reload()
        }).catch(err => {
          console.log(err.message);
        })
      });
    }
  }
}
</script>
