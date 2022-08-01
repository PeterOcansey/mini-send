<template>
  <v-row>
    <v-col
      v-for="attachment in attachments"
      :key="attachment"
      class="d-flex child-flex"
      cols="4"
    >
      <v-img
        :src="attachment"
        :lazy-src="attachment"
        aspect-ratio="1"
        class="grey lighten-2"
      >
        <template v-slot:placeholder>
          <v-row
            class="fill-height ma-0"
            align="center"
            justify="center"
          >
            <v-progress-circular
              indeterminate
              color="grey lighten-5"
            ></v-progress-circular>
          </v-row>
        </template>
      </v-img>
    </v-col>
  </v-row>
</template>

<script>

export default {
  computed: {
    attachments() {
      return this.$store.state.email.attachment_urls;
    },
  },
};
</script>
