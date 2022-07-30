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
      <ButtonCompose @start-compose-email="startComposeEmail"/>

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

      <v-row justify="center">
        <v-dialog
          v-model="dialog"
          persistent
          max-width="960px"
        >

        <TransactionCompose @hide-dialog="hideDialog"/>

        </v-dialog>
      </v-row>
    </div>

</template>

<script>
import TransactionsHolder from './TransactionsHolder.vue';
import ButtonCompose from './forms/ButtonCompose.vue';
import SearchTransaction from './forms/SearchTransaction.vue';
import TransactionCompose from './TransactionCompose.vue';

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
      dialog: false,
    };
  },
  components: {
    TransactionsHolder,
    ButtonCompose,
    SearchTransaction,
    TransactionCompose,
  },
  computed: {
    emails() {
      return this.$store.state.emails;
    },
  },
  methods: {
    startComposeEmail() {
      this.dialog = true;
    },
    hideDialog() {
      this.dialog = false;
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
