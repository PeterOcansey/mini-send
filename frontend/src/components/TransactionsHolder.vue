<template>
    <v-container ma-200>
        <v-card>
            <TransactionsTable/>
        </v-card>
    </v-container>
</template>

<script>
import TransactionsTable from './TransactionsTable.vue';

export default {
  components: { TransactionsTable },
};

</script>
