/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from "vue";
import store from "./store";
import router from "./router";

Vue.mixin({
    methods: {
        truncate: (str, no_word) => str.substr(0, no_word) + "..."
    }
});

const app = new Vue({
    el: "#app",
    router,
    store
});
