# GitHub Repository


# Laravel Admin Blog Panel (Backend API + Admin)

A simple blog management system built with **Laravel** that exposes **Sanctum-protected REST APIs** and includes an **admin panel** (server-rendered) to manage blog posts and categories. The React app (client) consumes these APIs.

## Features
- Admin login (web panel) + Sanctum token-based API login endpoint.
- CRUD for **Posts** and **Categories**.
- Secure **admin-only** access for panel actions.
- REST API for React client:
  - `GET /api/posts`
  - `GET /api/posts/{id}`
  - `POST /api/posts`
  - `PUT /api/posts/{id}`
  - `DELETE /api/posts/{id}`
- 404 page for invalid routes.

---

## Prerequisites
- PHP 8.2+
- Composer
- MySQL (or MariaDB)
- Node.js 18+ (for the React client, separate)
- Git (recommended)

---

## Setup (one-time)
1. **Clone & install**
   ```bash
   git clone https://github.com/esamaran/blog_assign2
   cd blog_assign2   # (Laravel project folder)
   composer install
   cp .env.example .env
