# Architecture

## Overview

This project uses a modular custom WordPress architecture.

Main areas:

- `/wp-content/themes/ucondieresis/`
- `/wp-content/themes/ucondieresis/template-parts/`
- `/wp-content/themes/ucondieresis/assets/css/`
- `/wp-content/themes/ucondieresis/assets/js/`
- `/wp-content/plugins/ucondieresis-custom/`
- `/docs/`

## Theme Structure

The custom theme is responsible for layout, presentation, templates, and frontend behavior.

Main theme structure:

- `front-page.php`
- `functions.php`
- `template-parts/`
- `assets/css/`
- `assets/js/`

Guidelines:
- Keep `front-page.php` focused on composition
- Place reusable sections inside `template-parts/`
- Keep styles separated by feature or page
- Keep JavaScript modular and lightweight

## Homepage

The homepage is modularized using template parts loaded from `front-page.php`.

Current sections include:
- `hero.php`
- `featured.php`
- `how-to-buy.php`
- `cta.php`

Additional homepage sections should follow the same pattern.

## CSS Organization

CSS is organized by feature or page.

Examples:
- `home.css`
- `catalogos.css`
- `header.css`
- `footer.css`

Avoid:
- Monolithic CSS files
- Inline styles
- Duplicated rules across sections

## JavaScript

JavaScript should remain lightweight and focused on small UI behaviors.

Current use cases include:
- Hero animations
- Scroll-based effects
- Sticky header behavior
- Mobile menu interactions
- WhatsApp CTA interactions

Avoid:
- Heavy libraries
- Unnecessary dependencies
- Large all-in-one scripts

## Custom Post Types

### `productos`

Used for showroom products.

Templates:
- `archive-productos.php`
- `single-productos.php`

### `catalogo`

Used for downloadable PDF catalogs.

Templates:
- `archive-catalogo.php`

## Theme vs Plugin Responsibilities

Use the theme for:
- Layout
- Templates
- Visual components
- Frontend assets

Use the custom plugin for:
- Custom Post Types
- Taxonomies
- Shared business logic
- Shortcodes
- Reusable backend functionality

Avoid duplicating plugin responsibilities inside the theme.

## Reusability Philosophy

Prefer:
- Reusable sections
- Reusable cards
- Helper functions
- Shared patterns

Avoid duplicated markup and copy-paste structures.

## Naming Convention

Use clear, descriptive naming with a BEM-like approach when appropriate.

Examples:
- `hero__title`
- `catalog-card`
- `footer__links`

Avoid generic names like:
- `container2`
- `section-final`
- `style-new`

## Goal

The codebase should remain:
- Clean
- Scalable
- Maintainable
- Modular
