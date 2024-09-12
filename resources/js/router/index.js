import { createRouter, createWebHistory } from "vue-router";

import UsersIndex from '@/components/users/UserIndex.vue'

const routes = [
    {
        path: '/dashboard',
        name: 'users.index',
        component: UsersIndex
    },
]

export default createRouter({
    history: createWebHistory(),
    routes
})
