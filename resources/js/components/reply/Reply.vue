<template>
  <div class="mt-3">
    <v-card>
      <v-card-title>
        <div class="headline">{{ data.user }}</div>
        <div class="ml-2 gray--text">said {{ data.created_at }}</div>
      </v-card-title>
      <v-divider></v-divider>

      <edit-reply v-if="editting" :reply="data"></edit-reply>
      <v-card-text v-else v-html="reply"></v-card-text>
      <v-divider></v-divider>
      <div v-if="!editting">
        <v-card-actions v-if="own">
          <v-btn icon @click="edit">
            <v-icon color="gray">edit</v-icon>
          </v-btn>
          <v-btn icon @click.prevent="destroy">
            <v-icon color="red">delete</v-icon>
          </v-btn>
        </v-card-actions>
      </div>
    </v-card>
  </div>
</template>

<script>
import editReply from "./editReply.vue";

export default {
  props: ["data", "index"],
  data() {
    return {
      editting: false
    };
  },
  components: { editReply },
  computed: {
    reply() {
      return md.parse(this.data.reply);
    },
    own() {
      return User.own(this.data.user_id);
    }
  },
  created() {
    this.listen();
  },
  methods: {
    async destroy() {
      //    const res = await axios.delete(`/api/question/`)
      EventBus.$emit("deleteReply", this.index);
    },
    edit() {
      this.editting = true;
    },
    listen() {
      EventBus.$on("cancelReply", () => {
        this.editting = false;
      });
    }
  }
};
</script>

<style>
</style>