<template v-slot:extension>
    <v-tabs
        v-model="tab"
        align-with-title
    >
        <v-tabs-slider color="blue"></v-tabs-slider>

        <v-tab
        v-for="item in items"
        :key="item"
        >
        {{ item }}
        </v-tab>
    </v-tabs>
</template>
