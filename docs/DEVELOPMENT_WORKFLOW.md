# Development Workflow

## General Approach

This project should evolve through small, reviewable, production-minded changes.

Prefer:
- Small focused edits
- Reusing existing patterns
- Updating documentation alongside important changes
- Testing in the local WordPress environment

Avoid:
- Large rewrites without a clear reason
- Introducing new dependencies unnecessarily
- Mixing business logic into presentation files

## Workflow Principles

When working on the project:
- Understand the existing structure before editing
- Extend the current theme and plugin architecture instead of replacing it
- Keep the codebase modular and easy to maintain
- Prefer reusable sections, helpers, and patterns
- Keep visual decisions aligned with the premium showroom direction

## Local Environment

Primary local setup:
- Docker
- WordPress local instance
- Theme: `ucondieresis`
- Plugin: `ucondieresis-custom`

Typical local flow:
- Start Docker
- Confirm WordPress is available locally
- Verify the custom plugin is active when needed
- Test changes in the browser before considering them complete

Key local areas:
- Frontend: `http://localhost:8000`
- Admin: `http://localhost:8000/wp-admin`

## Workflow Guidelines

When making changes:
- Understand the existing structure first
- Prefer extending current theme and plugin architecture
- Keep frontend assets modular
- Keep reusable sections inside `template-parts/`
- Enqueue new CSS and JS through `functions.php`

### Theme Changes

For theme work:
- Keep `front-page.php` focused on composition
- Add reusable homepage or shared sections in `template-parts/`
- Keep CSS separated by feature or page
- Keep JavaScript lightweight and isolated by behavior

### Plugin Changes

For plugin work:
- Keep CPTs, taxonomies, shortcodes, and shared business logic in `ucondieresis-custom`
- Avoid duplicating plugin responsibilities in the theme
- Prefer extending the existing plugin structure instead of adding parallel logic elsewhere

### Documentation Changes

Update documentation when:
- The architecture changes
- The working process changes
- A new important convention is introduced
- A current doc no longer reflects reality

## Validation Checklist

Before considering a change complete:
- Check the frontend visually
- Verify responsive behavior
- Confirm no hardcoded URLs were introduced
- Confirm dynamic output is escaped properly
- Confirm styles and scripts load in the correct context

Also verify when relevant:
- WhatsApp CTAs still behave correctly
- Archive and single templates still render as expected
- New assets only load where needed
- Motion remains subtle and respects `prefers-reduced-motion`

### Functional Validation Flow

For changes that affect content structure, CPTs, or user flow, validate the project at these levels:

- WordPress admin behavior
- Frontend rendering
- WhatsApp conversion flow
- Responsive behavior

### Admin Validation

When relevant, confirm:
- The custom plugin is active
- Custom Post Types appear correctly in admin
- Taxonomies are available and editable
- Product creation or editing works without PHP errors
- Featured or homepage-related product settings behave as expected

### Frontend Validation

When relevant, confirm:
- The homepage hero renders correctly
- Section order and composition still make sense
- Product archive pages load correctly
- Single product pages render key content blocks correctly
- Catalog pages still support the intended discovery and download flow

### Conversion Validation

When relevant, confirm:
- WhatsApp buttons still open the expected link
- The configured number is being used correctly
- Pre-filled WhatsApp messaging still matches the intended tone and use case
- CTA text remains aligned with the conversion-focused showroom model

### Smoke Test Mindset

For meaningful frontend or plugin changes, prefer a quick smoke test instead of assuming the change is safe.

A useful smoke test usually includes:
- Open homepage
- Open a product archive
- Open a single product
- Trigger at least one WhatsApp CTA
- Check mobile layout or responsive mode

## Git and Documentation

Prefer:
- Clear commits
- Focused changes
- Updating relevant documentation when architecture or workflow changes

Documentation should evolve together with the project.

## Definition of Done

A change is closer to complete when:
- The code follows the current architecture
- The UI is visually consistent with the brand direction
- The behavior is validated locally
- Documentation is updated if needed
- The change is small enough to understand and review easily
