<template>
  <v-card color="grey lighten-4" flat tile>
    <v-toolbar dense>
      <v-toolbar-title>Bitfumes</v-toolbar-title>

      <v-spacer></v-spacer>
      <app-notification v-if="loggedIn"></app-notification>
      <v-btn text v-for="item in items" v-if="item.show" :key="item.title">
        <router-link :to="item.to" tag="button">{{ item.title }}</router-link>
      </v-btn>
    </v-toolbar>
  </v-card>
</template>
<script>
import AppNotification from "./AppNotification.vue";

export default {
  data() {
    return {
      loggedIn: User.loggedIn(),
      items: [
        { title: "Forum", to: "/forum", show: true },
        { title: "Ask Question", to: "/ask", show: User.loggedIn() },
        { title: "Category", to: "/category", show: User.admin() },
        { title: "Login", to: "/login", show: !User.loggedIn() },
        { title: "Logout", to: "/logout", show: User.loggedIn() }
      ]
    };
  },
  components: { AppNotification },
  created() {
    EventBus.$on("logout", () => {
      User.loggedOut();
    });
  }
};
</script>

<style scoped></style>
