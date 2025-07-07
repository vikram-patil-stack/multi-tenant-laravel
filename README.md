# Multi-Tenant Laravel Boilerplate

A simple yet powerful multi-tenant application boilerplate for Laravel. Designed for SaaS or platforms where multiple clients (tenants) share the same codebase and database, but enjoy strict data isolation.

## 🚀 Features

- ✅ **Single Codebase & Database**: All tenants share the same code and DB, with robust tenant data isolation.
- ✅ **UUIDv7 Primary Keys**: A custom trait ensures all models use UUIDv7 as their primary key.
- ✅ **Dockerized Setup**: Rapid local development and deployment with Docker.
- ✅ **Tenant Middleware**: Protects all routes by checking if a tenant is registered before access.
- ✅ **Model Scoping by Tenant**: Models use a scope & trait to automatically add `tenant_id` to all queries and inserts.
- ✅ **Session-based Tenant Context**: Tenant ID is stored in the session for easy access, with helper functions for convenience.
- ✅ **Custom Tenant Registration Command**: Register a new tenant quickly with the `tenant:register` Artisan command.

## 🛠️ Tech Stack

- Laravel 12
- PHP 8.4
- Docker & Docker Compose
- MySQL
- UUIDv7 (via custom trait)

## Quick Start

### 1. Clone the repo

```bash
git clone https://github.com/vikram-patil-stack/multi-tenant-laravel.git
cd multi-tenant-laravel
```

### 2. Setup with Docker

```bash
cp .env.example .env
docker-compose up -d
docker exec -it <app-container> composer install
docker exec -it <app-container> php artisan migrate
```

### 3. Register Your First Tenant

```bash
docker exec -it <app-container> php artisan tenant:register
Enter the domain name for the tenant:
 > dev.local.com
```

### 4. Access the App

Visit `http://localhost` in your browser. Routes are protected by tenant middleware.

## How It Works

- **Tenant Identification**: Middleware checks for a valid registered tenant before allowing access to routes.
- **Model Scoping**: Every model using the provided `HasTenantScope` trait automatically includes `tenant_id` in insert and query operations.
- **UUIDv7**: All primary IDs are generated as UUIDv7 for scalability and uniqueness.
- **Session-Based Context**: The current `tenant_id` is stored in the session and can be quickly retrieved using provided helpers.

## Project Structure

- `app/Traits/Uuid7.php` — Trait for UUIDv7 primary keys.
- `app/Traits/HasTenantScope.php` — Trait for model-level tenant scoping.
- `app/Models/Scope/TenantScope.php` — Scope file for query-level scoping.
- `app/Http/Middleware/ValidateDomain.php` — Middleware to guard routes.
- `app/Helpers/Tenant/TenantSession.php` — Helper functions for tenant context.
- `app/Console/Commands/RegisterTenant.php` — Artisan command to register new tenants.
- `docker-compose.yml` — Docker setup for local development.

## Contributing

Feel free to fork, submit issues, or pull requests! Contributions are welcome.

## License

This project is open source.

---

**Author:** [vikram-patil-stack](https://github.com/vikram-patil-stack)
