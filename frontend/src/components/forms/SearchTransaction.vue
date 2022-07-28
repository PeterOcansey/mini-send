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
            v-model="firstname"
            hide-details="true"
            placeholder="Search emails"
            prepend-icon="mdi-magnify"
            variant="plain"
            required
          ></v-text-field>
        </v-col>

        <v-col
        cols="12"
        sm="6"
        md="4"
        id="mini-send-search-select-holder"
        >
        <v-combobox
          v-model="select"
          :items="items"
          hide-details="true"
          color="#4F4FDD"
        ></v-combobox>
        </v-col>
      </v-row>
    </v-container>
  </v-form>
</template>

<script>
  export default {
    data: () => ({
      valid: false,
      firstname: '',
      select: 'By Sender',
    items: [
        'By Sender',
        'By Sender',
        'By Subject',
    ],
    }),
  }
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