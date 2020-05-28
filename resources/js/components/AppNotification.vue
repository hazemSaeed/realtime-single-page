<template>
    <div class="text-xs-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-btn :color="color" dark v-on="on" icon>
                    <v-icon>add_alert</v-icon>
                    {{ unreadCount }}
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-for="item in unread" :key="item.id">
                    <router-link :to="item.path">
                        <v-list-item-title @click="readIt(item)">{{
                            item.question
                        }}</v-list-item-title>
                    </router-link>
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list>
                <v-list-item v-for="item in read" :key="item.id">
                    <v-list-item-title>{{ item.question }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>

<script>
export default {
    data() {
        return {
            read: {},
            unread: {},
            unreadCount: 0
        };
    },
    created() {
        if (User.loggedIn()) {
            this.getNotifications();
        }
        Echo.private("App.User." + User.id()).notification(notification => {
            this.unread.unshift(notification);
            this.unreadCount++;
        });
    },
    computed: {
        color() {
            return this.unreadCount > 0 ? "red" : "red lighten-4";
        }
    },
    methods: {
        async getNotifications() {
            try {
                const res = await axios.post("/api/notifications");
                this.read = res.data.read;
                this.unread = res.data.unread;
                this.unreadCount = res.data.unread.length;
            } catch (err) {
                Exception.handle(err);
            }
        },
        async readIt(notification) {
            try {
                const res = await axios.post("/api/markAsRead", {
                    id: notification.id
                });
                this.unread.splice(notification, 1);
                this.read.push(notification);
                this.unreadCount--;
            } catch (err) {}
        }
    }
};
</script>

<style></style>
