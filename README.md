````markdown
# Todo List API - Sunil Patel

A RESTful API for managing todo items with user authentication and authorization, built with Laravel.

## Features

-   🔐 **JWT-like Authentication** via Laravel Sanctum
-   ✅ CRUD Operations for Todo Items
-   🔒 Users Can Only Access/Modify Their Own Todos
-   🚦 Status Tracking (`todo`, `in progress`, `completed`)
-   🧪 Unit Tests for Core Functionality

## Prerequisites

-   PHP ≥8.1
-   Composer
-   MySQL ≥5.7
-   Laravel CLI

## Installation

1. **Clone Repository**
    ```bash
    git clone https://github.com/sunilpatel5/todo-app.git
    cd todo-app
    ```
````

2. **Install Dependencies**

    ```bash
    composer install
    ```

3. **Configure Environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    Update `.env` with your database credentials:

    ```env
    DB_DATABASE=your_db_name
    DB_USERNAME=your_db_user
    DB_PASSWORD=your_db_password
    ```

4. **Database Setup**

    ```bash
    php artisan migrate
    ```

5. **Running the Server**
    ```bash
    php artisan serve
    ```
    The API will be available at `http://localhost:8000`.

## API Documentation

### Authentication Endpoints

#### Register User

```http
POST /api/register
```

**Request Body:**

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "secret"
}
```

#### Login

```http
POST /api/login
```

**Request Body:**

```json
{
    "email": "john@example.com",
    "password": "secret"
}
```

**Response:**

```json
{
    "token": "your-api-token"
}
```

### Todo Endpoints (All require authentication)

| Method | Endpoint             | Description          |
| ------ | -------------------- | -------------------- |
| GET    | `/api/v1/todos`      | Get all user's todos |
| POST   | `/api/v1/todos`      | Create new todo      |
| GET    | `/api/v1/todos/{id}` | Get single todo      |
| PUT    | `/api/v1/todos/{id}` | Update todo          |
| DELETE | `/api/v1/todos/{id}` | Delete todo          |

### Todo Object Schema

```json
{
    "id": 1,
    "title": "Buy groceries",
    "description": "Milk, eggs, bread",
    "status": "todo",
    "created_at": "2023-09-15T12:00:00.000000Z",
    "updated_at": "2023-09-15T12:00:00.000000Z"
}
```

### Example Request

```bash
curl -X POST \
  -H "Authorization: Bearer your-token" \
  -H "Content-Type: application/json" \
  -d '{"title":"Learn Laravel","status":"in progress"}' \
  http://localhost:8000/api/todos
```

## Testing

Run tests with:

```bash
php artisan test
```

### Test Coverage

-   Todo creation and validation
-   Authorization checks (users can't access others' todos)

## Database Schema

### Todos Table

```sql
CREATE TABLE todos (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT NULL,
  status VARCHAR(255) DEFAULT 'todo',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## Security

-   🔑 API tokens stored securely using SHA-256 hashing
-   🔒 Password hashing with bcrypt
-   🚫 Authorization policies for resource access

## Technologies Used

-   Laravel 11
-   Laravel Sanctum for API authentication
-   Eloquent ORM
-   MySQL
-   PHPUnit for testing

```

```
