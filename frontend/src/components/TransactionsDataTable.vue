<template>
  <v-card
    class="mx-auto"
    width="820px">
    <v-card-title>
      Email Transactions
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="desserts"
      :search="search"
    ></v-data-table>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      search: '',
      headers: [
        {
          text: 'Subject',
          align: 'start',
          sortable: false,
          value: 'name',
        },
        { text: 'Sender', value: 'calories' },
        { text: 'Recepient', value: 'fat' },
        { text: 'Date', value: 'carbs' },
        { text: 'Actions', value: 'protein' },
      ],
      desserts: [
        {
          name: 'Checking this data now',
          calories: 'ocanseypeter@gmail.com',
          fat: 'ptodeveloper18@gmail.com',
          carbs: '2021-03-16 12:00',
          protein: '',
        },
      ],
    };
  },
};
</script>
