import {createRouter, createWebHistory} from 'vue-router'

import Index from "@/components/Post/Index.vue";
import Edit from "@/components/Post/Edit.vue";
import Show from "@/components/Post/Show.vue";
import Create from "@/components/Post/Create.vue";
import Login from "@/components/Auth/Login.vue";
import Register from "@/components/Auth/Register.vue";
import Personal from "@/components/Post/Personal.vue";
import Forgot from "@/components/Auth/Forgot.vue";


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

        },
        {
            path: '/login',
            name: 'login',
            component: Login

        },
        {
            path: '/register',
            name: 'register',
            component: Register

        },
        {
            path: '/personal',
            name: 'personal',
            component: Personal

        },
        {
            path: '/forgot',
            name: 'forgot',
            component: Forgot

        }
    ]
})

router.beforeEach((to, from, next) => {
    const status = localStorage.getItem('status');
    console.log(to.name)
    if (!status) {
        if (to.name === 'login' || to.name === 'register'|| to.name === 'forgot') {
            return next();
        } else {
            return next({
                name: 'login'
            });
        }

    }
    if (status && (to.name === 'login' || to.name === 'register'|| to.name === 'forgot')) {
        return next({
            name: 'home'
        });
    }

    next();

})

export default router
