<template>
  <v-container fluid ma-0 pa-0>
    <TransactionsLoader v-if="loading" />
    <TransactionsList v-else />
  </v-container>
</template>

<script>
import TransactionsLoader from '../components/TransactionsLoader.vue';
import TransactionsList from '../components/TransactionsList.vue';

export default {
  components: {
    TransactionsList, TransactionsLoader,
  },
  created() {
    this.$store.dispatch('fetchEmails')
      .catch((error) => {
        console.log(error);
        this.$router.push({
          name: 'TransactionsErrorView',
          params: { error },
        });
      });
  },
  computed: {
    emails() {
      return this.$store.state.emails;
    },
    loading() {
      return this.$store.state.loading;
    },
  },
};
</script>
