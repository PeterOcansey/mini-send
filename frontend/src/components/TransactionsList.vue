<template>
    <div>
    <v-toolbar
      color="white"
      light
      flat
      id="mini-send-toolbar"
    >

      <v-toolbar-title>MiniSend</v-toolbar-title>

      <v-spacer></v-spacer>

      <SearchTransaction/>
      <ButtonCompose/>

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
        <TransactionsHolder />
      </v-tab-item>
    </v-tabs-items>
    </div>

</template>

<script>
import TransactionsHolder from './TransactionsHolder.vue';
import ButtonCompose from './forms/ButtonCompose.vue';
import SearchTransaction from './forms/SearchTransaction.vue';

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
  components: {
    TransactionsHolder, ButtonCompose, SearchTransaction,
  },
  computed: {
    emails() {
      return this.$store.state.emails;
    },
  },
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
