<template>
  <v-container>
    <h4>Oops! There was an error:</h4>
    <p>{{ error }}</p>
  </v-container>
</template>

<script>
export default {
  props: ['error'],
};
</script>
