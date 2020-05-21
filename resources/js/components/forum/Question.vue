<template>
  <v-card v-if="question" class="mb-5">
    <v-card-title primary-title>
      <router-link :to="question.path">{{question.title}}</router-link>
    </v-card-title>
    <v-card-subtitle class="pb-0 gray--text">{{question.created_at}}</v-card-subtitle>
    <v-card-text class="text--primary mt-5" v-html="body"></v-card-text>
  </v-card>
</template>
<script>
export default {
  props: ["question"],
  computed: {
    body() {
      return md.parse(this.question.body);
    }
  }
};
</script>

<style>
</style>