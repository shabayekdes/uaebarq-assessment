import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Dashboard from "@Admin/pages/Dashboard";
import ListVideos from "@Admin/pages/video/List";

const routes = [
    {
        path: "/admin",
        name: "dashboard",
        component: Dashboard
    },
    {
        path: "/admin/videos",
        name: "videos.index",
        component: ListVideos
    }
];

const router = new VueRouter({
    routes,
    mode: "history"
});

export default router;