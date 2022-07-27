<template>
  <v-container fluid ma-0 pa-0>
    <v-toolbar
      color="cyan"
      dark
      flat
    >

      <v-toolbar-title>MiniSend</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>

      <!-- Tab bar holder-->
      <template v-slot:extension>
        <v-tabs
          v-model="tab"
          align-with-title
        >
          <v-tabs-slider color="blue"></v-tabs-slider>

          <v-tab
            v-for="item in items"
            :key="item"
          >
            {{ item }}
          </v-tab>
        </v-tabs>
      </template>

    </v-toolbar>

    <v-tabs-items v-model="tab" id="mini-send-tab-items">
      <v-tab-item
        v-for="item in items"
        :key="item"
      >
        <TransactionsHolder/>
      </v-tab-item>
    </v-tabs-items>
  </v-container>
</template>

<script>
import TransactionsHolder from './TransactionsHolder.vue';

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
  components: { TransactionsHolder },
};
</script>

<style>
#mini-send-tab-items {
    background-color: transparent !important;
}
</style>
