<template>
    <v-card color="grey lighten-4" flat tile>
        <v-toolbar dense>
            <v-toolbar-title>Bitfumes</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn text
                ><router-link to="/" tag="button">Forum</router-link></v-btn
            >
            <v-btn text
                ><router-link to="/" tag="button"
                    >Add Question</router-link
                ></v-btn
            >
            <v-btn text
                ><router-link to="/" tag="button">Category</router-link></v-btn
            >
            <v-btn text
                ><router-link to="/login" tag="button"
                    >Login</router-link
                ></v-btn
            >
        </v-toolbar>
    </v-card>
</template>
<script>
export default {};
</script>

<style scoped></style>
