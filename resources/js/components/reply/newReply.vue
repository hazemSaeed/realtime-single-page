<template>
  <div class="mt-4">
    <vue-simplemde v-model="body" />
    <v-btn color="green" @click.prevent="submit" dark>Reply</v-btn>
  </div>
</template>

<script>
export default {
  props: ["questionSlug"],
  data() {
    return {
      body: null
    };
  },
  methods: {
    async submit() {
      try {
        const res = await axios.post(
          `/api/question/${this.questionSlug}/reply`,
          { body: this.body }
        );
        this.body = "";
        EventBus.$emit("newReply", res.data.data);
        window.scrollTo(0, 0);
      } catch (err) {}
    }
  }
};
</script>

<style>
</style>