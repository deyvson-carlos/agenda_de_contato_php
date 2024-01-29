<template>
  <ContactEdit
    :formData="editedContact"
    @contactUpdated="handleContactUpdated"
  />
  <div>
    <nav
      class="navbar navbar-expand-lg navbar-dark"
      style="margin-top: -62px; background-color: #3498db"
    >
      <div class="container">
        <router-link to="/" class="navbar-brand"
          >Agenda de Contatos</router-link
        >
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link to="/" class="nav-link" exact-active-class
                >Home</router-link
              >
            </li>
            <li class="nav-item">
              <router-link to="/contactlist" class="nav-link" exact-active-class
                >Lista de Contatos</router-link
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-4">Lista de Contatos</h2>

          <div class="mb-3 d-flex justify-content-between align-items-center">
            <router-link to="/contactform" class="btn btn-primary"
              >Voltar ao Cadastro</router-link
            >

            <form class="d-flex" @submit.prevent="searchRecords">
              <input
                v-model="searchQuery"
                class="form-control me-2"
                type="search"
                placeholder="Pesquisa por Nome"
                aria-label="Pesquisa"
              />
              <button class="btn btn-outline-primary" type="submit">
                Pesquisa
              </button>
            </form>
          </div>

          <table class="table table-striped mt-3">
            <thead>
              <tr>
                <th>Nome</th>
                <th>E-Mail</th>
                <th>Telefone</th>
                <th>Logradouro</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>CEP</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="contact in contacts" :key="contact.id">
                <td>{{ contact.name }}</td>
                <td>{{ contact.email }}</td>
                <td>{{ contact.phones }}</td>
                <td>{{ contact.street }}</td>
                <td>{{ contact.city }}</td>
                <td>{{ contact.state }}</td>
                <td>{{ contact.cep }}</td>
                <td>
                  <div class="btn-group" role="group">
                    <router-link
                      :to="{ name: 'editContact', params: { id: contact.id } }"
                      class="btn btn-info btn-sm"
                      style="margin-right: 5px"
                    >
                      Editar
                    </router-link>
                    <button
                      @click="deleteContact(contact.id)"
                      class="btn btn-danger"
                    >
                      Excluir
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item" :class="{ disabled: currentPage === 1 }">
                <button class="page-link" @click="prevPage">Previous</button>
              </li>
              <li
                class="page-item"
                v-for="pageNumber in totalPageArray"
                :key="pageNumber"
                :class="{ active: currentPage === pageNumber }"
              >
                <button class="page-link" @click="goToPage(pageNumber)">
                  {{ pageNumber }}
                </button>
              </li>
              <li
                class="page-item"
                :class="{ disabled: currentPage === totalPages }"
              >
                <button class="page-link" @click="nextPage">Next</button>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div
    class="card-footer text-muted text-center"
    style="background-color: #5eb7f3; color: white"
  >
    <p style="margin-top: 66px">© {{ formData.currentYear }} Deyvson Carlos.</p>
  </div>
</template>

<script>
/* eslint-disable no-dupe-keys, vue/no-dupe-keys */
export default {
  data() {
    return {
      contacts: [],
      editedContact: null,
      sortOrder: "asc",
      currentPage: 1,
      itemsPerPage: 10,
      formData: {
        currentYear: new Date().getFullYear(),
      },
    };
  },

  computed: {
    paginatedContacts() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.contacts.slice(startIndex, endIndex);
    },
    totalPageArray() {
      return Array.from(
        { length: Math.ceil(this.contacts.length / this.itemsPerPage) },
        (_, index) => index + 1
      );
    },
    totalPages() {
      return Math.ceil(this.contacts.length / this.itemsPerPage);
    },
  },

  mounted() {
    fetch("http://localhost:8000/backend/contactController/")
      .then((response) => response.json())
      .then((data) => {
        if (data.error) {
          console.error("Erro ao obter contatos:", data.error);
        } else {
          this.contacts = data;
          this.sortContacts();
        }
      })
      .catch((error) => console.error("Erro ao obter contatos:", error));
  },

  methods: {
    editContact(contact) {
      this.$router.push({ name: "contactEdit", params: { id: contact.id } });
    },

    handleContactUpdated(updatedContact) {
      const index = this.contacts.findIndex(contact => contact.id === updatedContact.id);
      if (index !== -1) { 
        this.contacts.splice(index, 1, updatedContact);
      }
      this.editedContact = null;
    },

    deleteContact(contactId) {
      console.log("Marcar contato como excluído com ID:", contactId);

      fetch(`http://localhost:8000/backend/contactController/${contactId}`, {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({}),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(
              `Erro ao marcar contato como excluído: ${response.statusText}`
            );
          }
          return response.json();
        })
        .then((data) => {
          console.log("Contato marcado como excluído com sucesso:", data);

          if (data.contacts !== undefined) {
            this.contacts = data.contacts;
            console.log("Lista de contatos atualizada:", this.contacts);

          } else {
            console.warn(
              "A propriedade 'contacts' não está presente em 'data'.",
              data
            );
          }
        })
        .catch((error) => {
          console.error("Erro ao marcar contato como excluído:", error.message);
        });
    },

    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    goToPage(pageNumber) {
      this.currentPage = pageNumber;
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    toggleSortOrder() {
      this.sortOrder = this.sortOrder === "asc" ? "desc" : "asc";
      this.sortContacts();
    },
    sortContacts() {
      this.contacts.sort((a, b) => {
        const nameA = a.name.toUpperCase();
        const nameB = b.name.toUpperCase();
        return this.sortOrder === "asc"
          ? nameA.localeCompare(nameB)
          : nameB.localeCompare(nameA);
      });
    },
  },
};
</script>
