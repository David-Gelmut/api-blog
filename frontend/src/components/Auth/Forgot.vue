<template>
  <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
    <div class="bg-white w-96 shadow-xl rounded p-5">
      <h1 class="text-3xl font-medium">Восстановление пароля</h1>
      <form class="space-y-5 mt-5">
        <input v-model="email" type="text" class="w-full h-12 border border-red-500 rounded px-3" placeholder="Email" />
        <div>
          <router-link :to="{name:'login'}">
            <a href="#" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Вспомнил пароль</a>
          </router-link>
        </div>
        <button  @click.prevent="forgot" type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Восстановить</button>
      </form>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import {useCookies} from "vue3-cookies";

export default {
  name: "Forgot",
  setup() {
    const {cookies} = useCookies();
    return {cookies};
  },
  data() {
    return {
      email: null,
    }
  },
  methods: {
    forgot() {
      axios.get('http://localhost:8080/sanctum/csrf-cookie', {
        withCredentials: true,
      }).then(response => {
        axios.post('http://localhost:8080/api/forgot', {
              email: this.email,

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
