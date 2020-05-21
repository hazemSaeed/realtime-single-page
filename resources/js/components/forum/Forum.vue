<template>
  <v-container fluid grid-list-md>
    <v-layout row wrap no-gutters>
      <v-flex xs8>
        <question v-for="question in questions" :key="question.id" :question="question"></question>
      </v-flex>
      <v-flex xs4>
        <sidebar></sidebar>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Question from "./Question.vue";
import Sidebar from "./Sidebar.vue";

Question;
export default {
  data() {
    return {
      questions: []
    };
  },
  async created() {
    try {
      const res = await axios.get("/api/question");
      console.log(res.data.data);
      this.questions = res.data.data;
    } catch (err) {
      console.log(err.response.data.errors);
    }
  },
  components: {
    Question,
    Sidebar
  }
};
</script>

<style>
</style>