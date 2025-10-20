# Laravel Webhook SMS Application

A Laravel application that receives webhook requests, processes message templates with placeholders, and sends SMS messages via configurable endpoints.

## Quick Start

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

**Access**: http://localhost:8000/login  
**Login**: admin@example.com / password

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

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate:fresh --seed
```

**Access**: http://localhost

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

SMS sent via: `GET https://your-sms-gateway.com?number={mobile}&msg={message}&server_password={password}`

## Testing

Import `postman_collection.json` into Postman for easy testing.
