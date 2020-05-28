import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Parallex from "../components/Parallex.vue";
import Login from "../components/auth/Login.vue";
import Register from "../components/auth/Register.vue";
import Logout from "../components/auth/Logout.vue";
import Forum from "../components/forum/Forum.vue";
import Read from "../components/forum/Read.vue";
import Create from "../components/forum/Create.vue";
import CreateCategory from "../components/category/Create.vue";

const routes = [{
        path: "/",
        component: Parallex
    },
    {
        path: "/login",
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/logout',
        component: Logout
    },
    {
        path: '/forum',
        component: Forum,
        name: 'forum'
    },
    {
        path: '/question/:slug',
        component: Read
    },
    {
        path: '/ask',
        component: Create
    },
    {
        path: '/category',
        component: CreateCategory
    }
];

const router = new VueRouter({
    routes,
    mode: "history"
});

export default router;
