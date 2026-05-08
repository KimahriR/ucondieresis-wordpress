# Documentation Standard

## Purpose

This document defines how project documentation should be created, organized, named, and maintained.

Its goal is simple:
- Reduce the need to read the entire codebase just to understand intent
- Make project knowledge easier to navigate
- Keep documentation structured, useful, and fast to scan
- Prevent the repository from filling up with disconnected markdown files

Documentation should help people think faster, decide faster, and implement faster.

## Core Principle

Code is the source of execution.

Documentation is the source of orientation.

A good `.md` file should answer at least one of these questions clearly:
- What is this project trying to do?
- How is it structured?
- How should we work on it?
- How should it look or sound?
- How do we validate it?
- How do we troubleshoot it?

If a document does not improve orientation, it probably does not need to exist in its current form.

## Documentation Layers

### Root

Root should stay minimal.

Only essential entrypoint files should live in the repository root.

In this project, that generally means:
- `README.md`

Avoid adding new standalone `.md` files in root unless they are truly project-entrypoint material.

### `docs/`

This folder contains the main living documentation.

These files describe the current source of truth for the project:
- Context
- Architecture
- Workflow
- Design
- Content
- Troubleshooting
- Status

If a document describes how the project should currently be understood, it probably belongs here.

### `docs/guides/`

This folder contains operational and practical guides.

Use it for:
- Step-by-step walkthroughs
- Checklists
- Setup instructions
- Validation procedures
- Deployment-oriented guides

Guides are more procedural than conceptual.

### `docs/archive/`

This folder contains historical or reference material that should be preserved but is no longer the main source of truth.

Use it for:
- Old audits
- Historical snapshots
- Previous summaries
- Deprecated operational notes
- Legacy client-facing docs

Archive is for traceability, not for day-to-day guidance.

## When to Create a New Document

Create a new `.md` when:
- The topic is important enough to be reused
- The information is too large for an existing file
- The topic has a distinct purpose
- The content will help future work go faster
- The content cannot be represented cleanly as a short comment in code

Do not create a new document when:
- The information belongs naturally inside an existing doc
- It is only a one-off note
- It duplicates another file without adding structure
- It is just raw output or a dump of observations

## Preferred Document Types

Common documentation types in this project:
- Context docs
- Architecture docs
- Workflow docs
- Design docs
- Content/copy docs
- Troubleshooting docs
- Setup or verification guides
- Historical archive docs

Try to fit new documentation into one of these patterns before inventing a new category.

## Naming Rules

Use uppercase snake case for major project docs when that is already the project pattern:
- `PROJECT_CONTEXT.md`
- `DEVELOPMENT_WORKFLOW.md`
- `DESIGN_SYSTEM.md`

Use descriptive names.

Prefer:
- `TROUBLESHOOTING.md`
- `CONTENT_GUIDELINES.md`
- `DOCUMENTATION_STANDARD.md`

Avoid vague names like:
- `NOTES.md`
- `INFO.md`
- `MISC.md`
- `THINGS_TO_DO.md`

Names should communicate purpose immediately.

## Writing Style

Documentation should be:
- Clear
- Structured
- Scannable
- Specific
- Reusable

Prefer:
- Short sections
- Clear headings
- Lists when helpful
- High-signal wording
- Stable language over temporary phrasing

Avoid:
- Giant walls of text
- Overexplaining obvious things
- Excessive decoration
- Mixed purposes inside one file
- Status language that will age in a few days unless the file is explicitly historical

## What Makes a Good Project Doc

A strong project document usually has:
- A clear purpose
- A clear audience
- A clear scope
- A stable structure
- Useful constraints or guidance

It should help answer:
- What is this for?
- When should I use it?
- What decisions does it help me make?

## What Makes a Bad Project Doc

A weak document usually:
- Duplicates another file
- Mixes history, process, and architecture in one place
- Uses unclear titles
- Goes stale quickly
- Contains details that belong in code or issue tracking instead

If a doc becomes noisy, either:
- simplify it
- split it
- move it to `archive/`

## Update Rules

Update documentation when:
- Architecture changes
- Workflow changes
- Visual direction changes
- Content or brand direction changes
- Troubleshooting knowledge becomes repeatable
- A guide no longer reflects reality

Do not wait for documentation to become “perfect” before updating it.

Prefer small, steady improvements.

## Source of Truth Rules

Use living docs for current project understanding.

Use guides for procedures.

Use archive for history.

When information appears in multiple places:
- Keep one place as the main source of truth
- Let the others reference it
- Avoid maintaining the same idea in many files unless necessary

## Documentation Review Checklist

Before keeping or creating a `.md`, ask:
- Does this file have one clear job?
- Is it in the right folder?
- Does its title clearly describe its purpose?
- Does it duplicate another doc?
- Is it still current?
- Is it easy to scan?
- Would this help someone avoid reading a large amount of code?

If the answer to the last question is no, improve or relocate it.

## Project-Specific Rule

This project values documentation because it speeds up understanding and reduces unnecessary code spelunking.

That means:
- We document intent, structure, and decision-making
- We do not document for decoration
- We organize markdown files deliberately
- We keep the root clean
- We treat documentation as part of the product workflow, not as an afterthought

## Final Standard

The ideal documentation system should feel like:
- A map, not a pile
- A guide, not a diary
- A working tool, not a museum

If a new document makes the project easier to understand and easier to work on, it belongs.

If it only adds noise, it should be rewritten, moved, or not created.
