<template>
  <v-app id="inspire">
    <v-content>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Register form</v-toolbar-title>
                <v-spacer />
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="Name"
                    name="name"
                    prepend-icon="person"
                    type="text"
                    v-model="formData.name"
                  />
                  <span class="red--text" v-if="errors.name">{{ errors.name[0] }}</span>
                  <v-text-field
                    label="Email"
                    name="email"
                    prepend-icon="mdi-email"
                    type="email"
                    v-model="formData.email"
                  />
                  <span class="red--text" v-if="errors.email">{{ errors.email[0] }}</span>
                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    v-model="formData.password"
                    prepend-icon="lock"
                    type="password"
                  />
                  <span class="red--text" v-if="errors.password">{{ errors.password[0] }}</span>
                  <v-text-field
                    id="password_confirmation"
                    label="Confirm Password"
                    name="password_confirmation"
                    v-model="formData.password_confirmation"
                    prepend-icon="lock"
                    type="password"
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn @click.prevent="register" color="primary">Register</v-btn>
                <v-btn color="dark">
                  <router-link to="/login" tag="button">Go to Login</router-link>
                </v-btn>
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
        name: "",
        email: "",
        password: "",
        password_confirmation: ""
      },
      errors: {}
    };
  },
  created() {
    if (User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
  },
  methods: {
    async register() {
      try {
        const res = await axios.post("/api/auth/signup", this.formData);
        User.responseAfterToken(res);
        this.formData.name = "";
        this.formData.email = "";
        this.formData.password = "";
        this.formData.password_confirmation = "";
      } catch (err) {
        this.errors = err.response.data.errors;
      }
    }
  }
};
</script>

<style></style>
