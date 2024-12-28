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
        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white"> {{post.category_name}}</td>
        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{post.user_name}}</td>
      </tr>
      </template>
      </tbody>
    </table>
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
   //   status:localStorage.getItem("status"),
      categories:null,
      users:null
    }
  },
  mounted() {
   // this.getCategories();
    this.getPosts();
  //  this.getStatus();

   // this.getUsers();
  },
  methods: {/*
    getCategories(){
      axios.get('http://localhost:8080/api/categories',{
        withCredentials: true,
        headers :{
         // 'Authorization':'Bearer '+localStorage.getItem('my_token')
          'X-XSRF-TOKEN': this.cookies.get("XSRF-TOKEN")
        }
      }).then(
          res =>{
          //  console.log(res.data.categories);
            this.categories = res.data.categories;
          }
      )
    },
    getUsers(){
      axios.get('http://localhost:8080/api/users',{
        withCredentials: true,
        headers :{
          'X-XSRF-TOKEN': this.cookies.get("XSRF-TOKEN")
        }
      }).then(
          res =>{
          //  console.log(res.data.users);
            this.users = res.data.users;
          }
      )
    },*/


    getStatus(){
      this.status =  localStorage.getItem('status');
    },
    getPosts() {

      axios.get('http://localhost:8080/api/posts', {
        withCredentials: true,
        headers :{
          'X-XSRF-TOKEN': this.cookies.get("XSRF-TOKEN")
         // 'Authorization':'Bearer '+localStorage.getItem('my_token')
        }
      }).then(data => {
          //  console.log(data.data);
            this.posts = data.data.posts
          })

    },
    /*
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
    },*/

    /*
    test(id){
      if(this.categories){
        this.categories.forEach(function(item, index, arr){
          if(item.hasOwnProperty('id') === id) {
            return (item.hasOwnProperty('title'))
          }

        });
      }
    }*/
  },
}
</script>