<template>
  <v-container>
    <v-form @submit.prevent="submit">
      <v-alert type="error" v-if="errors.name">{{ errors.name[0] }}</v-alert>
      <v-text-field v-model="formData.name" label="Category Name*" required></v-text-field>
      <v-btn type="submit" class="pink" v-if="editSlug">Update</v-btn>
      <v-btn type="submit" class="teal" :disabled="disabled" v-else>Create</v-btn>
    </v-form>
    <v-card tile class="mt-5">
      <v-toolbar color="indigo" dark dense class="mt-2">
        <v-toolbar-title>Category</v-toolbar-title>
      </v-toolbar>
      <div v-for="(category, index) in categories" :key="category.id">
        <v-list-item>
          <v-list-item-action>
            <v-btn icon>
              <v-icon color="grey lighten-1" @click="edit(index)">edit</v-icon>
            </v-btn>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{ category.name }}</v-list-item-title>
          </v-list-item-content>
          <v-list-item-action>
            <v-btn icon @click.prevent="destroy(category.slug,index)">
              <v-icon color="red lighten-1">delete</v-icon>
            </v-btn>
          </v-list-item-action>
        </v-list-item>
        <v-divider></v-divider>
      </div>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        name: null
      },
      categories: {},
      editSlug: null,
      errors: {}
    };
  },
  computed: {
    disabled() {
      return !this.formData.name;
    }
  },
  methods: {
    submit() {
      this.editSlug ? this.update() : this.create();
    },
    async destroy(slug, index) {
      try {
        const res = await axios.delete(`/api/category/${slug}`);
        this.categories.splice(index, 1);
      } catch (err) {}
    },

    edit(index) {
      this.formData.name = this.categories[index].name;
      this.editSlug = this.categories[index].slug;
      this.categories.splice(index, 1);
    },

    async update() {
      const res = await axios.patch(
        `api/category/${this.editSlug}`,
        this.formData
      );
      this.formData.name = null;
      this.editSlug = null;
      this.categories.unshift(res.data);
    },
    async create() {
      try {
        const res = await axios.post("api/category", this.formData);
        this.formData.name = "";
        this.categories.unshift(res.data);
      } catch (err) {
        this.errors = err.response.data.errors;
      }
    }
  },
  async created() {
    if (!User.admin()) {
      this.$router.push("/forum");
    }
    try {
      const res = await axios.get("/api/category");
      this.categories = res.data.data;
    } catch (err) {}
  }
};
</script>

<style>
</style>