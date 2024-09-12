import './bootstrap';


import { createApp } from "vue";
import router from '@/router/index.js'
import UserIndex from '@/components/users/UserIndex.vue'

createApp({
    components: {
        UserIndex
    }
}).use(router).mount('#app')
