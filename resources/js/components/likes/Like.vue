<template>
    <div>
        <v-btn icon @click="likeIt">
            <v-icon :color="color">favorite</v-icon>
            {{ count }}
        </v-btn>
    </div>
</template>

<script>
export default {
    props: ["content"],
    data() {
        return {
            liked: this.content.liked,
            count: this.content.like_count
        };
    },
    computed: {
        color() {
            return this.liked ? "red" : "red lighten-4";
        }
    },
    created() {
        Echo.channel("likeChannel").listen("LikeEvent", e => {
            console.log(e);
            if (e.id === this.content.id) {
                e.type === 1 ? this.count++ : this.count--;
            }
        });
    },
    methods: {
        likeIt() {
            if (User.loggedIn()) {
                this.liked ? this.decr() : this.incr();
                this.liked = !this.liked;
            }
        },
        async incr() {
            try {
                await axios.post(`/api/like/${this.content.id}`);
                this.count++;
            } catch (err) {}
        },
        async decr() {
            try {
                await axios.delete(`/api/like/${this.content.id}`);
                this.count--;
            } catch (err) {}
        }
    }
};
</script>

<style></style>
