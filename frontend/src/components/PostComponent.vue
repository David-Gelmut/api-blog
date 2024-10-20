<script setup>
</script>

<template>
  <div>
    Name : {{ name }}
  </div>
  <div>
    Job : {{ TomJob }}
  </div>

  <button @click="Hello()">Hello</button>
  <button @click="Hi()">Hi</button>

  <div v-for="person in oldPersons">
    <div v-if="person.age > 30">
      <div>{{ person.name }}</div>
      <div>{{ person.age }}</div>
      <div>{{ person.job }}</div>
    </div>
  </div>


</template>

<script>
import HelloWorld from "@/components/HelloWorld.vue";

export default {

  name: "PostComponent",
  data() {
    return {
      name: 'Tom',
      age: 123,
      persons: [
        {name: 'Max', age: 30, job: 'manager'},
        {name: 'Tim', age: 34, job: 'developer'},
        {name: 'Anna', age: 29, job: 'hr'}
      ]
    }
  },

  methods: {
    Hello() {
      console.log('Hello!');
    },
    Hi() {
      console.log('Hi!');
    },
  },
  components: {
    HelloWorld
  },
  computed: {
    TomJob() {
      return this.name + ' jod';
    },
    oldPersons() {
      this.persons.filter(function (person) {
        return person.age > 30;
      })
    }

  }

}


</script>


<style scoped>

</style>