<template>
  <v-row no-gutters justify="center" align="center">
    <v-col>
        <p id="mini-send-paginator-label">Showing 1 -- 15 of 2,873 emails</p>
    </v-col>
    <v-col>
        <v-pagination
        v-model="page"
        :length="4"
        circle
        id="mini-send-paginator"
        ></v-pagination>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      page: 1,
    };
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
