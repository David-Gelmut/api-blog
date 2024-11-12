<template>
  <div v-if="post">
    <table class="min-w-full text-left text-sm text-gray-500 font-light text-surface dark:text-white bg-blue-50">
      <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
      <tr>
        <th scope="col" class="px-6 py-4">ID</th>
        <th scope="col" class="px-6 py-4">Title</th>
        <th scope="col" class="px-6 py-4">Preview</th>
        <th scope="col" class="px-6 py-4">Description</th>
        <th scope="col" class="px-6 py-4">Image</th>
        <th scope="col" class="px-6 py-4">Edit</th>
        <th scope="col" class="px-6 py-4">Delete</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ post.id }}</td>
        <td class="whitespace-nowrap px-6 py-4">{{ post.title }}</td>
        <td class="whitespace-nowrap px-6 py-4">{{ post.preview }}</td>
        <td class="whitespace-nowrap px-6 py-4">{{ post.description }}</td>
        <td class="py-1">
          <img :src="post.prev_image?'http://localhost:8080/storage/'+ post.prev_image:''" alt="">
        </td>
        <td class="whitespace-nowrap px-6 py-4 ">
          <router-link :to="{name:'edit',params:{id:post.id}}">
            <a class="inline-block rounded bg-blue-900 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-blue-950 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
              Edit
            </a>
          </router-link>
        </td>
        <td class="whitespace-nowrap px-6 py-4 ">
          <a @click.prevent="deletePost(post.id)" href="javascript:;"
             class="inline-block rounded bg-red-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-red-700 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
            Delete
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import axios from "axios";
import {RouterLink} from "vue-router";
import router from "@/router/index.js";

export default {

  name: "Show",
  data() {
    return {
      post: null
    }
  },
  mounted() {
    this.getPost()
  },
  methods: {
    getPost() {
      axios.get(`http://localhost:8080/api/posts/${this.$route.params.id}`,{
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': 'Bearer aaKJKIKkkk99009kk)la34355ddfw341pjiju'
        }
      })
          .then(data => {
           // console.log(data.data.data);
            this.post = data.data.data;
      })
    },
    deletePost(id) {
       axios.delete(`http://localhost:8080/api/posts/${id}`,{
         headers: {
           'Content-Type': 'multipart/form-data',
           'Authorization': 'Bearer aaKJKIKkkk99009kk)la34355ddfw341pjiju'
         }
       })
          .then(data => {
            this.$router.push({name:'home'})
          })
    },
  }
}
</script>