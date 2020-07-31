<template>
  <v-card 
    class="mx-auto mb-5"
    max-width="500"
  >
    <v-card-text>
      <v-textarea
        v-model="post"
        label="What's on your mind?"
        hide-details="true"
        rows="3"
        outlined
      ></v-textarea>
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="primary" text @click="submit">
        Submit
        <v-icon right>mdi-send</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    data() {
      return {
        post: ''
      }
    },
    methods: {
      submit() {
        if(this.post != '') {
          this.$store.dispatch('ADD_POST', {
            content: this.post
          })
          .then(res => {
            this.post = '';
          });
        }
      }
    },
  }
</script>

<style lang="scss" scoped>

</style>