<template>
    <v-app id="inspire">
        <v-content>
            <v-container class="fill-height" fluid>
                <v-row align="center" justify="center">
                    <v-col cols="12" sm="8" md="4">
                        <v-card class="elevation-12">
                            <v-toolbar color="primary" dark flat>
                                <v-toolbar-title>Login form</v-toolbar-title>
                                <v-spacer />
                            </v-toolbar>
                            <v-card-text>
                                <v-form>
                                    <v-text-field
                                        label="Email"
                                        name="email"
                                        prepend-icon="person"
                                        type="email"
                                        v-model="formData.email"
                                    />

                                    <v-text-field
                                        id="password"
                                        label="Password"
                                        name="password"
                                        v-model="formData.password"
                                        prepend-icon="lock"
                                        type="password"
                                    />
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer />
                                <v-btn @click.prevent="login" color="primary"
                                    >Login</v-btn
                                >
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                email: "",
                password: ""
            }
        };
    },
    methods: {
        async login() {
            try {
                console.log(this.formData);

                const res = await axios.post("/api/auth/login", this.formData);
                console.log(res);
            } catch (err) {
                console.log(err);
            }
        }
    }
};
</script>

<style></style>
