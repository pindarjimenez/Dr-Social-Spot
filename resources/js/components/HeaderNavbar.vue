<template>
  <div>
    <v-navigation-drawer 
      v-model="drawer"
      app
      clipped
    >
      <v-list dense>
        <v-list-item @click="profile">
          <v-list-item-action>
            <v-icon>mdi-account-box-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Profile</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="newsfeed">
          <v-list-item-action>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>News Feed</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="logout">
          <v-list-item-action>
            <v-icon>mdi-cog</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      clipped-left
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>DR Social Spot</v-toolbar-title>
    </v-app-bar>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        drawer: null,
      }
    },
    methods: {
      newsfeed() {
        window.location.href = '/'
      },
      profile() {
        window.location.href = '/profile'
      },
      logout() {
        window.location.href = '/logout'
      }
    },
  }
</script>

<style lang="scss" scoped>

</style>