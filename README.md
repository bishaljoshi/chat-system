## CHAT SYSTEM

### Project Setup

- Clone the repository : git@github.com:bishaljoshi/chat-system.git
- Navigate to the project directory
- Run `composer install` to install dependencies
- Copy `.env.example` to `.env` and configure your environment variables
- Run `php artisan key:generate` to generate the application key
- Run `php artisan migrate` to set up the database
- Run `php artisan serve` to start the development server
- Access the application at `http://localhost:8000` or the specified port

### Simulate users

- User Simulation Guide
To facilitate development and testing, the system includes predefined users and login mechanisms for both Agent and Customer roles.

🧑‍💼 Agent Users
We have seeded 3 Agent users using Laravel's database seeder.

These users are available immediately after running the seeder and can be used to simulate agent-related functionality in the frontend.

🧑‍💻 Customer Users
Customers can register via the frontend and then log in to access the system.

No seeder is used for customers — accounts are created dynamically through the registration process.

⚙️ API User Simulation
In the API (specifically Api/ConversationsController), we have hardcoded user authentication for development purposes using:

"Auth::loginUsingId(5)"
This line simulates an authenticated user with ID 5 (assumed to be an Agent or Customer), allowing API routes to be tested without a frontend login.

### Postman collection
1. Import postman collection [./data/collection](data/Chat-System.postman_collection.json)
