<template>
  <div class="p-6 overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3"><span>ID</span></th>
        <th scope="col" class="px-6 py-3"><span>Title</span></th>
        <th scope="col" class="px-6 py-3"><span>Preview</span></th>
        <th scope="col" class="px-6 py-3"><span>Description</span></th>
        <th scope="col" class="px-6 py-3"><span>Image</span></th>
        <th scope="col" class="px-6 py-3"><span>Category</span></th>
        <th scope="col" class="px-6 py-3"><span>Author</span></th>
      </tr>
      </thead>
      <tbody>
      <template v-for="post in this.posts">
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ post.id }}</td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
            <router-link :to="{name:'show',params:{id:post.id}}">{{ post.title }}</router-link>
          </td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ post.preview }}</td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ post.description }}</td>
          <td class="p-4">
            <img :src="post.prev_image?'http://localhost:8080/storage/'+ post.prev_image:''" class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
          </td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white"> {{post.category.title}}</td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{post.user.name}}</td>
        </tr>
      </template>
      </tbody>
    </table>
    <!--div-- class="flex flex-row gap-3 items-center">
      <a @click="getPostsPrev()">prev</a>
      <a @click="getPostsNext()">next</a>
    </div-->

  </div>
</template>
<script>
import axios from "axios";
//import {RouterLink} from "vue-router";
import {useCookies} from "vue3-cookies";
export default {
  name: "Index",
  components: {
    // RouterLink,
  },
  setup() {
    const {cookies} = useCookies();
    return {cookies};
  },
  data() {
    return {
      posts: null,
      prev:null,
      next:null
    }
  },
  mounted() {
    this.getPosts();
  },
  methods: {

    getPosts() {

      axios.get('http://localhost:8080/api/posts', {
        withCredentials: true,
        headers :{
        //  'X-XSRF-TOKEN': this.cookies.get("XSRF-TOKEN")
         // 'Authorization':'Bearer '+localStorage.getItem('my_token')
        }
      }).then(data => {
            console.log(data);
            this.posts = data.data.posts
         //   this.prev = data.data.test.prev_page_url;
          //  this.next = data.data.test.next_page_url;
          })

    }/*,
    getPostsNext() {

      axios.get(this.next, {
        withCredentials: true,
        headers :{
        }
      }).then(data => {
        console.log( this.next);
      //  console.log(data);
        this.posts = data.data.posts
      })

    },
    getPostsPrev() {

      axios.get(this.prev, {
        withCredentials: true,
        headers :{
        }
      }).then(data => {
        console.log(data);
        this.posts = data.data.posts
      })

    }*/,
  },
}
</script>