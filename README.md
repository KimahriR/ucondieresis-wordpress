# U con Diéresis

Custom WordPress build for a premium visual showroom focused on personalized products, catalog discovery, and WhatsApp conversion.

This is not a traditional e-commerce site.

The project is built around:
- Personalized products
- Downloadable PDF catalogs
- Direct WhatsApp contact
- A premium, editorial, mobile-first experience

## Project Overview

U con Diéresis is designed as a visual showroom rather than a store.

The expected user flow is:
- Discover the brand
- Explore products and inspiration
- Download a catalog
- Start a WhatsApp conversation

Avoid treating this project like a cart or checkout-based commerce site.

## Tech Stack

- WordPress 6.x
- PHP 8.x
- MySQL 8
- Docker
- Custom theme: `wp-content/themes/ucondieresis`
- Custom plugin: `wp-content/plugins/ucondieresis-custom`
- Vanilla JavaScript
- Plain CSS

## Local Setup

### Requirements

- Docker
- Docker Compose

### Start the project

```bash
cd "/Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-wordpress"
docker-compose up -d
```

### Local access

- Frontend: `http://localhost:8000`
- Admin: `http://localhost:8000/wp-admin`

## Project Structure

```text
ucondieresis-wordpress/
├── .github/
│   └── copilot-instructions.md
├── docs/
│   ├── README.md
│   ├── PROJECT_CONTEXT.md
│   ├── ARCHITECTURE.md
│   ├── DEVELOPMENT_WORKFLOW.md
│   ├── CONTENT_GUIDELINES.md
│   ├── DESIGN_SYSTEM.md
│   ├── TROUBLESHOOTING.md
│   ├── STATUS.md
│   ├── guides/
│   └── archive/
├── wp-content/
│   ├── plugins/
│   │   └── ucondieresis-custom/
│   └── themes/
│       └── ucondieresis/
├── docker-compose.yml
└── README.md
```

## Theme and Plugin Responsibilities

Use the theme for:
- Layout
- Templates
- Visual components
- Frontend assets

Use the plugin for:
- Custom Post Types
- Taxonomies
- Shared business logic
- WhatsApp-related utilities
- Shortcodes and reusable backend functionality

## Documentation

Core project documentation lives in `docs/`.

- [Documentation Map](docs/README.md)
- [Documentation Standard](docs/DOCUMENTATION_STANDARD.md)
- [Project Context](docs/PROJECT_CONTEXT.md)
- [Architecture](docs/ARCHITECTURE.md)
- [Development Workflow](docs/DEVELOPMENT_WORKFLOW.md)
- [Content Guidelines](docs/CONTENT_GUIDELINES.md)
- [Design System](docs/DESIGN_SYSTEM.md)
- [Troubleshooting](docs/TROUBLESHOOTING.md)
- [Status](docs/STATUS.md)

GitHub Copilot guidance lives here:

- [.github/copilot-instructions.md](.github/copilot-instructions.md)

Operational guides and historical reference files now live inside:

- `docs/guides/`
- `docs/archive/`

## Useful Commands

### Docker

```bash
docker-compose up -d
docker-compose down
docker-compose ps
```

### WordPress CLI

```bash
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root plugin list
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root post list --post_type=productos
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root option get siteurl
```

## Working Principles

- Keep changes small and reviewable
- Reuse existing theme and plugin patterns
- Keep `front-page.php` focused on composition
- Use `template-parts/` for reusable sections
- Enqueue CSS and JS through `functions.php`
- Keep documentation current as the project evolves
- Keep the repository root minimal and avoid adding non-essential `.md` files there

## Current Direction

The codebase should continue evolving as:
- A modular custom WordPress build
- A premium showroom experience
- A lightweight and maintainable frontend
- A WhatsApp-first conversion flow
