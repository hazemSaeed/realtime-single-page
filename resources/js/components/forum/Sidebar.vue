<template>
  <v-card tile>
    <v-toolbar color="cyan" dark dense class="mt-2">
      <v-toolbar-title>Category</v-toolbar-title>
    </v-toolbar>
    <v-list-item v-for="category in categories" :key="category.id">
      <v-list-item-content>
        <v-list-item-title>{{ category.name }}</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      categories: {}
    };
  },
  async created() {
    try {
      const res = await axios.get("/api/category");
      this.categories = res.data.data;
    } catch (err) {}
  }
};
</script>

<style>
</style>