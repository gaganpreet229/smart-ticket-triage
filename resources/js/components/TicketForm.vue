<template>
  <div class="ticket-form">
    <h2 class="ticket-form__title">Create New Ticket</h2>
    <form @submit.prevent="submitForm" class="ticket-form__form">
      <div class="ticket-form__group">
        <label for="subject" class="ticket-form__label">Subject</label>
        <input
          v-model="form.subject"
          type="text"
          id="subject"
          class="ticket-form__input"
          required
        />
      </div>
      <div class="ticket-form__group">
        <label for="body" class="ticket-form__label">Description</label>
        <textarea
          v-model="form.body"
          id="body"
          class="ticket-form__textarea"
          required
        ></textarea>
      </div>
      <button type="submit" class="ticket-form__button">Submit Ticket</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        subject: '',
        body: ''
      }
    };
  },
  methods: {
    async submitForm() {
      try {
        await axios.post('/api/tickets', this.form);
        this.$emit('ticket-created');
        this.form.subject = '';
        this.form.body = '';
        alert('Ticket created successfully!');
      } catch (error) {
        console.error('Error creating ticket:', error);
        alert('Failed to create ticket');
      }
    }
  }
};
</script>

<style>
.ticket-form {
  background: #f9f9f9;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.ticket-form__title {
  margin-top: 0;
  color: #444;
}
.ticket-form__form {
  display: grid;
  gap: 15px;
}
.ticket-form__group {
  display: grid;
  gap: 5px;
}
.ticket-form__label {
  font-weight: bold;
}
.ticket-form__input,
.ticket-form__textarea {
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-family: inherit;
}
.ticket-form__textarea {
  min-height: 100px;
  resize: vertical;
}
.ticket-form__button {
  background: #4CAF50;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
}
.ticket-form__button:hover {
  background: #45a049;
}
</style>