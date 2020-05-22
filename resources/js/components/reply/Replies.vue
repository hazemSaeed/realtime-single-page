<template>
    <div>
        <reply
            v-for="(reply, index) in content"
            :key="reply.id"
            :index="index"
            :data="reply"
        ></reply>
    </div>
</template>

<script>
import Reply from "./Reply.vue";

export default {
    props: ["question"],
    data() {
        return {
            content: this.question.replies
        };
    },
    components: {
        Reply
    },
    created() {
        this.listen();
    },
    methods: {
        listen() {
            EventBus.$on("newReply", reply => {
                this.content.unshift(reply);
            });
            EventBus.$on("deleteReply", async index => {
                const res = await axios.delete(
                    `/api/question/${this.question.slug}/reply/${this.content[index].id}`
                );
                console.log(res.data);

                this.content.splice(index, 1);
            });
            Echo.private("App.User." + User.id()).notification(notification => {
                this.content.unshift(notification.reply);
            });

            Echo.channel("deleteReplyChannel").listen("DeleteReplyEvent", e => {
                console.log(e);
                for (let index = 0; index < this.content.length; index++) {
                    if (this.content[index].id == e.id) {
                        this.content.splice(index, 1);
                    }
                }
            });
        }
    }
};
</script>

<style></style>
