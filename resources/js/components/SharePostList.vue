<template>
  <div>
    <v-card class="mx-auto" color="grey lighten-5" max-width="500">
      <v-toolbar color="teal darken-1" dark dense flat>
        <v-icon left>mdi-account-circle</v-icon>
        <span class="title font-weight-light">{{ feed.user.name }}</span>
        <v-spacer></v-spacer>
        <span class="caption font-weight-light">{{ feed.created_at | moment("ddd, MMMM Do YYYY - h:mm a") }}</span>
      </v-toolbar>
      <v-card-text class="subtitle-1 grey--text text--darken-4">
        <v-card
          class="mx-auto"
        >
          <v-card-title>
            <v-icon left>mdi-account-circle</v-icon>
            <span class="title font-weight-light">{{ feed.user_from.name }}</span>
          </v-card-title>
          <v-card-text class="subtitle-1 grey--text text--darken-4">
            {{ feed.post.content }}
          </v-card-text>
        </v-card>
      </v-card-text>
      <v-card-actions>
        <v-list-item class="grow">
          <v-row align="center">
            <v-btn icon @click="likePost">
              <v-icon class="mr-1" :class="{'blue--text': liked}">{{ liked ? 'mdi-thumb-up' : 'mdi-thumb-up-outline' }}</v-icon>
            </v-btn>
            <span class="subheading mr-2">{{ feed.likes.length}}</span>
            <span class="mr-1">·</span>
            <v-btn icon @click="sharePost">
              <v-icon class="mr-1">mdi-share-variant</v-icon>
            </v-btn>
            <span class="subheading">Share</span>
          </v-row>
        </v-list-item>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
  import CommentList from './CommentList';
  import { mapGetters } from 'vuex';

  export default {
    components: {
      CommentList,
    },
    props: {
      feed: [Array, Object],
    },
    data() {
      return {
        show: false,
        comment: ''
      }
    },
    methods: {
      likePost() {
        this.$store.dispatch("LIKE_SHARED_POST", {
          'share_id': this.feed.id
        });
      },
      sharePost() {
        this.$store.dispatch("SHARE_POST", {
          'post_id': this.feed.post_id,
          'user_from_id': this.feed.user_from_id
        });
      }
    },
    computed: {
      ...mapGetters([
        'getLikeSharedPost',
      ]),
      liked(){
        return this.getLikeSharedPost(this.feed.id);
      }
    },
  }
</script>