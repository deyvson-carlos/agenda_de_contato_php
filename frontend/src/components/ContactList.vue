<template>
  <div>
    <h1>Formulárioooo de Contato</h1>

    <form @submit.prevent="salvarContato">
      <!-- Campo Nome -->
      <label for="nome">Nome:</label>
      <input v-model="contato.nome" type="text" id="nome" name="nome" required>

      <!-- Campo E-mail -->
      <label for="email">E-mail:</label>
      <input v-model="contato.email" type="email" id="email" name="email" required>

      <!-- Campo Endereço -->
      <label for="endereco">Endereço:</label>
      <input v-model="contato.endereco" type="text" id="endereco" name="endereco" required>

      <!-- Campo Telefone Residencial -->
      <label for="telefone_residencial">Telefone Residencial:</label>
      <input v-model="contato.telefoneResidencial" type="tel" id="telefone_residencial" name="telefone_residencial">

      <!-- Campo Telefones Adicionais -->
      <label for="telefones_adicionais">Telefones Adicionais (separados por vírgula):</label>
      <input v-model="contato.telefonesAdicionais" type="text" id="telefones_adicionais" name="telefones_adicionais">

      <!-- Botão Enviar -->
      <button type="submit">Salvar Contato</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      contato: {
        nome: '',
        email: '',
        endereco: '',
        telefoneResidencial: '',
        telefonesAdicionais: '',
      },
    };
  },
  methods: {
    salvarContato() {
      // Aqui você pode enviar os dados do contato para o servidor ou realizar qualquer outra ação necessária
      console.log('Dados do Contato:', this.contato);
      // Resetar o formulário após o envio, se desejado
      this.resetarFormulario();
    },
    resetarFormulario() {
      this.contato = {
        nome: '',
        email: '',
        endereco: '',
        telefoneResidencial: '',
        telefonesAdicionais: '',
      };
    },
  },
};
</script>

<style scoped>
/* Adicione estilos conforme necessário */
</style>
