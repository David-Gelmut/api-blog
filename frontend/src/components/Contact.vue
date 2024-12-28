<template>
  <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
    <div class="bg-white w-96 shadow-xl rounded p-5">
      <h1 class="text-3xl font-medium">Свяжитесь с нами</h1>
      <div class="space-y-5 mt-5">
        <p v-if="!email" class="text-red-500">Обязательное поле</p>
        <input v-model="email" name="email" type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Email" />
        <p v-if="!text" class="text-red-500">Обязательное поле</p>
        <input v-model="text"  type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Сообщение" />
        <button @click.prevent="send" type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Написать</button>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import router from "@/router/index.js";
import {useCookies} from "vue3-cookies";

export default {

  name: "Contact",
  setup() {
    const {cookies} = useCookies();
    return {cookies};
  },

  data() {
    return {
      text: null,
      email: null,
    }
  },
  mounted() {

  },
  methods: {
    send() {
      let formData = new FormData();
      formData.append('text', this.text);
      formData.append('email', this.email);
      axios.post('http://localhost:8080/api/contact',
          formData,
          {
            withCredentials: true,
            headers: {
              'X-XSRF-TOKEN': this.cookies.get("XSRF-TOKEN")
            }
          }
      ).then(data => {
        alert(data.data.success)
        this.$router.push({name: 'home'})
      })
    },
  },
  computed: {
    isDisabled() {
      return this.text && this.email;
    }
  }
}
</script>
