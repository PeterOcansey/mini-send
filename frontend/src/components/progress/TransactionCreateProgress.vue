<template>
    <v-dialog
      v-model="dialog"
      hide-overlay
      persistent
      width="300"
    >
      <v-card
        color="primary"
        dark
      >
        <v-card-text>
          On the way...
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
</template>

<script>
export default {
  data() {
    return {
      tab: null,
      items: [
        'all',
        'posted',
        'sent',
        'failed',
      ],
      dialog: true,
    };
  },
  computed: {
  },
  methods: {
  },
};
</script>
