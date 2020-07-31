const posts = {
    actions: {
        async ADD_POST({commit}, params) {
            await axios.post('/submit-post', params).then((response) => {
                commit('ADD_POST', response.data);
            });
        },
        GET_NEWS_FEED({commit}) {
            axios.get('/news-feed').then((response) => {
                const feeds = Object.values(response.data);
                const sortFeed = feeds.sort((a, b) => (a.created_at > b.created_at) ? -1 : 1);
                commit('SET_NEWS_FEED', sortFeed);
            });
        },
        GET_USER_NEWS_FEED({commit}) {
            axios.get('/user-news-feed').then((response) => {
                const feeds = Object.values(response.data);
                const sortFeed = feeds.sort((a, b) => (a.created_at > b.created_at) ? -1 : 1);
                commit('SET_NEWS_FEED', sortFeed);
            });
        },
        SUBMIT_COMMENT({commit}, params) {
            axios.post('/submit-comment', params).then((response) => {
                commit('ADD_COMMENT', response.data);
            });
        },
        LIKE_POST({commit, rootState}, params) {
            axios.post('/like-post', params).then((response) => {
                if(typeof response.data === 'object' && response.data !== 1) {
                    commit('LIKED_POST', response.data);
                } else {
                    params['user_id'] = rootState.Users.userId;
                    commit('UNLIKE_POST', params);
                }
            });
        },
        LIKE_SHARED_POST({commit, rootState}, params) {
            axios.post('/like-shared-post', params).then((response) => {
                if(typeof response.data === 'object' && response.data !== 1) {
                    commit('LIKED_POST', response.data);
                } else {
                    params['user_id'] = rootState.Users.userId;
                    params['share'] = true;
                    commit('UNLIKE_POST', params);
                }
            });
        },
        SHARE_POST({commit, rootState}, params) {
            axios.post('/share-post', params).then((response) => {
                commit('ADD_POST', response.data);
                commit('SHARE_POST', response.data);
            });
        }
    },
    mutations: {
        SET_NEWS_FEED(state, newsFeed) {
            state.newsFeed = newsFeed;
        },
        ADD_POST(state, post) {
            state.newsFeed.push(post);
            state.newsFeed = state.newsFeed.sort((a, b) => (a.created_at > b.created_at) ? -1 : 1);
        },
        ADD_COMMENT(state, comment) {
            let newsFeed = state.newsFeed;
            let feed = newsFeed.find(i => i.id == comment.post_id && i.user_from_id == undefined);
            feed.comments.push(comment);
        },
        LIKED_POST(state, like) {
            let newsFeed = state.newsFeed;
            if(like.share_id != undefined) {
                let feed = newsFeed.find(i => i.id == like.share_id && i.user_from_id != undefined);
                feed.likes.push(like);
            } else {
                let feed = newsFeed.find(i => i.id == like.post_id && i.user_from_id == undefined);
                feed.likes.push(like);
            }
        },
        UNLIKE_POST(state, params) {
            let newsFeed = state.newsFeed;
            
            if(params['share']) {
                let feed = newsFeed.find(i => i.id == params.share_id && i.user_from_id != undefined);
                let index = feed.likes.findIndex(i => i.user_id == params['user_id']);
                feed.likes.splice(index, 1);
            } else {
                let feed = newsFeed.find(i => i.id == params.post_id && i.user_from_id == undefined);
                let index = feed.likes.findIndex(i => i.user_id == params['user_id']);
                feed.likes.splice(index, 1);
            }
        },
        SHARE_POST(state, share) {
            let newsFeed = state.newsFeed;
            let feed = newsFeed.find(i => i.id == share.post_id && i.user_from_id == undefined);
            feed.shares.push(share);
        },
    },
    state: {
        newsFeed: [],
    },
    getters: {
        getNewsFeed: state => state.newsFeed,
        getLikePost: (state, getters, rootState) => id => {
            let feed = state.newsFeed.find(v => v.id == id && v.user_from_id == undefined) || {};
            return feed.likes.find(v => v.user_id == rootState.Users.userId) ? true : false;
        },
        getLikeSharedPost: (state, getters, rootState) => id => {
            let feed = state.newsFeed.find(v => v.id == id && v.user_from_id != undefined) || {};
            return feed.likes.find(v => v.user_id == rootState.Users.userId) ? true : false;
        }
    }
}

export default posts;