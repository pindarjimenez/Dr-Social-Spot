const users = {
    actions: {
        async GET_USER_INFORMATION({commit}) {
            await axios.get('/profile-information').then((response) => {
                commit('SET_USER_INFORMATION', response.data);
            });
        },
        async UPDATE_PROFILE({commit}, params) {
            await axios.post('/update-profile', params);
        },
    },
    mutations: {
        SET_USER_ID(state, userId) {
            state.userId = userId;
        },
        SET_USER_INFORMATION(state, userInfomation) {
            state.userInfomation = userInfomation;
        },
    },
    state: {
        userId: '',
        userInfomation: [],
    },
    getters: {
        getUserInfomation: state => state.userInfomation,
    }
}

export default users;