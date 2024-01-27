<template>
    <div>
      <nav class="navbar navbar-expand-lg navbar-dark" style="margin-top: -62px; background-color: #3498db">
        <div class="container">
          <a class="navbar-brand" href="#">Agenda de Contatos</a>
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
                <router-link to="/" class="nav-link" exact-active-class>Home</router-link>
              </li>
              <li class="nav-item">
                <router-link to="#" class="nav-link" exact-active-class>Lista de Contatos</router-link>
              </li>
            </ul>
          </div>
        </div>
      </nav>
  
    <!-- ContactList.vue -->
<template>
  <layout>
    <div>
      <h2>Lista de Contatos</h2>

      <!-- Lista de contatos paginada -->
      <div v-for="page in paginatedContacts" :key="page.number">
        <ul>
          <li v-for="contact in page.contacts" :key="contact.id">
            <!-- Mostrar informações do contato -->
            {{ contact.name }} - {{ contact.email }}
            <button @click="editContact(contact.id)">Editar</button>
            <button @click="deleteContact(contact.id)">Excluir</button>
          </li>
        </ul>
      </div>
      <!-- Paginação -->
      <div>
        <button @click="prevPage" :disabled="currentPage === 1">Anterior</button>
        <span>Página {{ currentPage }} de {{ totalPages }}</span>
        <button @click="nextPage" :disabled="currentPage === totalPages">Próxima</button>
      </div>
    </div>
  </layout>
</template>

      <slot></slot>
  
      <div class="card-footer text-muted text-center" style="background-color: #5eb7f3; color: white">
        <p style="margin-top: 66px">
          © {{ currentYear }} Deyvson Carlos.
        </p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    components: {
    },
    data() {
      return {
        contacts: [], // Substitua com sua lista de contatos
        itemsPerPage: 5,
        currentPage: 1,
      };
    },
    computed: {
      totalPages() {
        return Math.ceil(this.contacts.length / this.itemsPerPage);
      },
      paginatedContacts() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = start + this.itemsPerPage;
        return {
          number: this.currentPage,
          contacts: this.contacts.slice(start, end),
        };
      },
    },
    methods: {
      editContact() {
        // Implemente a lógica para redirecionar para a página de edição com o ID do contato
        // Exemplo: this.$router.push(`/edit-contact/${contactId}`);
      },
      deleteContact() {
        // Implemente a lógica para excluir o contato com o ID fornecido
        // Exemplo: this.contacts = this.contacts.filter(contact => contact.id !== contactId);
      },
      prevPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
        }
      },
      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.currentPage++;
        }
      },
    },
  };
  </script>
  