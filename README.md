# zstack-php

**Z-Stack** is a minimal PHP framework for solo developers who want full control, predictable flow, and zero magic.

> Simple. Fast. No Nonsense.

Z-Stack is built with an **AI-first workflow** in mind — *solo developer + AI*.

## Requirements
- PHP 8.0+
- Apache (recommended) or Nginx
- URL rewrite enabled

## Quick Start
```bash
git clone https://github.com/zunaidi85/zstack-php.git
cd zstack-php
cp .env.example .env
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
