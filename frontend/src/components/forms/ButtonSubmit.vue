<template>
    <v-btn
      tile
      color="primary"
      shaped
      dark
      elevation="1"
      id="mini-send-btn-submit"
      @click="$emit('submit')"
    >
      <v-icon left>
        mdi-send
      </v-icon>
      SEND
    </v-btn>
</template>

<style scoped>
#mini-send-btn-submit {
  border-radius: 5px !important;
}
</style>
