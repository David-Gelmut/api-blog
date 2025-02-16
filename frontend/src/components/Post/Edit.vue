<template>
  <div>
    <div>
      <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Обновить статью c ID :{{ this.$route.params.id }}</h3>
        <div class="mt-8"></div>
        <div class="mt-8">
          <div class="space-y-5 mt-5">
            <!--p-- class="text-red-500">Обязательное поле</p-->
            <input v-model="title" type="text" class="w-full h-12 border border-gray-800  rounded px-3"
                   placeholder="Название"/>
            <input v-model="preview" type="text" class="w-full h-12 border border-gray-800  rounded px-3"
                   placeholder="Превью"/>
            <input v-model="description" type="text" class="w-full h-12 border border-gray-800  rounded px-3"
                   placeholder="Описание"/>
            <!--input type="file" id="file" ref="prev_image" v-on:change="handleFileUpload()" class="w-full h-12"
                   placeholder="Изображение"/-->
            <div>
              <img class="h-64 w-64" :src="prev_image?'http://localhost:8080/storage/'+ prev_image:''">
            </div>
            <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Выберите
              категорию</label>
            <p v-if="!category_id" class="text-red-500">Обязательное поле</p>
            <select v-model="category_id" id="categories"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <template v-for="category in this.categories">
                <option :value="category.id">{{category.title}}</option>
              </template>
            </select>
            <button :disabled="!isDisabled" @click.prevent="editPost()"
                    class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import router from "@/router/index.js";
import {useCookies} from "vue3-cookies";

export default {

  name: "Edit",
  setup() {
    const {cookies} = useCookies();
    return {cookies};
  },
  data() {
    return {
      title: null,
      preview: null,
      description: null,
      prev_image: null ,
      category_id:null,
      categories:null
    }
  },
  mounted() {
    this.getPost();
    this.getCategories();

  },
  methods: {
    getCategories(){
      axios.get('http://localhost:8080/api/categories',{
        headers :{
          'Authorization':'Bearer '+localStorage.getItem('my_token')
        }
      }).then(
          res =>{
            this.categories = res.data.categories;
          }
      )
    },
    getPost() {
      axios.get(`http://localhost:8080/api/posts/${this.$route.params.id}`, {
          //  withCredentials: true,
            headers: {
           //   'Authorization':'Bearer '+localStorage.getItem('my_token')
             // 'X-XSRF-TOKEN': this.cookies.get("XSRF-TOKEN")
            }
          }
      ).then(data => {
        console.log(data);
        this.title = data.data.post.title;
        this.preview = data.data.post.preview;
        this.description = data.data.post.description;
        this.prev_image = data.data.post.prev_image ;
        this.category_id = data.data.post.category.id;
      })
    },
    editPost() {

      let formData = new FormData();
      formData.append('title', this.title);
      formData.append('preview', this.preview);
      formData.append('description', this.description);
      if (this.prev_image)
        formData.append('prev_image', this.prev_image);

      axios.patch(`http://localhost:8080/api/posts/${this.$route.params.id}`,
          // formData
          {
            title: this.title,
            preview: this.preview,
            description: this.description,
            //     prev_image:this.prev_image,
          },
          {
            withCredentials: true,
            headers: {
              'X-XSRF-TOKEN': this.cookies.get("XSRF-TOKEN")
            }
          }).then(data => {
        console.log(data);
        this.$router.push({name: 'show', params: {id: this.$route.params.id}})
      })
    },
    handleFileUpload() {
      this.prev_image = this.$refs.prev_image.files[0];
    }
  },
  computed: {
    isDisabled() {
      return this.title && this.preview && this.description&&this.category_id;
    }
  }
}
</script>