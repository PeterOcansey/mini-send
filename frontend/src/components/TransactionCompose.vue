<template>
    <v-card>
    <v-card-title>
        <span class="text-h5">Compose Mail</span>
        <v-spacer></v-spacer>
        <v-btn
        elevation=0
        color="white"
        :ripple=false
        @click="hideDialog"
        >
        <v-icon
            light
            right
        >
            mdi-close
        </v-icon>
        </v-btn>
    </v-card-title>
    <v-divider></v-divider>

    <div>
        <v-text-field
        placeholder="From:"
        :rules="emailRules"
        hide-details="auto"
        single-line
        v-model="from"
        ></v-text-field>
        <v-divider></v-divider>
        <v-text-field
        placeholder="To:"
        :rules="emailRules"
        hide-details="auto"
        single-line
        v-model="to"
        ></v-text-field>
        <v-divider></v-divider>
        <v-text-field
        placeholder="Subject:"
        hide-details="auto"
        single-line
        v-model="subject"
        ></v-text-field>
    </div>

    <vue-editor placeholder="Start typing..." v-model="message" />

    <v-card-actions>
        <v-spacer></v-spacer><ButtonSubmit @submit="sendMail"/>
    </v-card-actions>
    </v-card>
</template>

<script>
import { VueEditor } from 'vue2-editor';
import ButtonSubmit from './forms/ButtonSubmit.vue';

export default {
  data() {
    return {
        to: '',
        from: '',
        subject: '',
        message: '',
        emailRules: [
            v => /.+@.+/.test(v) || 'E-mail must be valid',
        ],
    };
  },
  components: {
        VueEditor,
        ButtonSubmit
    },
    methods: {
        hideDialog() {
            this.$emit('hide-dialog');
        },
        sendMail() {
            console.log("Send email");
            console.log(this.to);
            console.log(this.from);
            console.log(this.subject);
            console.log(this.message);
        },
        validateRequestData() {

        }
    }
};
</script>

<style scoped>
.v-text-field {
    padding: 0px 16px !important;
}
.v-dialog>.v-card>.v-card__title {
    padding: 16px !important;
}
</style>
