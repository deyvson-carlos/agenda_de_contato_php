<template>
  <div class="container mt-4">
    <div class="card mx-auto" style="max-width: 600px">
      <div class="card-header text-center bg-primary text-white">
        <h2 class="mb-0">Agenda de Contato</h2>
      </div>

      <div class="card-body">
        <form @submit.prevent="saveContact">
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
                  v-for="(phone, index) in formData.phones"
                  :key="index"
                >
                  {{ phone }}
                  <button
                    type="button"
                    class="btn btn-danger btn-sm float-end"
                    @click="removePhone(index)"
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
                <option selected disabled value="">Escolha...</option>
                <option value="SP">São Paulo</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RJ">Pernambuco</option>
                <option value="RJ">Minas Gerais</option>
                <option value="RJ">Bahia</option>
                <option value="RJ">Santa Catarina</option>
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
              <div class="form-check">
                
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary">
                Salvar Contato
              </button>
            </div>
          </div>
        </form>
      </div>

      <div class="card-footer text-muted text-center">
      <p>© {{ formData.currentYear }} Deyvson Carlos. <br> Todos os direitos reservados.</p>
    </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      formData: {
        cep: "",
        city: "",
        street: "",
        phones: [],
        currentYear: new Date().getFullYear(),
      },
      phoneInput: "",
    };
  },
  methods: {
    fetchAddress() {
      if (this.formData.cep.length === 8) {
        // Chama a API do ViaCEP para obter dados do endereço
        axios
          .get(`https://viacep.com.br/ws/${this.formData.cep}/json/`)
          .then((response) => {
            if (!response.data.erro) {
              // Preenche os campos da cidade, rua e outros dados do endereço
              this.formData.city = response.data.localidade;
              this.formData.street = response.data.logradouro;
              // Adicione aqui mais campos que deseja preencher automaticamente
            }
          })
          .catch((error) => {
            console.error("Erro ao obter dados do CEP:", error);
          });
      }
    },
    addPhone() {
      // Adicione o número apenas se for composto por dígitos
      const numericPhone = this.phoneInput.replace(/\D/g, ''); // Remove caracteres não numéricos
      if (numericPhone.length > 0) {
        this.formData.phones.push(numericPhone);
        this.phoneInput = ''; // Limpa o campo após adicionar
      }
    },
    removePhone(index) {
      this.formData.phones.splice(index, 1);
    },
    restrictToNumbers() {
      // Remova caracteres não numéricos em tempo real enquanto o usuário digita
      this.phoneInput = this.phoneInput.replace(/\D/g, '');
    },
  },
};
</script>
