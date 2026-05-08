# U con Diéresis - Copilot Instructions

## Documentation Awareness

Before creating new project documentation or suggesting new markdown files, align with:
- `docs/DOCUMENTATION_STANDARD.md`
- `docs/README.md`

Prefer extending the existing documentation system over creating isolated new `.md` files.

## Project Overview

This project is a custom WordPress build with a custom theme and a custom plugin.

The site is a premium visual showroom focused on:
- Products
- Catalog downloads
- WhatsApp conversion

This is NOT an e-commerce website.

Avoid:
- Cart systems
- Checkout flows
- Product pricing logic

Primary conversion channel:
- WhatsApp

## Architecture

### Theme Structure

Use modular architecture.

Current structure:

- `/template-parts/`
- `/assets/css/`
- `/assets/js/`
- `/wp-content/plugins/ucondieresis-custom/`

Keep:
- `front-page.php` clean
- Reusable sections inside `template-parts`
- CSS separated by feature/page

Example:
- `hero.php`
- `featured.php`
- `cta.php`

## Coding Standards

### WordPress Best Practices

Always:
- Escape output properly
- Use `esc_html()`
- Use `esc_url()`
- Use `esc_attr()` for attributes
- Use `wp_enqueue_style()`
- Use `wp_enqueue_script()`
- Use WordPress template functions and hooks before custom workarounds
- Use dynamic URLs and paths like `home_url()`, `get_template_directory_uri()`, and `get_template_directory()`
- Keep user-facing strings ready for translation with `__()` or `_e()` when appropriate

Avoid:
- Inline styles
- Duplicated logic
- Hardcoded URLs
- Hardcoded asset paths
- Directly printing unescaped dynamic content

### Theme Development Rules

- Keep `front-page.php` focused on composition, not large blocks of repeated markup
- Put reusable sections in `template-parts/`
- Add new CSS and JS files through `functions.php`
- Prefer extending existing files and patterns before creating new abstractions
- Keep business logic out of templates whenever possible

### JavaScript Rules

- Use vanilla JavaScript only
- Match the existing pattern of small self-contained scripts
- Prefer progressive enhancement
- Respect `prefers-reduced-motion`
- Avoid large dependencies or animation libraries

## Visual Design System

### Brand Style

The site should feel:
- Premium
- Minimal
- Elegant
- Modern

Avoid:
- Flashy animations
- Heavy shadows
- Generic e-commerce styles

## Colors

### Hero

Primary hero color:
- `#986EB9`

### Sections

Soft background:
- `#F4F2F7`

### Footer

Dark premium tone:
- `#1E1A24`

## Typography

### Fonts

Primary typography direction:
- Editorial serif display
- Script accent typography
- Clean sans-serif support text

Style direction:
- Serif + script combination
- Elegant
- Editorial feel

## UI & UX

### Buttons

Primary CTA:
- WhatsApp actions
- `Solicitar catálogo`
- `Consultar disponibilidad`

Avoid generic labels like:
- `Submit`
- `Buy now`

## Animations

Use:
- Subtle fade-in
- `translateY` animations
- Smooth transitions

Avoid:
- Overly flashy motion
- Large parallax effects

Respect:
- `prefers-reduced-motion`

## Responsive Design

Use:
- Mobile-first approach
- `clamp()` for typography
- CSS Grid and Flexbox

Ensure:
- Buttons stack properly on mobile
- Hero scales correctly

## Performance

Prioritize:
- Lightweight CSS
- Minimal JavaScript
- Optimized images
- Fast loading

Avoid:
- Heavy animation libraries
- Unnecessary dependencies

## Catalog Section

Catalogs are downloadable PDFs.

Structure:
- `archive-catalogo.php`
- Card-based layout
- Download CTA

Each catalog includes:
- Cover image
- Description
- PDF download button

## Development Philosophy

Maintain:
- Clean code
- Reusable components
- Modular organization
- Consistent naming

Code should feel handcrafted and premium, not template-generated.
