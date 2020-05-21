<template>
  <div>
    <show-question v-if="question" :question="question"></show-question>
    <v-container>
      <replies-vue v-if="question" :question="question"></replies-vue>
      <new-reply v-if="question" :questionSlug="question.slug"></new-reply>
    </v-container>
  </div>
</template>

<script>
import ShowQuestion from "./ShowQuestion.vue";
import RepliesVue from "../reply/Replies.vue";
import newReply from "../reply/newReply.vue";
newReply;
export default {
  data() {
    return {
      question: null
    };
  },
  async created() {
    try {
      const res = await axios.get(`/api/question/${this.$route.params.slug}`);
      this.question = res.data.data;
    } catch (err) {
      console.log(err.response.data.errors);
    }
  },
  components: { ShowQuestion, RepliesVue, newReply }
};
</script>

<style>
</style>