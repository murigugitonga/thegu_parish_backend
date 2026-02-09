# Thegu Parish Management System

This is a secure role-based parish management system designed to support administrative
workflows such as member management, financial contributions & role based operations.

This system follows a decoupled architecture with a dedicated **react+tailwind frontend ecosystem**
and features a super-admin dashboard with task-focued PWA's for minor administrators.

---

## Project Vision

The goal behind the development system is to provide:

- A **Single source of truth** for parish data.
- **Strong access control** via roles & permissions.
- **Task-oriented interfaces** for abstract administration.
- A scalable robust foundation for parish digital services.

This project embraces an enteprise-grade architecture with separation of concerns (for easier maintanance),
centralized authorization and auditability.

---

## System Architecture

### Backend

- **Laravel 12**
- Restful APIs.
- Authentication via **Laravel Sanctum**.
- RBAC via **Spatie Laravel** permissions package.
- MySQL database.

### Frontend Ecosystem
- **Super Admin Dashboard** (React + Tailwind)
- **Members & Resource management** (React PWA)
- **Financial Funds Management** (React PWA)
- Shared frontend utilities (auth, API client, permissions)

The entire frontend ecosystem communicates with the same Laravel API.

## Authentication & Authorization Model

- Single authentication system for all admins
- **Super Admin**
    - Full System access
    - Manages users, roles and permissions
- **Minor Admins**
    - Restricted access based on assigned permissions
    - Access via lightweight PWAs

> All authorization rules are enforced on the **server-side**.
> Frontend permission checks are restricted to UX features only.

## Roles & Permissions (RBAC)

The system employs a granular permission model:
- `members.CRUD`
- `resources.CRUD`

Roles, by definition in the laravel usecase, are collections of permissions and can be modified at runtime by the Super admin.

## Styling
- Tailwindcss **v4**
- CSS-first configuration
- Vite-powered asset-building.

---
## Local Development Setup

### Requirements
- PHP 8.2+
- Composer 
- Node.js 20+
- Apache & MySQL (ideally use Xampp for windows OS setup)

### Backend Setup

To scaffold and run this project:

```bash
composer install
cp .env.example .env
php artisan key:generate

```
Create a MySQL database.
update the environment file with the database credentials.

### Assets Bundling

Laravel comes wih vite bundled as a default. You will need node.js (ideally v20+ to run this project).

```bash
npm install
npm run dev
```

### Running the server
```bash
php artisan serve

```

That is it. Should be good to go.