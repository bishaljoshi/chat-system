## CHAT SYSTEM

### Project Setup

- Clone the repository :
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

### Sample curl/Postman calls for each endpoint
1. http://127.0.0.1:8000/api/conversations - GET
    curl --location 'http://127.0.0.1:8000/api/conversations' \
--header 'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MiwidXNlcm5hbWUiOiJiaXNoYWwiLCJpYXQiOjE3NTE0MjQ3ODMsImV4cCI6MTc1MTQ0NjM4M30.Q8_8SXWqGZRW1qdVT09Q9n0KwLMSKs7fFMPGs_1ZoXw' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6Imk3L0JzaS9IZTI1UG8yL0pxR1lvV3c9PSIsInZhbHVlIjoiNldEZ2plckM0anVHTDRwaHdTaVF2NWRiYzY0blk2em9YQkxYaVhuT0pBT0ZKdEpzcWdIR210cWJNMUhwRy94ZGhDck4vRmUwWGNNbGlrQUtZUTk3UDQ2TmJXYTZEa1BmTGpENVFUaWxuUFFFZFlMUjI2RXZkdFRtU0RITXcyc0IiLCJtYWMiOiI4Yzg1OGZkNTZjOTZiNDg0NGRkMjQ0OTM1ZTczM2I1MmNlNmI1NDJlYmIxN2JkYmMwNjJmNWYzODI2YWQ0YWNkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJ2Q3B3QmwvcDdJZHFFaUQ1YXBUR2c9PSIsInZhbHVlIjoiL2FSb0hLMEQvZkpQc0xTeDNtVTRFMTlEckRRd3JGNlJDZHFjSmJlREgvNFIyNXZFM3haK0JPUkZHcDhnSHN4N1ovck5Idkh1YUtQN0dSZzNmL0xvb1BFN295TmltNjJxWVVORS9JYTV6V1hxUHVXSTBGak9TbFFNcVdDd0xqeWUiLCJtYWMiOiJkYjJkMTU3MWU1ZjU2ZjQ2NTJhNThhY2E5NWRkM2MxMTM3YzBiOTdhZGE1MjAwYjI2M2ZhNWU0YjU2MjVhMTZhIiwidGFnIjoiIn0%3D'

2. http://127.0.0.1:8000/api/conversations - POST
    curl --location 'http://127.0.0.1:8000/api/conversations' \
--header 'Content-Type: application/json' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6Imk3L0JzaS9IZTI1UG8yL0pxR1lvV3c9PSIsInZhbHVlIjoiNldEZ2plckM0anVHTDRwaHdTaVF2NWRiYzY0blk2em9YQkxYaVhuT0pBT0ZKdEpzcWdIR210cWJNMUhwRy94ZGhDck4vRmUwWGNNbGlrQUtZUTk3UDQ2TmJXYTZEa1BmTGpENVFUaWxuUFFFZFlMUjI2RXZkdFRtU0RITXcyc0IiLCJtYWMiOiI4Yzg1OGZkNTZjOTZiNDg0NGRkMjQ0OTM1ZTczM2I1MmNlNmI1NDJlYmIxN2JkYmMwNjJmNWYzODI2YWQ0YWNkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJ2Q3B3QmwvcDdJZHFFaUQ1YXBUR2c9PSIsInZhbHVlIjoiL2FSb0hLMEQvZkpQc0xTeDNtVTRFMTlEckRRd3JGNlJDZHFjSmJlREgvNFIyNXZFM3haK0JPUkZHcDhnSHN4N1ovck5Idkh1YUtQN0dSZzNmL0xvb1BFN295TmltNjJxWVVORS9JYTV6V1hxUHVXSTBGak9TbFFNcVdDd0xqeWUiLCJtYWMiOiJkYjJkMTU3MWU1ZjU2ZjQ2NTJhNThhY2E5NWRkM2MxMTM3YzBiOTdhZGE1MjAwYjI2M2ZhNWU0YjU2MjVhMTZhIiwidGFnIjoiIn0%3D' \
--data '{
    "content": "",
    "customer_id": 4
}'

3. http://127.0.0.1:8000/api/conversations/:conversation_id/messages - GET
    curl --location 'http://127.0.0.1:8000/api/conversations/3/messages' \
--header 'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MiwidXNlcm5hbWUiOiJiaXNoYWwiLCJpYXQiOjE3NTE0MjQ3ODMsImV4cCI6MTc1MTQ0NjM4M30.Q8_8SXWqGZRW1qdVT09Q9n0KwLMSKs7fFMPGs_1ZoXw' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6Imk3L0JzaS9IZTI1UG8yL0pxR1lvV3c9PSIsInZhbHVlIjoiNldEZ2plckM0anVHTDRwaHdTaVF2NWRiYzY0blk2em9YQkxYaVhuT0pBT0ZKdEpzcWdIR210cWJNMUhwRy94ZGhDck4vRmUwWGNNbGlrQUtZUTk3UDQ2TmJXYTZEa1BmTGpENVFUaWxuUFFFZFlMUjI2RXZkdFRtU0RITXcyc0IiLCJtYWMiOiI4Yzg1OGZkNTZjOTZiNDg0NGRkMjQ0OTM1ZTczM2I1MmNlNmI1NDJlYmIxN2JkYmMwNjJmNWYzODI2YWQ0YWNkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJ2Q3B3QmwvcDdJZHFFaUQ1YXBUR2c9PSIsInZhbHVlIjoiL2FSb0hLMEQvZkpQc0xTeDNtVTRFMTlEckRRd3JGNlJDZHFjSmJlREgvNFIyNXZFM3haK0JPUkZHcDhnSHN4N1ovck5Idkh1YUtQN0dSZzNmL0xvb1BFN295TmltNjJxWVVORS9JYTV6V1hxUHVXSTBGak9TbFFNcVdDd0xqeWUiLCJtYWMiOiJkYjJkMTU3MWU1ZjU2ZjQ2NTJhNThhY2E5NWRkM2MxMTM3YzBiOTdhZGE1MjAwYjI2M2ZhNWU0YjU2MjVhMTZhIiwidGFnIjoiIn0%3D'

4. http://127.0.0.1:8000/api/conversations/:conversation_id/messages - POST
    curl --location 'http://127.0.0.1:8000/api/conversations/2/messages' \
--header 'Content-Type: application/json' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6Imk3L0JzaS9IZTI1UG8yL0pxR1lvV3c9PSIsInZhbHVlIjoiNldEZ2plckM0anVHTDRwaHdTaVF2NWRiYzY0blk2em9YQkxYaVhuT0pBT0ZKdEpzcWdIR210cWJNMUhwRy94ZGhDck4vRmUwWGNNbGlrQUtZUTk3UDQ2TmJXYTZEa1BmTGpENVFUaWxuUFFFZFlMUjI2RXZkdFRtU0RITXcyc0IiLCJtYWMiOiI4Yzg1OGZkNTZjOTZiNDg0NGRkMjQ0OTM1ZTczM2I1MmNlNmI1NDJlYmIxN2JkYmMwNjJmNWYzODI2YWQ0YWNkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJ2Q3B3QmwvcDdJZHFFaUQ1YXBUR2c9PSIsInZhbHVlIjoiL2FSb0hLMEQvZkpQc0xTeDNtVTRFMTlEckRRd3JGNlJDZHFjSmJlREgvNFIyNXZFM3haK0JPUkZHcDhnSHN4N1ovck5Idkh1YUtQN0dSZzNmL0xvb1BFN295TmltNjJxWVVORS9JYTV6V1hxUHVXSTBGak9TbFFNcVdDd0xqeWUiLCJtYWMiOiJkYjJkMTU3MWU1ZjU2ZjQ2NTJhNThhY2E5NWRkM2MxMTM3YzBiOTdhZGE1MjAwYjI2M2ZhNWU0YjU2MjVhMTZhIiwidGFnIjoiIn0%3D' \
--data '{
    "content": "test 2 updated",
    "customer_id": 4
}'