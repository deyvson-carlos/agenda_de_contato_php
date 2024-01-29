<template>
  <div class="container mt-4 mb-4">
    <div class="card mx-auto" style="max-width: 600px">
      <div class="card-header text-center bg-primary text-white">
        <h2 class="mb-0">Editar Contato</h2>
      </div>

      <div class="card-body">
        <form method="POST" @submit.prevent="updateContact">
          <div class="row">
            <div class="col-md-6">
              <label for="inputName" class="form-label">Nome</label>
              <input
                type="text"
                class="form-control"
                id="inputName"
                v-model="formData.name"
                required
              />
            </div>
            <div class="col-md-6">
              <label for="inputEmail" class="form-label">Email</label>
              <input
                type="email"
                class="form-control"
                id="inputEmail"
                v-model="formData.email"
                required
              />
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <label for="inputPhone" class="form-label">Telefone(s)</label>
              <input
                type="text"
                class="form-control"
                id="inputPhone"
                v-model="phoneInput"
                @input="restrictToNumbers"
                @keyup.enter="addPhone"
                placeholder="Ex: 123456789, 987654321"
              />
              <ul class="list-group mt-2">
                <li
                  class="list-group-item"
                  v-for="phone in formData.phones"
                  :key="phone"
                >
                  {{ phone }}
                  <button
                    type="button"
                    class="btn btn-danger btn-sm float-end"
                    @click="removePhone(phone)"
                  >
                    Remover
                  </button>
                </li>
              </ul>
            </div>

            <div class="col-md-6">
              <label for="inputStreet" class="form-label">Logradouro</label>
              <input
                type="text"
                class="form-control"
                id="inputStreet"
                v-model="formData.street"
              />
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-3">
              <label for="inputCity" class="form-label">Cidade</label>
              <input
                type="text"
                class="form-control"
                id="inputCity"
                v-model="formData.city"
              />
            </div>
            <div class="col-md-5">
              <label for="inputState" class="form-label">Estado</label>
              <select
                id="inputState"
                class="form-select"
                v-model="formData.state"
                required
              >
                <option selected disabled value="estados">Escolha...</option>
                <option value="SP">São Paulo</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="PE">Pernambuco</option>
                <option value="MG">Minas Gerais</option>
                <option value="BH">Bahia</option>
                <option value="SC">Santa Catarina</option>
              </select>
            </div>
            <div class="col-md-3 offset-md-1" style="margin-left: 10px">
              <label for="inputCEP" class="form-label">CEP</label>
              <input
                type="text"
                class="form-control"
                id="inputCEP"
                v-model="formData.cep"
                @blur="fetchAddress"
              />
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-12">
              <div class="form-check"></div>
            </div>
          </div>

          <!-- Adicione um botão de envio -->
          <button type="submit" class="btn btn-primary mt-3">
            Salvar Alterações
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        name: "", // Inicialize os campos com valores vazios
        email: "",
        phones: [],
        street: "",
        // Adicione outros campos conforme necessário
      },
      phoneInput: "", // Inicialize a entrada do telefone como vazia
      // Adicione outras propriedades conforme necessário
    };
  },
  methods: {
    async updateContact() {
  try {
    const response = await fetch("http://localhost:8000/backend/contactController/", {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(this.formData),
    });

    if (!response.ok) {
      throw new Error(`Erro ao atualizar contato: ${response.statusText}`);
    }

    const updatedContact = await response.json();

    // Emitir um evento para o componente pai
    this.$emit('contactUpdated', updatedContact);

    // Redirecionar de volta à lista de contatos
    this.$router.push('/contactlist');
  } catch (error) {
    console.error('Erro ao atualizar contato:', error.message);
  }
},

  // ... restante do código
}
};
</script>
