![Version](https://img.shields.io/github/v/release/zunaidi85/zstack-php)
![License](https://img.shields.io/github/license/zunaidi85/zstack-php)
![PHP](https://img.shields.io/badge/PHP-8%2B-blue)

# Z-Stack (zstack-php)

Z-Stack is a minimal PHP framework for solo developers who want full control, predictable flow, and zero magic.

Simple. Fast. No Nonsense.  
Build software, not abstractions.

Z-Stack is designed for an AI-assisted solo development workflow — where clarity, explicitness, and control matter more than conventions.

----------------------------------------------------------------

PHILOSOPHY

Z-Stack intentionally avoids:
- hidden conventions
- dependency injection containers
- magic bootstrapping
- vendor lock-in

What you see in the code is exactly what runs.

Z-Stack assumes:
You want to build real systems, not framework demos.

----------------------------------------------------------------

WHY Z-STACK

- Explicit request → response flow
- Secure defaults with minimal configuration
- Easy to reason about, easy for AI to assist
- No forced architecture
- No framework magic

Z-Stack stays out of your way.

----------------------------------------------------------------

REQUIREMENTS

- PHP 8.0+
- Any PHP-capable web server:
  - Apache
  - Nginx
  - PHP built-in development server
- URL rewrite enabled (Apache/Nginx only)

XAMPP is NOT required.

----------------------------------------------------------------

INSTALLATION

    git clone https://github.com/zunaidi85/zstack-php.git
    cd zstack-php

----------------------------------------------------------------

LOCAL DEVELOPMENT (NO APACHE / NO XAMPP)

Run Z-Stack using PHP built-in development server:

    php -S localhost:8000 -t public

Open in browser:

    http://localhost:8000

Suitable for:
- local development
- demos
- solo developer workflows

----------------------------------------------------------------

CONFIGURATION

Z-Stack configuration is explicit and optional.

OPTION 1 — .env FILE (OPTIONAL)

If a .env file exists in the project root, Z-Stack will load it automatically.

Example:

    APP_ENV=local
    APP_DEBUG=true
    DB_HOST=127.0.0.1
    DB_NAME=zstack_db
    DB_USER=root
    DB_PASS=
    DB_CHARSET=utf8mb4

If .env does not exist, Z-Stack continues using default configuration values.

OPTION 2 — LOCAL CONFIG OVERRIDE (RECOMMENDED)

Create a local-only configuration file:

    app/config.local.php

Example content:

    <?php
    return [
      'db' => [
        'host' => '127.0.0.1',
        'name' => 'zstack_db',
        'user' => 'root',
        'pass' => '',
        'charset' => 'utf8mb4',
      ],
    ];

This file MUST be ignored by Git and MUST NOT be committed.

----------------------------------------------------------------

DATABASE

Z-Stack uses PDO and does not impose a schema.

- Any SQL-compatible database supported by PDO may be used
- MySQL / MariaDB is commonly used
- Schema files are located in:

    /database

----------------------------------------------------------------

DEMO ROUTES

- /            Home
- /login       Login page (requires database)
- /api/ping    JSON ping
- /robots.txt  Robots file
- /sitemap.xml Minimal sitemap

----------------------------------------------------------------

DEMO LOGIN (OPTIONAL)

Demo authentication is provided for testing flow only.

SETUP

1. Create a database
2. Configure DB credentials using .env or config.local.php
3. Import schema and seed data:

    database/schema.sql
    database/seed.sql

DEMO CREDENTIALS

- Email: test@example.com
- Password: secret123

Demo login is NOT intended for production use.

----------------------------------------------------------------

PROJECT STRUCTURE

    public/        Entry point (index.php)
    routes/        Route tables (web.php, api.php)
    controllers/   Request handlers
    models/        Data access (PDO)
    views/         Layouts and pages
    app/           Framework core (bootstrap, helpers, security)
    storage/       Logs, cache, sessions
    database/      SQL schema and seed files

----------------------------------------------------------------

SECURITY DEFAULTS

Z-Stack ships with security ENABLED BY DEFAULT:

- Secure session cookie flags
- CSRF protection for POST forms
- Common security headers
- Uploads directory blocks script execution

Security is opt-out, not opt-in.

----------------------------------------------------------------

DEPLOYMENT NOTES

- Point web root to public/
- Use .env or server environment variables for secrets
- DO NOT deploy config.local.php to production
- Ensure storage/ is writable

----------------------------------------------------------------

WHAT Z-STACK IS NOT

Z-Stack is NOT:
- Laravel
- Symfony
- A CMS
- A code generator

Z-Stack is a TOOLBOX, not a cage.

----------------------------------------------------------------

LICENSE

MIT
