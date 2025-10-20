# Laravel Webhook SMS Application

A Laravel application that receives webhook requests, processes message templates with placeholders, and sends SMS messages via configurable endpoints.

## Quick Start

### Step 1: Clone Repository

Run this command in your terminal:

```bash
git clone https://github.com/ehtashamGH/laravel-webhook-sms-app.git
cd laravel-webhook-sms-app
```

### Step 2: Install Dependencies

Run this command in terminal:

```bash
composer install
```

### Step 3: Setup Environment

Run these commands in terminal:

```bash
cp .env.example .env
php artisan key:generate
```

### Step 4: Setup Database

Run this command in terminal:

```bash
php artisan migrate:fresh --seed
```

### Step 5: Start Application

Run this command in terminal:

```bash
php artisan serve
```

### Step 6: Access Application

-   Open browser: http://localhost:8000/login
-   Email: admin@example.com
-   Password: password

## Features

-   Webhook endpoint for receiving JSON payloads
-   Message template management with dynamic placeholders
-   SMS sending via configurable GET endpoint
-   Admin panel with authentication
-   Webhook authentication with secret key

## Setup Methods

### Method A: Standard Setup

-   PHP 8.2+, Composer, SQLite
-   No Docker required

### Method B: Laravel Sail (Docker)

### Step 1: Clone and Install

Run these commands in terminal:

```bash
git clone https://github.com/YOUR_USERNAME/laravel-webhook-sms-app.git
cd laravel-webhook-sms-app
composer install
```

### Step 2: Setup Environment

Run this command in terminal:

```bash
cp .env.example .env
```

### Step 3: Create SQLite Database File

Run this command in terminal:

```bash
touch database/database.sqlite
```

### Step 4: Start Docker

Run this command in terminal:

```bash
./vendor/bin/sail up -d
```

### Step 5: Generate Key

Run this command in terminal:

```bash
./vendor/bin/sail artisan key:generate
```

### Step 6: Setup Database

Run this command in terminal:

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

### Step 7: Access Application

-   Open browser: http://localhost
-   Email: admin@example.com
-   Password: password

## Webhook Endpoint

**URL**: `POST http://localhost:8000/api/webhook`

**Headers**:

```
Content-Type: application/json
X-Webhook-Secret: [get from admin panel]
```

**Example Request**:

```bash
curl -X POST http://localhost:8000/api/webhook \
  -H "Content-Type: application/json" \
  -H "X-Webhook-Secret: YOUR_SECRET" \
  -d '{
    "message_id": "booking_confirmed",
    "mobile": "07440000000",
    "customer_name": "John Smith",
    "booking_id": "BK123456"
  }'
```

## Sample Templates

-   `booking_confirmed` - Booking confirmation
-   `enroute` - Driver en route notification
-   `completed` - Service completed

## Configuration

Configure SMS endpoint in: Admin Panel → Configuration

**You only need to update the base URL** - the parameters (`number`, `msg`, `server_password`) are already set in the code.

Example: `https://your-sms-gateway.com`

SMS sent via: `GET https://your-sms-gateway.com?number={mobile}&msg={message}&server_password={password}`

## Testing

### Test with cURL

Run this command in terminal:

```bash
curl -X POST http://localhost:8000/api/webhook \
  -H "Content-Type: application/json" \
  -H "X-Webhook-Secret: YOUR_SECRET" \
  -d '{
    "message_id": "booking_confirmed",
    "mobile": "07440000000",
    "customer_name": "John Smith",
    "booking_id": "BK123456"
  }'
```

### Test with Postman

1. Import `postman_collection.json` into Postman
2. Update webhook secret variable
3. Run the requests

---

## Note

Currently, request validation and response handling are implemented inline within controllers/services (not separated into dedicated request/response classes). If you prefer separate Form Request classes and structured API Resources/Response objects, let me know and I can refactor accordingly.
