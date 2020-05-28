<template>
  <v-container fluid>
    <v-form ref="form" @submit.prevent="sumbit">
      <span class="red--text" v-if="errors.title">{{ errors.title[0] }}</span>
      <v-text-field v-model="formData.title" label="Title" required></v-text-field>
      <span class="red--text" v-if="errors.category_id">{{ errors.category_id[0] }}</span>
      <v-select
        v-model="formData.category_id"
        :items="categories"
        item-text="name"
        item-value="id"
        label="Category"
        required
      ></v-select>
      <span class="red--text" v-if="errors.body">{{ errors.body[0] }}</span>
      <vue-simplemde v-model="formData.body" />
      <v-btn color="success" :disabled="disabled" @click.prevent="submit" class="mr-4">Create</v-btn>

      <v-btn color="error" class="mr-4" @click="reset">Reset Form</v-btn>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        title: "",
        category_id: "",
        body: ""
      },
      categories: [],
      errors: {}
    };
  },
  async created() {
    try {
      const res = await axios.get("/api/category");
      this.categories = res.data.data;
    } catch (err) {
      console.log(err.response.data.errors);
    }
  },
  computed: {
    disabled() {
      return !(
        this.formData.title &&
        this.formData.category_id &&
        this.formData.body
      );
    }
  },
  methods: {
    reset() {
      this.formData.title = "";
      this.formData.category_id = "";
      this.formData.body = "";
    },
    async submit() {
      try {
        const res = await axios.post("/api/question", this.formData);
        this.$router.push(res.data.path);
        this.reset();
      } catch (err) {
        this.errors = err.response.data.errors;
      }
    }
  }
};
</script>

<style>
</style>