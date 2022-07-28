<template>
  <v-simple-table
  class="row-pointer"
  >
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left">
            Sender
          </th>
          <th class="text-left">
            Recepient
          </th>
          <th class="text-left">
            Subject
          </th>
          <th class="text-left">
            Status
          </th>
          <th class="text-left">
            Date
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="transaction in transactions"
          :key="transaction.uid"
          @click="viewTransactionDetails(transaction)"
        >
          <td class="text-left">{{ transaction.from }}</td>
          <td class="text-left">{{ transaction.to }}</td>
          <td class="text-left">{{ transaction.subject }}</td>
          <td class="text-left">{{ transaction.status }}</td>
          <td class="text-left">{{ transaction.created_at }}</td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
</template>

<script>
export default {
  data() {
    return {
      /* transactions: [
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
        {
          uid: 'sdfsdfsfsdsdf',
          from: 'ocanseypeter@gmail.com',
          to: 'ptodeveloper18@gmail.com',
          subject: 'Re: Ge the task done, Kid, before I chop off your head',
          status: 'Sent',
          date: 'Jul 18',
        },
      ], */
    };
  },
  methods: {
    viewTransactionDetails(transaction) {
      console.log(transaction);
      this.$router.push({
        name: 'TransactionDetailView',
        params: { id: transaction.uid },
      });
    },
  },
  computed: {
    transactions() {
      return this.$store.state.emails;
    },
  },
};
</script>

<style lang="css" scoped>
.row-pointer >>> tbody tr :hover {
  cursor: pointer;
}
</style>
