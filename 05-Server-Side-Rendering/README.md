<p align="center">
    <img src="https://luxid.dev/lion5.svg" width="120" alt="Luxid Logo">
</p>

## About Luxid

**Luxid** is a lightweight, modern PHP framework designed with simplicity and speed in mind.
Built for developers who want full control over their application architecture, Luxid provides a clean routing system, a flexible screen rendering engine, and an elegant structure for building powerful applications in a custom architecture called SEA [Screen(View) - Entities(Models) - Actions(Controllers)]

Luxid focuses on:

- Clear and expressive routing
- Simple and intuitive actions (controllers)
- A lightweight screen/template engine (`.nova.php`)
- Easy request/response handling
- Minimal setup, maximum flexibility

Luxid removes the unnecessary complexity of large frameworks and gives developers a clean, enjoyable development experience.

## Key Features

- **Fast routing engine** with support for GET/POST and callbacks
- **Action-based controllers** (cleaner than classical MVC)
- Simple `.nova.php` **screen rendering system**
- Framework-level request sanitization
- Extensible architecture
- Easily readable, elegant syntax
- Zero-dependency core (other than Composer autoloading)

Luxid is ideal for small-to-medium web apps, APIs, school management systems, dashboards, and learning modern PHP framework design.

---

## Installation

To get started with Luxid, follow these steps:

### 1. Create a new Luxid project via Composer
```bash
composer create-project luxid/framework my-app
cd my-app
```

### 2. Configure environment

- Edit `.env` to configure your database

```env
DB_DSN=mysql:host=127.0.0.1;port=3306;dbname=luxid
DB_USER=root
DB_PASSWORD=
```

You can find further instructions in the .env on how to configure your database credentials based on your Operating System.

- Create the database

```bash
php juice db:create
```

- Run migrations

```bash
php juice db:migrate
```

- Start the development server

```bash
php juice start
```

- After these steps, you can access your Luxid application at http://localhost:8080

---

## Learning Luxid

Luxid clear documentation [luxid.dev](https://www.luxid.dev) and is intentionally designed to be beginner-friendly for developers learning framework architecture.

You can explore:

- The `screens/` folder – UI screens
- The `app/actions/` folder – controllers
- `migrations/` folder - migrations

---

## Contributing

Thank you for your interest in contributing to Luxid!
A full contribution guide will be included in the documentation, but in general:

- Follow PSR-12 coding standards
- Submit PRs with clear descriptions
- Make sure your additions are tested and documented

---

## Security Vulnerabilities

If you discover a security issue within Luxid, please contact:

**Email:** jhay@luxid.dev

All vulnerabilities will be reviewed and patched promptly.

---

## License

Luxid is open-source software licensed under the **MIT License**.

