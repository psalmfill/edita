import Vue from 'vue'
import {createRouter, createWebHistory} from 'vue-router'
import home from './routes/home';

// Vue.use(VueRouter);
export default createRouter({
    history: createWebHistory(),
    scrollBehavior: (to, from, savedPosition) => ({ y: 0 }),
    routes: [
        ...home,
    ],
});
