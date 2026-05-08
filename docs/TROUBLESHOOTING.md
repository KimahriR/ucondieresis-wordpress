# Troubleshooting

## Purpose

This document is a practical troubleshooting guide for common project issues.

Use it when:
- WordPress behaves unexpectedly
- Frontend sections do not render correctly
- WhatsApp CTAs stop working
- The custom plugin appears inactive or broken
- The local Docker environment is unstable

## Quick Triage

Before going deep, check these basics:

- Is Docker running?
- Is WordPress loading locally?
- Is the custom plugin active?
- Is the issue visible in both admin and frontend, or only one?
- Are there errors in `wp-content/debug.log`?
- Does the issue persist after a hard refresh?

## Common Issues

### Products menu does not appear in WordPress admin

Possible causes:
- The custom plugin is inactive
- WordPress did not refresh the registered CPTs correctly
- There is a PHP error blocking plugin execution

Check:
- `Plugins` in WordPress admin
- `wp-content/debug.log`

Try:
1. Activate `ucondieresis-custom`
2. Reload the admin
3. If needed, deactivate and reactivate the plugin
4. Review `debug.log` for PHP errors

### WhatsApp button does not open correctly

Possible causes:
- The configured number is invalid
- The generated URL is malformed
- The CTA markup or behavior was changed

Check:
- `wp-content/plugins/ucondieresis-custom/includes/config.php`
- The generated `wa.me` link

Validation rules:
- Use only digits
- Include country code
- Do not use `+`, spaces, or hyphens

Try:
1. Confirm the configured number format
2. Open a manual `https://wa.me/...` test URL in the browser
3. If the manual URL works, inspect the CTA output or JS behavior

### Products do not appear on the homepage or archive

Possible causes:
- No products exist
- Products are unpublished
- Homepage visibility settings are missing
- Taxonomy or query assumptions changed

Check:
- That at least one `productos` post exists
- That featured or homepage-related settings are enabled where expected
- That templates and helper queries still match the intended behavior

Try:
1. Open the product editor
2. Confirm the product is published
3. Confirm the expected taxonomy and featured settings are present
4. Reload the frontend and re-check

### Product images do not load

Possible causes:
- No featured image is assigned
- Media was not uploaded correctly
- Template output changed

Check:
- Featured image assignment in the product editor
- Media URLs in the rendered HTML

Try:
1. Reassign the featured image
2. Use a normal JPG or PNG asset
3. Reload the page and verify rendering again

### White screen, fatal error, or broken page

Possible causes:
- PHP syntax error
- Missing class or include
- Invalid template or plugin change

Check:
- `wp-content/debug.log`
- Recent edits in theme or plugin files

Try:
1. Read the latest log lines
2. Identify file and line number
3. If needed, temporarily deactivate the custom plugin to isolate the issue
4. Confirm whether the failure is theme-related, plugin-related, or environment-related

### Database connection error

Possible causes:
- Docker containers are down
- MySQL container failed
- Local environment is not fully started

Check:
- Docker container status
- WordPress and database containers

Try:
1. Run `docker-compose ps`
2. Start or restart the containers
3. Wait a few seconds and reload WordPress

## Useful Checks

### Local environment

```bash
docker-compose ps
docker-compose up -d
docker-compose restart
```

### WordPress CLI

```bash
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root core version
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root plugin list
docker exec ucondieresis-wordpress-wordpress-1 wp --allow-root post list --post_type=productos
```

### Logs

```bash
tail -20 wp-content/debug.log
docker logs ucondieresis-wordpress-wordpress-1 --tail 50
```

## Debugging Mindset

When troubleshooting:
- Isolate whether the issue is in theme, plugin, content, or environment
- Reproduce the issue consistently before changing multiple things
- Prefer one controlled change at a time
- Capture the exact error message before attempting broad fixes

## Escalation Guidelines

Escalate when:
- The issue involves repeated PHP errors you cannot isolate quickly
- The database or Docker environment is unstable
- The problem persists after validating plugin state, logs, and frontend behavior
- The issue affects core user flow such as product rendering or WhatsApp conversion

When escalating, include:
- Clear symptom description
- Steps to reproduce
- Relevant file or template involved
- Exact log output when available

## Notes

This document should stay practical and current.

If a troubleshooting pattern becomes common, add it here in a short reusable form instead of burying it in historical notes.
