const state = {
    videos: []
};

const getters = {
    getAllVideos: state => state.products,
};

const actions = {
    async fetchListVideos({ commit }, paged = null) {
        let query = paged !== null ? `?page=${paged}` : "";
        const response = await axios.get(`${urlApi}video${query}`);

        commit("SHOW_LIST_VIDEO", response.data);
        commit("SET_META_DATA", response.data, { root: true });
    },
};

const mutations = {
    SHOW_LIST_VIDEO: (state, data) => {
        state.videos = data.data;
    },
};

export default {
    state,
    getters,
    actions,
    mutations
};
