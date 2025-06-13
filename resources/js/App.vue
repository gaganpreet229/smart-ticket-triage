<template>
  <div class="app">
    <h1 class="app__title">Smart Ticket Triage</h1>
    <div class="app__content">
      <TicketForm @ticket-created="fetchTickets" />
      <TicketList 
        :tickets="tickets" 
        @classify="classifyTicket" 
        @filter="applyFilters"
      />
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import TicketForm from './components/TicketForm.vue';
import TicketList from './components/TicketList.vue';

export default {
  components: { TicketForm, TicketList },
  data() {
    return {
      tickets: [],
      filters: {
        category: '',
        status: '',
        search: ''
      }
    };
  },
  mounted() {
    this.fetchTickets();
  },
  methods: {
    async fetchTickets() {
      try {
        const response = await axios.get('/api/tickets', { params: this.filters });
        this.tickets = response.data;
      } catch (error) {
        console.error('Error fetching tickets:', error);
      }
    },
    async classifyTicket(ticketId) {
      try {
        await axios.post(`/api/tickets/${ticketId}/classify`);
        this.fetchTickets();
      } catch (error) {
        console.error('Error classifying ticket:', error);
      }
    },
    applyFilters(filters) {
      this.filters = filters;
      this.fetchTickets();
    }
  }
};
</script>

<style>
.app {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}
.app__title {
  color: #333;
  text-align: center;
  margin-bottom: 30px;
}
.app__content {
  display: grid;
  gap: 30px;
}
</style>