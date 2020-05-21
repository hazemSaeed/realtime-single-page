<template>
  <div>
    <vue-simplemde v-model="reply.reply" />
    <v-card-actions>
      <v-btn icon small @click="save">
        <v-icon color="green">save</v-icon>
      </v-btn>
      <v-btn icon small @click="cancel">
        <v-icon color="black">cancel</v-icon>
      </v-btn>
    </v-card-actions>
  </div>
</template>

<script>
export default {
  props: ["reply"],
  methods: {
    cancel() {
      EventBus.$emit("cancelReply");
    },
    async save() {
      const res = await axios.patch(
        `/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,
        { body: this.reply.reply }
      );
      console.log(res.data);
      this.cancel();
    }
  }
};
</script>

<style>
</style>