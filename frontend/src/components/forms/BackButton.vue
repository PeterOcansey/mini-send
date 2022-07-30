<template>
    <div class="mini-send-transaction-detail-btn-back-holder">
    <v-btn
        color="primary"
        fab
        small
        dark
        outlined
        @click="$router.back()"
    >
        <v-icon>mdi-arrow-left</v-icon>
    </v-btn>
    </div>
</template>

<style scoped>
.mini-send-transaction-detail-btn-back-holder {
    text-align: justify;
}

</style>
