<template>
  <v-row no-gutters justify="center" align="center">
    <v-col>
        <p id="mini-send-paginator-label">Showing {{ paginator.from }} --
        {{ paginator.to }} of {{ paginator.total }} emails</p>
    </v-col>
    <v-col>
        <v-pagination
        v-model="paginator.current_page"
        :length="paginator.last_page"
        circle
        @input="pageChanged"
        id="mini-send-paginator"
        ></v-pagination>
    </v-col>
  </v-row>
</template>

<script>
import Constants from '@/utils/constants';

export default {
  data() {
    return {
      page: 1,
    };
  },
  computed: {
    paginator() {
      return this.$store.getters.getPaginator;
    },
  },
  methods: {
    pageChanged(value) {
      this.$store.dispatch('setLoader', Constants.TABLE_FETCH_LOAD);
      this.$store.dispatch('fetchEmails', { pageSize: 4, page: value })
        .catch((error) => {
          this.$router.push({
            name: 'TransactionsErrorView',
            params: { error },
          });
        });
    },
  },
};
</script>

<style>
#mini-send-paginator {
    padding-right: 0px !important;
}
#mini-send-paginator-label {
    text-align: left;
    margin-bottom: 0px !important;
}
.v-pagination {
    justify-content: end !important;
}
</style>
