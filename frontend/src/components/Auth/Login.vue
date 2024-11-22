<template>
  <div class="flex flex-col gap-2">
    <input type="email" v-model="email" placeholder="Email">
    <input type="password" v-model="password" placeholder="Password">
    <input type="submit" @click.prevent="login" class="rounded-2xl text-gray-50 bg-red-700" value="Login">
  </div>
</template>
<script>
import axios from "axios";
import { useCookies } from "vue3-cookies";
export default {
  name:"Login",
  setup() {
    const { cookies } = useCookies();
    return { cookies };
  },
  data() {
    return {
      email: null,
      password: null,
      token:null
    }
  },
  methods: {
    login() {

      axios.get('http://localhost:8080/sanctum/csrf-cookie',{
        withCredentials: true,
      }).then(response => {
        //console.log(response);
          //let my_cookie_value = this.cookies.get("X-XSRF-TOKEN");
        //  console.log(my_cookie_value);
          axios.post('http://localhost:8080/login', {
                email: this.email, password: this.password
              },
          ).then(res =>{
            console.log(res);

          }).catch(err=>{
              console.log(err.message);
          })
      });
    }
  }
}
</script>
