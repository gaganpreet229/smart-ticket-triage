AI Automation ticket category identified using AI response based on subject and message.

**#Setup**
1. Clone the repository
2. Run composer install
3. Create .env file and configure database/OpenAI settings
4. Add this variable OPENAI_API_KEY=your-openia-key in your .env file.
5. Also add this variable below of OPENAI_API_KEY OPENAI_CLASSIFY_ENABLED=true.
6. You can false OPENAI_CLASSIFY_ENABLED=false for testing.
7. Run migrations: php artisan migrate
8. Seed database: php artisan db:seed --class=TicketSeeder
9. Install frontend dependencies: npm install
10. Start development servers:
11. Laravel: php artisan serve
12. Vite: npm run dev
13. Axios : npm install axios
14. Queue worker: php artisan queue:work


**##Assumptions**
Minimal styling - focused on functionality over design
Using synchronous queue processing for simplicity
No authentication for simplicity in this demo
