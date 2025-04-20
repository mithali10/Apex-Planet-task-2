# Apex-Planet-task-2

# 📝 PHP Blog System with User Authentication

This is a basic blog web application built using PHP and MySQL. It includes user registration, login/logout, password hashing, session management, and a full CRUD interface to manage blog posts.

---

## 🚀 Features

- ✅ User Registration (with hashed passwords)
- ✅ Secure Login/Logout using PHP Sessions
- ✅ Add/Edit/Delete Blog Posts
- ✅ View List of All Posts
- ✅ Access control: only logged-in users can manage posts
- ✅ Simple and modular file structure

---

## 📂 File Structure

/project-root │ ├── register.php # Register a new user ├── login.php # Login form & logic ├── logout.php # Destroys session ├── dashboard.php # Protected page that includes add_post.php ├── add_post.php # Add, edit, delete, view posts (CRUD) ├── README.md # Project documentation └── db.sql


---

## 🛠️ Database Setup

Create a MySQL database and run the following:

```sql
CREATE DATABASE your_database_name;

USE your_database_name;

-- Users table
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Posts table
CREATE TABLE post (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

```

## How to Run 
- Place the project in the www/ or htdocs/ folder
- Start Apache and MySQL
- Visit http://localhost/your_project_folder/register.php to register a user
- Log in via login.php
- You’ll be redirected to dashboard.php which loads the post manager (add_post.php)

## Security Notes
- Passwords are hashed using password_hash()
- User sessions are protected and required to access the dashboard/post pages
- Uses htmlspecialchars() to prevent XSS

## Created by Mithali
