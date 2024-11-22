<template>
  <div class="flex flex-col gap-2">
    <input type="email" v-model="email" placeholder="Email">
    <input type="password" v-model="password" placeholder="Password">
    <input type="submit" @click.prevent="login" class="rounded-2xl text-gray-50 bg-red-700" value="Login">
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
      token: null
    }
  },
  methods: {
    login() {
      axios.get('http://localhost:8080/sanctum/csrf-cookie', {
        withCredentials: true,
      }).then(response => {
          axios.post('http://localhost:8080/api/login', {
                email: this.email, password: this.password
              },{
                withCredentials: true,
                headers :{
                  'X-XSRF-TOKEN':this.cookies.get("XSRF-TOKEN")
                }
              }
          ).then(res => {
            console.log(res);

          }).catch(err => {
            console.log(err.message);
          })
      });
    }
  }
}
</script>
