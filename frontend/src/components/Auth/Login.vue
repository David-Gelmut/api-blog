<template>
  <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
    <div class="bg-white w-96 shadow-xl rounded p-5">
      <h1 class="text-3xl font-medium">Вход</h1>
      <p  class="text-red-500">{{error}}</p>
      <div class="space-y-5 mt-5">
        <input type="email"  v-model="email" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Email" />
          <p  class="text-red-500">{{error_email}}</p>
        <input type="password" v-model="password" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Пароль" />
          <p  class="text-red-500">{{error_password}}</p>
        <div>
          <router-link :to="{name:'register'}">
            <a href="#" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Регистрация</a>
          </router-link>
          <router-link :to="{name:'forgot'}">
            <a href="#" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Забыли пароль?</a>
          </router-link>
        </div>
        <button type="submit" @click.prevent="login" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Войти</button>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import {useCookies} from "vue3-cookies";

export default {
  name: "Login",
  setup() {
    const {cookies} = useCookies();
    return {cookies};
  },
  data() {
    return {
      email: null,
      password: null,
      status: null,
      error:null
    }
  },
  methods: {
    login() {

      axios.get('http://localhost:8080/sanctum/csrf-cookie', {
        withCredentials: true,
      }).then(response => {
         localStorage.removeItem('my_token');
         localStorage.removeItem('user_id');
         localStorage.removeItem("status");
          axios.post('http://localhost:8080/api/login', {
                email: this.email, password: this.password
              },{
                withCredentials: true,
                headers :{
                  'X-XSRF-TOKEN':this.cookies.get("XSRF-TOKEN")
                }
              }
          ).then(res => {

            console.log(res.data);
           // localStorage.setItem('my_token',res.data.token);
           // localStorage.setItem('user_id',res.data.user.id);
            localStorage.setItem("status",true);
            this.$router.push({name: 'home'});
           // location.reload()

          }).catch(err => {
          //  console.log(err);
            this.error = err.message;
          })
      });
    }
  }
}
</script>
