<template>
  <div>
    <create-post></create-post>
    <v-row v-for="(feed, index) in getNewsFeed" :key="index">
      <v-col cols="12">
        <share-post-list 
          v-if="feed.user_from_id"
          :feed="feed"
        ></share-post-list>
        <post-list 
          v-else
          :feed="feed"
        ></post-list>
      </v-col>
    </v-row>
  </div>
</template>

<script>
  import PostList from './PostList';
  import SharePostList from './SharePostList';
  import CreatePost from './CreatePost';
  import { mapGetters } from 'vuex';

  export default {
    components: {
      PostList,
      SharePostList,
      CreatePost
    },
    data() {
      return {
        userId: ''
      }
    },
    created () {
      this.$store.dispatch('GET_NEWS_FEED');
      this.$store.commit('SET_USER_ID', document.querySelector("meta[name='user-id']").getAttribute('content'));
    },
    computed: {
      ...mapGetters([
        'getNewsFeed',
      ])
    },
  }
</script>