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
        {{ feed.content }}
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
            <span class="subheading">{{ feed.shares.length}}</span>
            <v-spacer></v-spacer>
            <v-btn icon @click="show = !show">
              <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
            </v-btn>
          </v-row>
        </v-list-item>
      </v-card-actions>
      <v-expand-transition>
        <div v-show="show">
          <v-divider></v-divider>
          <v-card-text class="pb-1 white">
            <v-textarea
              v-model="comment"
              label="Anything to say?"
              hide-details="true"
              rows="2"
              outlined
            >
            <template v-slot:append-outer>
                <v-btn
                  depressed 
                  color="primary"
                  class="ma-0"
                  @click="submitComment">
                  COMMENT
                </v-btn>
            </template>
            
            </v-textarea>
          </v-card-text>
          <comment-list :comments="feed.comments"></comment-list>
        </div>
      </v-expand-transition>
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
      submitComment() {
        if(this.comment != '') {
          this.$store.dispatch("SUBMIT_COMMENT", {
            'post_id': this.feed.id,
            'comment': this.comment
          }).then(res => {
            this.comment = '';
          });
        }
      },
      likePost() {
        this.$store.dispatch("LIKE_POST", {
          'post_id': this.feed.id
        });
      },
      sharePost() {
        this.$store.dispatch("SHARE_POST", {
          'post_id': this.feed.id,
          'user_from_id': this.feed.user_id
        });
      }
    },
    computed: {
      ...mapGetters([
        'getLikePost',
      ]),
      liked(){
        return this.getLikePost(this.feed.id);
      }
    },
  }
</script>