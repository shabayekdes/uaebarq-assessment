import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Dashboard from "@Admin/pages/Dashboard";


const routes = [
    {
        path: "/admin",
        name: "dashboard",
        component: Dashboard
    }
];

const router = new VueRouter({
    routes,
    mode: "history"
});

export default router;