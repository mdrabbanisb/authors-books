# 📚 Book & Author Management System (Laravel)

## 🚀 Project Overview

This is a simple Laravel-based backend system to manage **Authors** and their **Books**.
It includes CRUD operations, relationships, authentication, and role-based access (Admin/User).

---

## 🛠️ Tech Stack

* Laravel
* PHP
* MySQL
* Bootstrap

---

## ⚙️ Setup Instructions

1. **Clone the repository**

```
git clone https://github.com/mdrabbanisb/authors-books.git
cd authors-books
```

2. **Install dependencies**

```
composer install
```

3. **Setup environment file**

```
cp .env.example .env
```

4. **Generate application key**

```
php artisan key:generate
```

5. **Configure database**
   Update `.env` file:

```
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```


7. **Start the server**

```
php artisan serve
```

👉 Open in browser:

```
http://127.0.0.1:8000
```


## 📌 Features

### 🔹 Frontend

* View all books
* View book details
* View authors list

### 🔹 Admin Panel

* Manage Authors (CRUD)
* Manage Books (CRUD)

### 🔹 Authentication

* User Registration & Login
* Role-based access (Admin/User)

### 🔹 Database

* One-to-Many Relationship:

  * One Author → Many Books

---

## 📂 Folder Structure Highlights

* `app/Models` → Eloquent Models
* `app/Http/Controllers` → Controllers
* `database/seeders` → Sample data
* `resources/views` → Blade templates
* `routes/web.php` → Routes

---

## 💡 Notes

* Default image is used for seeded books
* Ensure folder exists:

```
public/images/covers
```

---



---

## ✅ Assignment Completed

✔ CRUD operations
✔ Proper relationships
✔ Validation
✔ Clean code structure
✔ Ready to run

---
