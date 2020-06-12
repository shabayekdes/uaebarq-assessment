import Vue from "vue";
import Vuex from "vuex";
import Video from "./modules/video";
import Image from "./modules/image";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        meta_data: {
            last_page: null,
            current_page: 1,
            prev_page_url: null
        },
        errors: {}
    },
    getters: {
        getMetaData: state => state.meta_data,
        getErrorMsg: state => field => {
            if (state.errors.hasOwnProperty(field)) {
                return state.errors[field][0];
            }
        },
        hasError: state => field => {
            return state.errors.hasOwnProperty(field);
        }
    },
    actions: {
        setError({ commit }, oldError) {
            commit("SET_ERRORS", oldError);
        }
    },
    mutations: {
        SET_META_DATA: (state, data) => {
            state.meta_data.from = data.meta.from;
            state.meta_data.to = data.meta.to;
            state.meta_data.total = data.meta.total;
            state.meta_data.last_page = data.meta.last_page;
            state.meta_data.current_page = data.meta.current_page;
            state.meta_data.prev_page_url = data.links.prev;
        },
        SET_ERRORS: (state, data) => {
            state.errors = data;
        }
    },
    modules: {
        Video,
        Image
    }
});
