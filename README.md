# 🔐 Secure Authentication System

## 📌 Overview

This project is a secure authentication system developed as part of the **Data Integrity and Authentication** course.
It implements real-world security practices including password hashing, Two-Factor Authentication (2FA), token-based authentication, and role-based access control (RBAC).

---

## 🎯 Features

* User Registration & Login
* Password Hashing (secure storage)
* Two-Factor Authentication (2FA) using authenticator apps
* Token-Based Authentication (JWT)
* Role-Based Access Control (Admin, Manager, User)
* Protected Routes
* Clean and Modular Code Structure

---

## 🛠️ Technologies Used

* **Backend:** Node.js, Express
* **Database:** MySQL (via XAMPP)
* **Security Libraries:**

  * bcrypt (password hashing)
  * jsonwebtoken (JWT)
  * speakeasy (2FA)
  * qrcode (QR code generation)

---

## 📁 Project Structure

```
project/
│
├── controllers/
├── middleware/
├── routes/
├── services/
├── models/
├── config/
│
├── app.js
└── server.js
```

---

## 🧠 System Flow

1. User registers
2. Password is hashed and stored in the database
3. 2FA secret is generated
4. QR code is displayed
5. User scans QR code using authenticator app
6. User logs in with email and password
7. User enters 2FA code
8. System verifies credentials and 2FA
9. JWT token is generated
10. User accesses protected routes using token
11. Access is controlled based on user role

---

## 🔐 Authentication Process

### 1. Registration

* User provides name, email, password, and role
* Password is hashed before storing

### 2. Login

* User enters email and password
* If valid → proceeds to 2FA verification

### 3. Two-Factor Authentication

* A secret key is generated per user
* QR code is scanned via an authenticator app
* User enters a 6-digit OTP
* System verifies OTP

### 4. Token Generation

* JWT token is generated after successful 2FA
* Token contains:

  * user ID
  * role

---

## 🛡️ Security Features

### Password Hashing

* Passwords are stored using hashing (bcrypt)

### JWT Authentication

* Tokens are required for protected routes
* Invalid or missing tokens are rejected

### Role-Based Access Control

* Admin → `/admin`
* Manager → `/manager`
* User → `/user`

Unauthorized access is blocked.

---

## 🔌 API Endpoints

### Auth Routes

* `POST /register`
* `POST /login`
* `POST /verify-2fa`

### Protected Routes

* `GET /dashboard`
* `GET /admin` (Admin only)
* `GET /manager` (Manager only)
* `GET /user` (User only)

---

## 🗄️ Database Schema

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,
    twofa_secret VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## ⚙️ Setup Instructions

### 1. Clone the repository

```
git clone <your-repo-link>
cd project
```

### 2. Install dependencies

```
npm install
```

### 3. Configure database

* Start XAMPP (MySQL)
* Create a database (e.g., `auth_system`)
* Run the SQL schema above

### 4. Run the server

```
node server.js
```

---

## 🧪 Testing the System

You should be able to:

* Register a new user
* Verify password is hashed in database
* Scan QR code using authenticator app
* Login using password + 2FA
* Receive a JWT token
* Access protected routes using the token
* Verify role-based access restrictions

---

## 📂 Git & Version Control

* Project is managed using Git
* Multiple commits were made during development
* Repository is hosted on GitHub

---

## 👥 Team Members

* Student 1: Backend & Authentication Core
* Student 2: Security, 2FA, and Access Control

---

## 📌 Notes

* This project follows clean code practices
* Code is modular and easy to maintain
* Designed to simulate real-world authentication systems

---

## 🚀 Future Improvements

* Add refresh tokens
* Implement frontend UI (React)
* Add email verification
* Deploy system online

---
