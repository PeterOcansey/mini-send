<template>
<v-container bg fill-height grid-list-md text-xs-center>
  <v-layout row wrap align-center>
    <v-flex>
      <TransactionsDataTable/>
    </v-flex>
  </v-layout>
</v-container>
</template>

<script>
import TransactionsDataTable from '../components/TransactionsDataTable.vue';

export default {
  components: {
    TransactionsDataTable,
  },
};

</script>
