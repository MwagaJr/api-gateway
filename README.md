# API Gateway

A centralized API Gateway for authentication, request routing, and role-based access control across multiple integrated systems.

---

## 🚀 Overview

This project acts as a middleware layer between clients and backend services.  
It provides:

- Centralized authentication
- Role-based access control (RBAC)
- Request forwarding to backend services
- Multi-system integration support
- Scalable architecture for microservices

---

## 📁 Project Structure
api-gateway/
│
├── gateway-backend/ # API Gateway backend service
├── gateway-frontend-react/ # React frontend (Vite)
└── README.md


---

## 🛠 Technologies Used

### Backend
- Laravel 
- REST API
- MySQL / PostgreSQL

### Frontend
- React
- Vite
- Axios
- Modern ES6+

---

## 🔐 Features

- User Authentication
- Role-Based System Access
- Single Sign-On (SSO) Ready
- Secure API Routing
- Multi-system Dashboard
- Token-based Authorization

---

## ⚙️ Installation

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/MwagaJr/api-gateway.git
cd api-gateway
2️⃣ Backend Setup
cd gateway-backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
3️⃣ Frontend Setup
cd gateway-frontend-react
npm install
npm run dev
🌍 Architecture

Client → API Gateway → Multiple Backend Services

The gateway handles:

Authentication

Authorization

Request validation

Routing to appropriate services

🔒 Security

Token-based authentication

Role-based access control

Centralized access validation

Secure inter-service communication

📌 Future Improvements

OAuth2 / OpenID Connect support

Rate limiting

API monitoring

Logging & analytics dashboard

Docker support

👤 Author

Alex Mwaga
alexmwaga17@gmail.com
