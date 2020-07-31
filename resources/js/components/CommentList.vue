<template>
  <div>
    <v-list three-line>
      <template v-for="(item, index) in comments">
        <v-divider
          v-if="index != 0"
          :key="`divider-${index}`" 
          :inset="true"
        ></v-divider>

        <v-list-item
          :key="index"
        >
          <v-list-item-avatar>
            <v-icon left>mdi-account-circle</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-html="item.user.name"></v-list-item-title>
            <v-list-item-subtitle v-html="item.comment"></v-list-item-subtitle>
            <v-list-item-subtitle class="text-right comment-date grey--text text--lighten-1">{{ item.created_at | moment("ddd, MMMM Do YYYY - h:mm a") }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </template>
    </v-list>
  </div>
</template>

<script>
  export default {
    props: {
      comments: [Array, Object],
    },
  }
</script>

<style lang="scss" scoped>
  .comment-date {
    font-size: 12px;
  }
</style>