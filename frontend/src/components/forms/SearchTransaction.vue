<template>
  <v-form v-model="valid"  id="mini-send-search-form">
    <v-container>
      <v-row id="mini-send-search-holder">
        <v-col
        cols="12"
        sm="6"
        md="8"
        id="mini-send-search-input-holder"
        >
          <v-text-field
            v-model="search_text"
            hide-details="true"
            placeholder="Search emails"
            prepend-icon="mdi-magnify"
            variant="plain"
            clearable
            required
            @keydown="searchKey"
            @click:clear="resetSearch"
          ></v-text-field>
        </v-col>

        <v-col
        cols="12"
        sm="6"
        md="4"
        id="mini-send-search-select-holder"
        >
        <v-combobox
          v-model="search_by"
          :items="items"
          hide-details="true"
          color="#4F4FDD"
          @change="changed"
        ></v-combobox>
        </v-col>
      </v-row>
    </v-container>
  </v-form>
</template>

<script>
import Constants from '@/utils/constants';

export default {
  data: () => ({
    valid: false,
    search_text: '',
    search_by: 'SENDER',
    items: [
      'SENDER',
      'RECIPIENT',
      'SUBJECT',
    ],
  }),
  methods: {
    searchKey(value) {
      if (value.code === Constants.SEARCH_KEY) {
        if (this.search_text) {
          this.fetchData(this.getSearchParams());
        }
      }
    },
    fetchData(params) {
      this.$store.dispatch('setLoader', Constants.TABLE_FETCH_LOAD);
      this.$store.dispatch('fetchEmails', params)
        .catch((error) => {
          this.$router.push({
            name: 'TransactionsErrorView',
            params: { error },
          });
        });
    },
    getSearchParams() {
      let params = null;
      if (this.search_by === 'SENDER') {
        params = { from: this.search_text };
      } else if (this.search_by === 'RECIPIENT') {
        params = { to: this.search_text };
      } else if (this.search_by === 'SUBJECT') {
        params = { subject: this.search_text };
      }
      return params;
    },
    changed() {
      if (this.search_text) {
        this.fetchData(this.getSearchParams());
      }
    },
    resetSearch() {
      this.fetchData({});
    },
  },
};
</script>

<style>
#mini-send-search-holder {
    outline: #4F4FDD29 !important;
    outline-style: solid !important;
    outline-width: 1px !important;
    padding: 0px;
    border-radius: 30px;
}
#mini-send-search-holder .col-md-8, .col-12, .col-sm-6 {
    padding: 0px !important;
}
#mini-send-search-form {
    margin-right: 15px;
}
.v-input__slot::before {
    border: none !important;
}
.v-input__slot::after {
    border: none !important;
}
#mini-send-search-input-holder .v-input {
    padding-left: 8px;
}
#mini-send-search-select-holder .v-input{
    padding: 1px 8px;
}
#mini-send-search-select-holder {
    background: #4F4FDD14 0% 0% no-repeat padding-box;
    box-shadow: inset 1px 0px 0px #4F4FDD14;
    border-radius: 0px 22px 22px 0px;
    opacity: 1;
    padding: 1px 8px;
}
</style>
