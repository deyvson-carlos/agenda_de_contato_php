import { createRouter, createWebHistory } from 'vue-router';
import ContactForm from '../components/ContactForm.vue';
import ContactList from '../components/ContactList.vue';
import ContactEdit from '../components/ContactEdit.vue';


const routes = [
  { path: '/', redirect: '/contactform' },
  { path: '/contactform', component: ContactForm },
  { path: '/contactlist', component: ContactList },
  { path: '/contact/:id/edit', component: ContactEdit, name: 'editContact' },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;