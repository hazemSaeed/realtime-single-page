<template>
  <v-container fluid class>
    <v-card title-primary class="p-5">
      <v-card-title>
        <router-link :to="question.path">{{question.title}}</router-link>
        <v-spacer></v-spacer>
        <v-btn color="teal" dark>{{ question.reply_count }} Relpies</v-btn>
      </v-card-title>
      <v-card-subtitle class="gray--text">{{question.user}} said {{question.created_at}}</v-card-subtitle>
      <v-card-text class="text--primary mt-5" v-html="body"></v-card-text>
      <v-card-actions v-if="show">
        <v-btn small icon>
          <v-icon color="orange">edit</v-icon>
        </v-btn>
        <v-btn small icon @click.prevent="deleteQuestion">
          <v-icon color="red">delete</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      show: User.own(this.question.user_id)
    };
  },
  props: ["question"],
  computed: {
    body() {
      return md.parse(this.question.body);
    }
  },
  methods: {
    async deleteQuestion() {
      try {
        const res = await axios.delete(`/api/question/${this.question.slug}`);
        this.$router.push("/forum");
      } catch (err) {
        console.log(err);
      }
    }
  }
};
</script>

<style>
</style>