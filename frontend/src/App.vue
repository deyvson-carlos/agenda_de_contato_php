<template>
  <div id="app">
    <contact-form @contactSaved="getContacts" />
    <contact-list v-if="showContactList" />
  </div>
</template>

<script>
import ContactForm from '../src/components/ContactForm.vue';
import ContactList from '../src/components/ContactList.vue';


export default {
  components: {
    ContactForm,
    ContactList,
    
  },
  data() {
    return {
      showContactList: false,
    };
  },
  methods: {
    getContacts() {
      // Implemente a lógica para obter a lista de contatos da API
    },
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
