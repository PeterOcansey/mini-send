<template>
  <v-container fluid ma-0 pa-0>
    <v-toolbar
      color="white"
      light
      flat
      id="mini-send-toolbar"
    >

      <v-toolbar-title>MiniSend</v-toolbar-title>

      <v-spacer></v-spacer>

      <ButtonCompose/>

    </v-toolbar>

  <v-container ma-200 id="mini-send-transaction-detail-holder">
    <BackButton/>
    <p class="mini-send-transaction-detail-subject">
      {{ email.subject }}
    </p>
    <p class="mini-send-transaction-detail-address">From: {{ email.from }}</p>
    <p class="mini-send-transaction-detail-address">To: {{ email.to }}</p>
    <v-divider></v-divider>

    <v-row id="mini-send-transaction-details-grid-content-holder">
        <v-col
        cols="12"
        sm="6"
        md="8"
        >
        <div v-html="email.content_html" v-if="email.is_html"></div>
        <div v-if="email.is_html !== true">
          {{ email.content_text }}
        </div>

        </v-col>

        <v-col
        cols="12"
        sm="6"
        md="4"
        >
        <p>{{ attachmentCount }} Attachments</p>
        <TransactionAttachments v-if="attachmentCount > 0"/>
        </v-col>
      </v-row>

  </v-container>

  </v-container>

</template>

<script>
import BackButton from '@/components/forms/BackButton.vue';
import ButtonCompose from '../components/forms/ButtonCompose.vue';
import TransactionAttachments from '../components/TransactionAttachments.vue';

export default {
  props: ['id'],
  data() {
    return {

    };
  },
  components: { ButtonCompose, BackButton, TransactionAttachments },
  created() {
    this.$store.dispatch('fetchEmail', this.id)
      .catch((error) => {
        console.log(error);
        this.$router.push({
          name: 'TransactionsErrorView',
          params: { error },
        });
      });
  },
  computed: {
    email() {
      return this.$store.state.email;
    },
    attachmentCount() {
      return this.$store.state.email.attachment_urls.length;
    },
  },
};
</script>

<style scoped>
#app {
  text-align: justify !important;
}
#mini-send-transaction-detail-holder p{
  text-align: justify;
  margin-bottom: 0px !important;
}
#mini-send-transaction-details-grid-content-holder {
  margin: 35px 0px 0px 0px;
  text-align: justify !important;
}
.mini-send-transaction-detail-subject {
  font-size: 20px;
  color: #000000;
  letter-spacing: 0px;
  padding-top: 20px;
  padding-bottom: 5px;
}
.mini-send-transaction-detail-address {
  font-size: 14px;
  letter-spacing: 0px;
  color: #707070;
  opacity: 1;
}
hr {
margin-top: 10px;
}
.v-toolbar__title {
    text-align: left;
    font-weight: bold;
    font-size: 25px;
    letter-spacing: 0px;
    color: #000000;
    opacity: 1;
}
</style>
