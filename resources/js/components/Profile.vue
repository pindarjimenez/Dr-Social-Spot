<template>
  <div>
    <v-row class="mx-0">
      <v-col cols="6">
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
      </v-col>
      
      <v-col cols="6">
        <user-information :user-information="userInformation"></user-information>
      </v-col>
    </v-row>
  </div>
</template>

<script>
  import PostList from './PostList';
  import CreatePost from './CreatePost';
  import UserInformation from './UserInformation';
  import SharePostList from './SharePostList';
  import { mapGetters } from 'vuex';

  export default {
    components: {
      PostList,
      CreatePost,
      UserInformation,
      SharePostList
    },
    data() {
      return {
        userId: '',
        userInformation: []
      }
    },
    created () {
      this.$store.dispatch('GET_USER_NEWS_FEED');
      this.$store.dispatch('GET_USER_INFORMATION').then(res => {
        this.userInformation = this.getUserInfomation;
      });
      this.$store.commit('SET_USER_ID', document.querySelector("meta[name='user-id']").getAttribute('content'));
    },
    computed: {
      ...mapGetters([
        'getNewsFeed',
        'getUserInfomation'
      ])
    },
  }
</script>