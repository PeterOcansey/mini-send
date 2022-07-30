<template>
    <v-card>
    <v-card-title>
        <span class="text-h5">Compose Mail</span>
        <v-spacer></v-spacer>

        <v-btn
        :style="textStyle"
        text
        @click="setTextContent()"
      >
        TEXT
      </v-btn>

      <v-btn
        :style="htmlStyle"
        text
        @click="setHtmlContent()"
        class="action-spacer"
      >
        HTML
      </v-btn>

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

    <vue-editor placeholder="Start typing..." v-model="htmlMessage" v-if="isHtml"/>
    <v-container fluid  v-if="isText">
    <v-divider></v-divider>
    <v-textarea
      name="input-7-1"
      auto-grow
      placeholder="Start typing..."
      v-model="textMessage"
    ></v-textarea>
    </v-container>

    <v-card-actions>
      <v-alert type="error" dense dismissible dark v-model="alert">
        {{ alertMessage }}
      </v-alert>
      <v-spacer></v-spacer>
      <ButtonSubmit @submit="sendMail"/>
    </v-card-actions>
    </v-card>
</template>

<script>
import Constants from '@/utils/constants';
import { VueEditor } from 'vue2-editor';
import ButtonSubmit from './forms/ButtonSubmit.vue';

export default {
  data() {
    return {
      to: '',
      from: '',
      subject: '',
      htmlMessage: '',
      textMessage: '',
      emailRules: [
        (v) => /.+@.+/.test(v) || 'E-mail must be valid',
      ],
      contentType: Constants.CONTENT_HTML,
      alert: false,
      alertMessage: '',
    };
  },
  components: {
    VueEditor,
    ButtonSubmit,
  },
  methods: {
    hideDialog() {
      this.resetForm();
      this.$emit('hide-dialog');
    },
    sendMail() {
      if (this.validRequestData()) {
        const payload = {
          to: this.to,
          from: this.from,
          subject: this.subject,
          content_text: this.textMessage,
          content_html: this.htmlMessage,
        };
        this.hideDialog();
        this.$store.dispatch('setLoader', Constants.CREATE_LOAD);
        this.$store.dispatch('createEmail', payload)
          .catch((error) => {
            console.log(error);
            this.$router.push({
              name: 'TransactionsErrorView',
              params: { error },
            });
          });
      } else {
        this.alert = true;
      }
    },
    validRequestData() {
      if (!this.from) {
        this.alertMessage = 'Sender is required';
        return false;
      }
      if (!this.to) {
        this.alertMessage = 'Recipient is required';
        return false;
      }
      if (!this.subject) {
        this.alertMessage = 'Subject is required';
        return false;
      }
      if (!this.textMessage && !this.htmlMessage) {
        this.alertMessage = 'Content text or html is required';
        return false;
      }

      return true;
    },
    switchActiveStyles() {
      return 'background: #4F4FDD29 0% 0% no-repeat padding-box; opacity: 1; color: blue; !important';
    },
    setTextContent() {
      this.contentType = Constants.CONTENT_TEXT;
      this.htmlMessage = '';
    },
    setHtmlContent() {
      this.contentType = Constants.CONTENT_HTML;
      this.textMessage = '';
    },
    resetForm() {
      this.to = '';
      this.from = '';
      this.subject = '';
      this.htmlMessage = '';
      this.textMessage = '';
    },
  },
  computed: {
    textStyle() {
      if (this.contentType === Constants.CONTENT_TEXT) {
        return this.switchActiveStyles();
      }
      return '';
    },
    htmlStyle() {
      if (this.contentType === Constants.CONTENT_HTML) {
        return this.switchActiveStyles();
      }
      return '';
    },
    isHtml() {
      return (this.contentType === Constants.CONTENT_HTML);
    },
    isText() {
      return (this.contentType === Constants.CONTENT_TEXT);
    },
  },
};
</script>

<style scoped>
.v-text-field {
    padding: 0px 16px !important;
}
.v-dialog>.v-card>.v-card__title {
    padding: 16px !important;
}
.container {
    padding: 0px !important;
}
.v-alert{
  margin-bottom: 0px !important;
}
.action-spacer{
  margin: 0px 20px;
}
</style>
