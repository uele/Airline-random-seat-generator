
# Airline Voucher Seat Assignment System

## Overview

The Airline Voucher Seat Assignment System is a web application that automatically assigns three unique passenger seats for airline crew vouchers.

The application prevents duplicate seat assignments for the same flight and departure date by validating whether vouchers have already been generated before creating new assignments.

This project is built as a full-stack application using:

* Laravel (PHP) – Backend REST API
* React.js – Frontend
* SQLite – Database
* Axios – API communication

---

## Features

* Generate three unique seats for each crew voucher
* Prevent duplicate voucher generation for the same flight and date
* Store voucher information in SQLite
* Display all generated vouchers in a responsive table
* RESTful API architecture
* Service-based seat generation logic
* Automatic refresh of voucher list after successful generation

---

## Tech Stack

### Backend

* PHP 8.x
* Laravel
* SQLite

### Frontend

* React.js
* Vite
* Axios

---

## Project Structure

```
backend/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   ├── Models/
│   ├── Services/
│   │   ├── SeatGeneratorService.php
│   └── ...
│
├── routes/
│   └── api.php
│
└── database/
    └── database.sqlite

frontend/
│
├── src/
│   ├── App.jsx
│   └── App.css
│
└── package.json
```

---

## API Endpoints

### Check Existing Voucher

**POST**

```
/api/check
```

Request

```json
{
    "flight_number": "GA101",
    "flight_date": "2026-07-01"
}
```

Response
```json
{
    "has_assigned_vouchers": false
}
```

---

### Generate Voucher

**POST**

```
/api/generate
```

Request
```json
{
    "crew_name": "John Doe",
    "crew_id": "EMP001",
    "flight_number": "GA101",
    "flight_date": "2026-07-01",
    "aircraft_type": "ATR"
}
```

Response
```json
{
    "seat1": "12A",
    "seat2": "12B",
    "seat3": "12C"
}
```

---

### Get All Vouchers

**GET**

```
/api/passengers
```

Response
```json
[
    {
        "id": 1,
        "crew_name": "John Doe",
        "crew_id": "EMP001",
        "flight_number": "GA101",
        "flight_date": "2026-07-01",
        "aircraft_type": "ATR",
        "seat1": "12A",
        "seat2": "12B",
        "seat3": "12C"
    }
]
```

---

## Installation

### Clone the repository

```
git clone <repository-url>
```

---

### Backend

Navigate to the backend folder.
```
cd backend
```

Install dependencies.
```
composer install
```

Copy the environment file.
```
.env
```

Generate the application key.
```
php artisan key:generate
```

Run migrations.
```
php artisan migrate
```
There will be prompt to create sqlite database
```
yes
```

Start the Laravel server.
```
php artisan serve
```

The API will be available at:
```
http://127.0.0.1:8000
```

---

### Frontend

Navigate to the frontend folder.
```
cd frontend
```

Install dependencies.
```
npm install
```

Start the development server.
```
npm run dev
```

The frontend will be available at:
```
http://localhost:5173
```

## Author

Created as a technical assessment project demonstrating full-stack web development using Laravel, React, and SQLite.
