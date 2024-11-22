<template>
  <div>
    <nav class="m-3 flex flex-row">
      <div v-if="status" class="hover:bg-blue-300  p-2 rounded-md">
        <router-link :to="{name:'home'}">Home</router-link>
      </div>
      <div v-if="status" class="hover:bg-blue-300 p-2 rounded-md">
        <router-link :to="{name:'create'}">Create</router-link>
      </div>
      <div v-if="!status" class="hover:bg-blue-300 p-2 rounded-md">
        <router-link :to="{name:'login'}">Login</router-link>
      </div>
      <div v-if="!status" class="hover:bg-blue-300 p-2 rounded-md">
        <router-link :to="{name:'register'}">Register</router-link>
      </div>
      <a v-if="status" href="#" @click.prevent="logout">Logout</a>
    </nav>
    <router-view></router-view>
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
      status:this.cookies.get("status")
    }
  },
  mounted() {

  },
  methods: {
    logout() {

      axios.get('http://localhost:8080/api/logout', {
        withCredentials: true,
        headers :{
          'X-XSRF-TOKEN':this.cookies.get("XSRF-TOKEN")
        }
      }).then(data => {
        console.log(data);
        this.cookies.remove ("status");
      })
    },
  },
}
</script>
