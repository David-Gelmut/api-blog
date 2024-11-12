<template>
  <div>
    <div class="container mx-auto px-6 py-8">
      <h3 class="text-gray-700 text-3xl font-medium">Добавить новую статью</h3>
      <div class="mt-8"></div>
      <div class="mt-8">
        <div class="space-y-5 mt-5">
          <p v-if="!title" class="text-red-500">Обязательное поле</p>
          <input v-model="title" type="text" class="w-full h-12 border border-gray-800  rounded px-3"
                 placeholder="Название"/>
          <p v-if="!preview" class="text-red-500">Обязательное поле</p>
          <input  v-model="preview" type="text" class="w-full h-12 border border-gray-800  rounded px-3"
                 placeholder="Превью"/>
          <p v-if="!description" class="text-red-500">Обязательное поле</p>
          <input  v-model="description" type="text" class="w-full h-12 border border-gray-800  rounded px-3"
                 placeholder="Описание"/>
          <input type="file" id="file" ref="prev_image" v-on:change="handleFileUpload()" class="w-full h-12"
                 placeholder="Изображение"/>
          <button :disabled="!isDisabled" @click.prevent="addPost()"
                  class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import router from "@/router/index.js";
export default {

  name: "Create",
  data() {
    return {
      title: null,
      preview: null,
      description: null,
      prev_image: null
    }
  },
  mounted() {
  },
  methods: {
    addPost() {
      let formData = new FormData();
      formData.append('title', this.title);
      formData.append('preview', this.preview,);
      formData.append('description', this.description);
      if(this.prev_image)
        formData.append('prev_image', this.prev_image);
      axios.post('http://localhost:8080/api/posts',
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data',
              'Authorization':'Bearer aaKJKIKkkk99009kk)la34355ddfw341pjiju'
            }
          }
      ).then(data => {
        this.$router.push({name:'home'})
      })
    },
    handleFileUpload() {
      this.prev_image = this.$refs.prev_image.files[0];
    },

  },
  computed :{
    isDisabled(){
      return this.title&&this.preview&&this.description;
    }
  }
}
</script>
