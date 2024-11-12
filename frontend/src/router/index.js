import { createRouter, createWebHistory } from 'vue-router'
import Index from "@/components/Post/Index.vue";
import Edit from "@/components/Post/Edit.vue";
import Show from "@/components/Post/Show.vue";
import Create from "@/components/Post/Create.vue";


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Index
    },
    {
      path: '/create',
      name: 'create',
      component: Create
    },
    {
      path: '/edit/:id',
      name: 'edit',
      component: Edit

    },
    {
      path: '/show/:id',
      name: 'show',
      component: Show

    }
  ]
})

export default router
