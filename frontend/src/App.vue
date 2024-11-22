<script setup>
import {RouterLink, RouterView} from 'vue-router'
</script>
<template>
  <div>
    <nav class="m-3 flex flex-row">
      <div class="hover:bg-blue-300  p-2 rounded-md">
        <router-link :to="{name:'home'}">Home</router-link>
      </div>
      <div class="hover:bg-blue-300 p-2 rounded-md">
        <router-link :to="{name:'create'}">Create</router-link>
      </div>
      <div class="hover:bg-blue-300 p-2 rounded-md">
        <router-link :to="{name:'login'}">Login</router-link>
      </div>
    </nav>
    <router-view></router-view>
  </div>
</template>

