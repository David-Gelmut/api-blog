<template>
  <div v-if="!status">
    <div class="font-bold flex-row items-center flex p-2">
      <p>Зарегистрируйтесь или войдите в свой аккаунт чтобы увидеть списоу своих постов</p>
    </div>
  </div>
  <div v-if="status" class="p-6 overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3"><span>ID</span></th>
        <th scope="col" class="px-6 py-3"><span>Title</span></th>
        <th scope="col" class="px-6 py-3"><span>Preview</span></th>
        <th scope="col" class="px-6 py-3"><span>Description</span></th>
        <th scope="col" class="px-6 py-3"><span>Image</span></th>
        <th scope="col" class="px-6 py-3"><span>Category</span></th>
        <th scope="col" class="px-6 py-3"><span>Edit</span></th>
        <th scope="col" class="px-6 py-3"><span>Delete</span></th>
      </tr>
      </thead>
      <tbody>
      <template v-for="post in this.posts">
        <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ post.id }}</td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
            <router-link :to="{name:'show',params:{id:post.id}}">{{ post.title }}</router-link>
          </td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ post.preview }}</td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ post.description }}</td>
          <td class="p-4">
            <img :src="post.prev_image?'http://localhost:8080/storage/'+ post.prev_image:''" class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
          </td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ post.category.title}}</td>
          <td class="px-6 py-4">
            <router-link :to="{name:'edit',params:{id:post.id}}">
              <a href="#" class="font-medium text-blue-500 dark:text-blue-500 hover:underline">Edit</a>
            </router-link>
          </td>
          <td class="px-6 py-4">
            <a @click.prevent="deletePost(post.id)" href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
          </td>
        </tr>
      </template>
      </tbody>
    </table>
  </div>
</template>
<script>
import axios from "axios";
import {useCookies} from "vue3-cookies";
export default {
  name: "Personal",

  setup() {
    const {cookies} = useCookies();
    return {cookies};
  },
  data() {
    return {
      posts: null,
      status:localStorage.getItem("status"),
    }
  },
  mounted() {
    this.getPosts()
  },
  methods: {
    getPosts() {
      axios.get('http://localhost:8080/api/auth_posts', {
        withCredentials: true,
        headers :{
          'X-XSRF-TOKEN': this.cookies.get("XSRF-TOKEN")
        }
      }).then(data => {
        //console.log(data);
        this.posts = data.data.posts;

      })
    },
    deletePost(id) {
      axios.delete(`http://localhost:8080/api/posts/${id}`,
          {
            withCredentials: true,
            headers :{
              'X-XSRF-TOKEN':this.cookies.get("XSRF-TOKEN")
            }
          }
      ).then(data => {
            this.getPosts();
          })
    },
  },
}
</script>