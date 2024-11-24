<template>
  <div v-if="!status">
     <div class="font-bold flex-row items-center flex p-2">
       <p>Зарегистрируйтесь или войдите в свой аккаунт чтобы увидеть списоу своих постов</p>
     </div>
  </div>
  <div v-if="status" class="flex items-center w-4/5 m-auto">
    <table class="min-w-full text-left text-sm text-gray-500 font-light text-surface dark:text-white bg-blue-50">
      <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
      <tr>
        <th scope="col" class="px-6 py-4">ID</th>
        <th scope="col" class="px-6 py-4">Title</th>
        <th scope="col" class="px-6 py-4">Preview</th>
        <th scope="col" class="px-6 py-4">Description</th>
        <th scope="col" class="px-6 py-4">Edit</th>
        <th scope="col" class="px-6 py-4">Delete</th>
      </tr>
      </thead>
      <tbody>
      <template v-for="post in this.posts">
        <tr v-if="post.user_id == user_id">
          <td class="whitespace-nowrap px-6 py-4">{{ post.id }}</td>
          <td class="whitespace-nowrap px-6 py-4 font-medium">
            <router-link :to="{name:'show',params:{id:post.id}}">{{ post.title }}</router-link>
          </td>
          <td class="whitespace-nowrap px-6 py-4">{{ post.preview }}</td>
          <td class="whitespace-nowrap px-6 py-4">{{ post.description }}</td>
          <td class="py-1 w-2">
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
      user_id:localStorage.getItem('user_id')
    }
  },
  mounted() {
    this.getPosts()
  },
  methods: {
    getPosts() {
      axios.get('http://localhost:8080/api/posts', {
        headers :{
          'Authorization':'Bearer '+localStorage.getItem('my_token')

        }
      }).then(data => {
            this.posts = data.data.posts
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