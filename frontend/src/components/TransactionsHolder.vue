<template>
    <v-container ma-200>
        <TransactionPaginator/>
        <v-card>
            <TransactionsTable/>
        </v-card>
    </v-container>
</template>

<script>
import TransactionsTable from './TransactionsTable.vue';
import TransactionPaginator from './TransactionPaginator.vue';

export default {
  components: { TransactionsTable, TransactionPaginator },
};

</script>
