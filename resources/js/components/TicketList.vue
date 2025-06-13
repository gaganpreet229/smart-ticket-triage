<template>
  <div class="ticket-list">
    <div class="ticket-list__filters">
      <input
        v-model="filters.search"
        type="text"
        placeholder="Search tickets..."
        class="ticket-list__search"
        @input="applyFilters"
      />
      <select
        v-model="filters.category"
        class="ticket-list__filter"
        @change="applyFilters"
      >
        <option value="">All Categories</option>
        <option v-for="category in categories" :key="category" :value="category">
          {{ category }}
        </option>
      </select>
      <select
        v-model="filters.status"
        class="ticket-list__filter"
        @change="applyFilters"
      >
        <option value="">All Statuses</option>
        <option value="open">Open</option>
        <option value="closed">Closed</option>
      </select>
    </div>
    
    <div v-if="loading" class="ticket-list__loading">Loading...</div>
    
    <div v-else class="ticket-list__items">
      <div v-for="ticket in tickets" :key="ticket.id" class="ticket-list__item">
        <h3 class="ticket-list__item-subject">{{ ticket.subject }}</h3>
        <p class="ticket-list__item-body">{{ ticket.body }}</p>
        <div class="ticket-list__item-meta">
          <span class="ticket-list__item-category" :class="`ticket-list__item-category--${ticket.category?.toLowerCase()}`">
            {{ ticket.category || 'Not classified' }}
          </span>
          <span class="ticket-list__item-status" :class="`ticket-list__item-status--${ticket.status}`">
            {{ ticket.status }}
          </span>
          <button
            v-if="!ticket.category"
            @click="$emit('classify', ticket.id)"
            class="ticket-list__item-button"
          >
            Classify
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    tickets: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      loading: false,
      filters: {
        category: '',
        status: '',
        search: ''
      },
      categories: ['Billing', 'Bug', 'Feature Request', 'General']
    };
  },
  methods: {
    applyFilters() {
      this.$emit('filter', this.filters);
    }
  }
};
</script>

<style>
.ticket-list__filters {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}
.ticket-list__search,
.ticket-list__filter {
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
}
.ticket-list__search {
  flex-grow: 1;
}
.ticket-list__items {
  display: grid;
  gap: 15px;
}
.ticket-list__item {
  background: white;
  padding: 15px;
  border-radius: 8px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}
.ticket-list__item-subject {
  margin: 0 0 10px 0;
  color: #333;
}
.ticket-list__item-body {
  margin: 0 0 10px 0;
  color: #666;
}
.ticket-list__item-meta {
  display: flex;
  gap: 10px;
  align-items: center;
}
.ticket-list__item-category,
.ticket-list__item-status {
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 0.8rem;
  font-weight: bold;
}
.ticket-list__item-category--billing {
  background: #ffeb3b;
  color: #000;
}
.ticket-list__item-category--bug {
  background: #f44336;
  color: white;
}
.ticket-list__item-category--feature request {
  background: #4CAF50;
  color: white;
}
.ticket-list__item-category--general {
  background: #2196F3;
  color: white;
}
.ticket-list__item-status--open {
  background: #e8f5e9;
  color: #2e7d32;
}
.ticket-list__item-status--closed {
  background: #ffebee;
  color: #c62828;
}
.ticket-list__item-button {
  background: #2196F3;
  color: white;
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.8rem;
}
.ticket-list__item-button:hover {
  background: #0b7dda;
}
.ticket-list__loading {
  text-align: center;
  padding: 20px;
  color: #666;
}
</style>