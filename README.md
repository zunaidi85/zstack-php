![Version](https://img.shields.io/github/v/release/zunaidi85/zstack-php)
![License](https://img.shields.io/github/license/zunaidi85/zstack-php)
![PHP](https://img.shields.io/badge/PHP-8%2B-blue)

# zstack-php

**Z-Stack** is a minimal PHP framework for solo developers who want full control, predictable flow, and zero magic.

> Simple. Fast. No Nonsense.
Build software, not abstractions.

Z-Stack is built with an **AI-first workflow** in mind — *solo developer + AI*.

## Why Z-Stack

- Built for clarity, not abstraction
- Designed for AI-assisted solo development
- Secure defaults without heavy configuration
- Explicit code flow you can reason about
- No magic, no vendor lock-in

## Requirements
- PHP 8.0+
- Apache (recommended) or Nginx
- URL rewrite enabled

## Quick Start
```bash
git clone https://github.com/zunaidi85/zstack-php.git
cd zstack-php
Create a `.env` file if needed.
```

Point your web root to the `public/` directory, then open `/` in the browser.

### Demo routes
- `/` — Home
- `/login` — Login page (requires DB)
- `/api/ping` — JSON ping
- `/robots.txt` — Robots
- `/sitemap.xml` — Minimal sitemap

## Demo Login (optional)
1) Create a database and set credentials in `.env`:
- `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`

2) Run schema and seed:
- `database/schema.sql`
- `database/seed.sql`

3) Login with:
- Email: `test@example.com`
- Password: `secret123`

## Project Structure
- `public/` entry point (`index.php`)
- `routes/` route tables (`web.php`, `api.php`)
- `controllers/` request handlers
- `models/` data access (PDO)
- `views/` layouts & pages
- `app/` framework core (bootstrap, security, helpers)
- `storage/` logs, cache, sessions

## Security
- Secure session cookie flags
- CSRF protection for POST forms
- Security headers enabled
- Uploads folder blocks script execution

## License
MIT
