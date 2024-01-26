<template>
  <div>
    <h1>Lista de Contatos</h1>
    <ul>
      <li v-for="(contact, index) in contacts" :key="index">
        {{ contact.name }} - {{ contact.email }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      contacts: [
        { name: 'João', email: 'joao@example.com' },
        { name: 'Maria', email: 'maria@example.com' },
        // Adicione mais contatos conforme necessário
      ],
    };
  },
};
</script>
