<template>
  <v-container fluid ma-0 pa-0>
    <v-toolbar
      color="white"
      light
      flat
      id="mini-send-toolbar"
    >

      <v-toolbar-title>MiniSend</v-toolbar-title>

      <v-spacer></v-spacer>

      <ButtonCompose/>

    </v-toolbar>

  </v-container>
</template>

<script>
import ButtonCompose from '../components/forms/ButtonCompose.vue';

export default {
  data() {
    return {
      tab: null,
      items: [
        'all',
        'posted',
        'sent',
        'failed',
      ],
      text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
    };
  },
  components: { ButtonCompose },
};
</script>

<style>
#mini-send-tab-items {
    background-color: transparent !important;
}
#mini-send-toolbar{
    padding: 5px 60px;
}
.v-toolbar__extension {
    padding: 0px !important;
}
.v-toolbar__title {
    text-align: left;
    font-weight: bold;
    font-size: 25px;
    letter-spacing: 0px;
    color: #000000;
    opacity: 1;
}
</style>
