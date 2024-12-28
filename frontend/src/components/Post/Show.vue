<template>
  <div  v-if="post">
    <div class="m-auto px-4 py-8 max-w-xl">
      <div class="bg-white shadow-2xl" >
        <div>
          <img :src="post.prev_image?'http://localhost:8080/storage/'+ post.prev_image:''" alt="">
        </div>
        <div class="px-4 py-2 mt-2 bg-white">
          <h2 class="font-bold text-2xl text-gray-800">{{post.title}}</h2>
          <p class="sm:text-sm text-xs text-gray-700 px-2 mr-1 my-3">
            {{ post.description }}
          </p>
        </div>
      </div>
      <!--div-- class="flex flex-row items-center gap-2 mt-2 ml-auto">
        <router-link :to="{name:'edit',params:{id:post.id}}">
          <a class="inline-block rounded bg-blue-900 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-blue-950 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
            Edit
          </a>
        </router-link>
        <a @click.prevent="deletePost(post.id)" href="javascript:;"
           class="inline-block rounded bg-red-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-red-700 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
          Delete
        </a>
      </div-->
       <div>
        <section class="rounded-b-lg mt-4">
          <div v-if="status">
            <p v-if="!text" class="text-red-500">Обязательное поле</p>
            <textarea v-model="text"   class="w-full shadow-inner p-4 border-0 mb-4 rounded-lg focus:shadow-outline text-2xl @error('text') border-red-800 @enderror" placeholder="Ваш комментарий..." spellcheck="false"></textarea>
            <button :disabled="!isDisabled" @click.prevent="createComment" type="submit" class="font-bold py-2 px-4 w-full bg-blue-600 text-lg text-white shadow-md rounded-lg ">Написать </button>
          </div>
          <div id="task-comments" class="pt-4">
            <h3>Комментарии</h3>
            <template v-for="comment in this.comments">
              <div class="bg-white rounded-lg p-3  flex flex-col justify-center items-center md:items-start shadow-lg mb-4">
                <div class="flex flex-row justify-center items-center mr-2 gap-3">
                  <h3 class="text-purple-600 font-semibold text-lg text-center md:text-left ">{{comment.user_name}}</h3>
                  <p>{{comment.created_at}}</p>
                </div>
                <p style="width: 90%" class="text-gray-600 text-lg text-center md:text-left ">{{comment.text}}</p>
              </div>
            </template>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import {useCookies} from "vue3-cookies";

export default {

  name: "Show",
  setup() {
    const {cookies} = useCookies();
    return {cookies};
  },
  data() {
    return {
      post: null,
      comments:null,
      text:null,
      user_id:localStorage.getItem('user_id'),
      error:null,
      status:localStorage.getItem('status')
    }
  },
  mounted() {
    this.getPost();
    this.getComments()
  },
  methods: {
    createComment() {
      axios.post(`http://localhost:8080/api/comments/${this.$route.params.id}`,{
        text:this.text,
        post_id:this.$route.params.id,
        user_id:this.user_id

      },{
        withCredentials: true,
        headers :{
          'X-XSRF-TOKEN':this.cookies.get("XSRF-TOKEN"),
          // 'Authorization':'Bearer '+localStorage.getItem('my_token')
        }
      }).then(data => {
           this.getComments();
       // console.log(data.data.message);

        this.error = data.data.message;
        if(this.error){
          alert(this.error);
        }

        // this.$router.push({name:'home'})
          }).catch(err => {
          console.log(err);
          //  this.error = err.message;
      })
    },
    getComments(){
      axios.get(`http://localhost:8080/api/comments/${this.$route.params.id}`,{
        withCredentials: true,
        headers :{
          'X-XSRF-TOKEN':this.cookies.get("XSRF-TOKEN")
        }
      }).then(data => {

        this.comments = data.data.comments;
        console.log(this.comments);
      })
    },
    getPost() {
      axios.get(`http://localhost:8080/api/posts/${this.$route.params.id}`,{
        withCredentials: true,
        headers :{
          'X-XSRF-TOKEN':this.cookies.get("XSRF-TOKEN")
        }
      }).then(data => {
            this.post = data.data.data;
      })
    },
    deletePost(id) {
       axios.delete(`http://localhost:8080/api/posts/${id}`,{
         withCredentials: true,
         headers :{
           'X-XSRF-TOKEN':this.cookies.get("XSRF-TOKEN")
         }
       })
          .then(data => {
            this.$router.push({name:'home'})
          })
    },
  },
  computed: {
    isDisabled() {
      return this.text;
    }
  }
}
</script>