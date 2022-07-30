<template>
    <v-btn
      tile
      color="primary"
      shaped
      dark
      elevation="1"
      id="mini-send-btn-compose"
      @click="startComposeEmail"
    >
      <v-icon left>
        mdi-pencil
      </v-icon>
      COMPOSE
    </v-btn>
</template>

<script>
export default {
  methods: {
    startComposeEmail() {
      console.log('Start compose message');
      this.$emit('start-compose-email');
    },
  },
};
</script>

<style>
#mini-send-btn-compose {
  border-radius: 5px !important;
}
</style>
