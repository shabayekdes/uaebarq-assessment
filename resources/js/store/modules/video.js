import router from "@Admin/router";

const state = {
    videos: [],
    video: {
        type: ""
    }
};

const getters = {
    getAllVideos: state => state.videos,
    getSingleVideo: state => state.video
};

const actions = {
    async fetchListVideos({ commit }, paged = null) {
        let query = paged !== null ? `?page=${paged}` : "";
        const response = await axios.get(`${urlApi}video${query}`);

        commit("SHOW_LIST_VIDEO", response.data);
        commit("SET_META_DATA", response.data, { root: true });
    },
    async storeVideo({ commit, dispatch }, data) {
        try {
            const config = {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            };
            const response = await axios.post(`${urlApi}video`, data, config);

            commit("NEW_VIDEO", response);
            commit("RESET_NEW_VIDEO")
            dispatch("resetVideo")
            router.push("/admin/videos");
        } catch (e) {
            commit("SET_ERRORS", e.response.data.errors);
        }
    },
    resetVideo({ commit, dispatch }) {
        commit("RESET_NEW_VIDEO");
        dispatch("resetImages", { root: true });
    }
};

const mutations = {
    SHOW_LIST_VIDEO: (state, data) => {
        state.videos = data.data;
    },
    NEW_VIDEO: (state, data) => {
        state.videos.unshift(data);
    },
    RESET_NEW_VIDEO: state => {
        state.video = {
            type: ""
        };
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
