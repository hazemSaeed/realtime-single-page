<template>
  <v-container fluid>
    <v-form ref="form" @submit.prevent="sumbit">
      <v-text-field v-model="formData.title" label="Title" required></v-text-field>
      <v-select
        v-model="formData.category_id"
        :items="categories"
        item-text="name"
        item-value="id"
        label="Category"
        required
      ></v-select>
      <vue-simplemde v-model="formData.body" />
      <v-btn color="success" @click.prevent="submit" class="mr-4">Create</v-btn>

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
      categories: []
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
        console.log(err.response.data.errors);
      }
    }
  }
};
</script>

<style>
</style>