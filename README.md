# CMS V2 - Backend API Berita

Backend API untuk sistem manajemen berita (CMS) menggunakan Laravel 12.

## 🚀 Features

- Authentication (Register, Login, Logout) menggunakan Laravel Sanctum
- CRUD Category
- CRUD News
- Upload Gambar Berita
- Relasi News ke Category
- RESTful API
- JSON Response

---

## 🛠 Tech Stack

- Laravel 12
- PHP 8.2+
- MySQL
- Laravel Sanctum
- REST API

---

## 📂 API Endpoints

### 📁 Categories

| Method | Endpoint                | Description |
|--------|------------------------|------------|
| GET    | /api/categories        | Get all categories |
| POST   | /api/categories        | Create category |
| GET    | /api/categories/{id}   | Show category |
| PUT    | /api/categories/{id}   | Update category |
| DELETE | /api/categories/{id}   | Delete category |

---

### 📰 News

| Method | Endpoint            | Description |
|--------|--------------------|------------|
| GET    | /api/news          | Get all news |
| POST   | /api/news          | Create news |
| GET    | /api/news/{id}     | Show news |
| PUT    | /api/news/{id}     | Update news |
| DELETE | /api/news/{id}     | Delete news |

---

## 📦 Installation

```bash
git clone https://github.com/RizFad/cms-v2.git
cd cms-v2
composer install
cp .env.example .env
php artisan key:generate


link server: https://cms.poltekad-elektro.my.id/api/