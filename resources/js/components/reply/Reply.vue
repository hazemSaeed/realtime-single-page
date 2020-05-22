<template>
  <div class="mt-3">
    <v-card v-if="renderComponent">
      <v-card-title>
        <div class="headline">{{ data.user }}</div>
        <div class="ml-2 gray--text">said {{ data.created_at }}</div>
        <v-spacer></v-spacer>
        <like :content="data"></like>
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
import Like from "../likes/Like.vue";

export default {
  props: ["data", "index"],
  data() {
    return {
      editting: false,
      beforeEditReplyBody: "",
      renderComponent: true
    };
  },
  components: { editReply, Like },
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
    forceRerender() {
      // Remove my-component from the DOM
      this.renderComponent = false;

      this.$nextTick(() => {
        // Add the component back in
        this.renderComponent = true;
      });
    },
    async destroy() {
      EventBus.$emit("deleteReply", this.index);
    },
    async edit() {
      this.editting = true;
      this.$el.beforeEditReplyBody = this.data.reply;
    },
    listen() {
      EventBus.$on("cancelReply", reply => {
        this.editting = false;
        if (reply !== this.data.reply) {
          this.data.reply = this.beforeEditReplyBody;
          this.beforeEditReplyBody = "";
        }
      });
    }
  }
};
</script>

<style>
</style>