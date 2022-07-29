<template>
    <v-container ma-200>
        <TransactionPaginator/>
        <v-card>
            <TransactionFetchProgress v-if="loading"/>
            <TransactionsTable/>
        </v-card>
    </v-container>
</template>

<script>
import Constants from '@/utils/constants';
import TransactionsTable from './TransactionsTable.vue';
import TransactionPaginator from './TransactionPaginator.vue';
import TransactionFetchProgress from './TransactionFetchProgress.vue';

export default {
  props: ['emails'],
  components: { TransactionsTable, TransactionPaginator, TransactionFetchProgress },
  computed: {
    loading() {
      return (this.$store.state.loading === Constants.TABLE_FETCH_LOAD);
    },
  },
};

</script>
