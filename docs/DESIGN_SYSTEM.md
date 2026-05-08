# Design System

## Visual Direction

The site should feel:
- Premium
- Minimal
- Elegant
- Modern
- Handcrafted
- Editorial

Avoid:
- Flashy effects
- Heavy shadows
- Generic e-commerce aesthetics
- Over-designed luxury tropes

## Experience Goal

The interface should feel like a curated showroom, not an online store.

Users should feel invited to:
- Explore
- Discover products visually
- Download catalogs
- Start a WhatsApp conversation naturally

The design should support conversion through clarity, trust, and warmth.

## Experience Flow

The visual experience should guide users through a clear progression:
- Attraction through a strong hero
- Discovery through products, occasions, or inspiration
- Trust-building through brand presentation and process clarity
- Action through contact and WhatsApp-driven CTAs

The homepage should feel like a designed narrative, not a stack of unrelated sections.

## Core Colors

### Hero

Primary hero color:
- `#986EB9`

Related accent tones currently present in the UI:
- `#AB3DF5`
- `rgb(115, 0, 153)`

### Soft Section Background

- `#F4F2F7`

Neutral text baseline:
- `#1A1A1A`
- `#6B7280`

### Footer

Dark premium tone:
- `#1E1A24`

Note:
- Some current UI areas still use purple-led footer and accent treatments.
- The system should evolve consistently instead of mixing unrelated palettes.

## Typography

Primary directions:
- `Playfair Display`
- Script accent typography where appropriate
- Clean sans-serif support for navigation and utility text

Style goals:
- Editorial feel
- Serif-led hierarchy
- Refined premium presentation
- High contrast between expressive headings and clean UI text

Typography should balance:
- Emotion in headlines
- Clarity in body copy
- Restraint in navigation and interface elements

## UI Principles

Use:
- Clean spacing
- Strong hierarchy
- Elegant CTA treatments
- Mobile-first layouts
- Clear section separation
- High readability
- Conversion-focused content flow

Prefer:
- CSS Grid and Flexbox
- `clamp()` for typography
- Subtle transitions
- Modular section-based styling

Avoid:
- Crowded layouts
- Too many competing focal points
- UI patterns that feel like marketplace product grids unless intentionally used

## Motion

Use:
- Fade-in effects
- Gentle `translateY` movement
- Smooth transitions
- Staggered reveals only when they support hierarchy
- Lightweight motion tied to interaction or section entry

Respect:
- `prefers-reduced-motion`

Avoid:
- Excessive animation
- Parallax-heavy effects
- Decorative motion without UX value

## Layout Language

The layout system should favor:
- Wide breathing room
- Strong section rhythm
- Modular homepage composition
- Balanced text-to-image relationships

The homepage should feel composed in sections, not like a long generic landing page.

Typical homepage rhythm should support:
- Hero introduction
- Occasion or category exploration
- Inspiration or featured content
- Brand or presentation content
- Simple process explanation
- Contact and CTA closure

## Components

Primary component patterns include:
- Hero section
- Occasion or category cards
- Featured product cards
- Inspiration cards or visual gallery modules
- Catalog cards
- Brand presentation blocks
- Simple process or how-to-buy sections
- CTA blocks
- Header navigation
- Footer navigation and social links

Each component should feel:
- Reusable
- Intentional
- Visually light
- Consistent with the overall brand direction

## CTA Style

Primary CTAs should support the business model:
- `Solicitar catálogo`
- `Consultar disponibilidad`
- WhatsApp-driven actions

CTA design should feel:
- Clear
- Premium
- Warm
- Direct without sounding aggressive

Avoid generic commerce labels such as:
- `Buy now`
- `Add to cart`
- `Checkout`

## Responsive Design

The system is mobile-first.

Always ensure:
- Text scales cleanly across breakpoints
- Buttons remain easy to tap
- Header behavior stays usable on small screens
- Grids collapse gracefully
- Visual rhythm is preserved on mobile, tablet, and desktop

Typical layout behavior:
- Desktop: more breathing room, 2-3 column sections where appropriate
- Tablet: reduced spacing, simplified grids, preserved hierarchy
- Mobile: stacked sections, single-column emphasis, tappable CTAs and menus

## Implementation Notes

When applying this design system:
- Keep styles separated by section or feature
- Reuse established spacing and naming patterns
- Prefer subtle depth and contrast over heavy effects
- Let color and typography carry most of the premium feel
- Keep interactions fast and lightweight

## Notes from Existing UI Direction

Patterns already present in the project that should remain coherent:
- Fixed header with state changes on scroll
- Tall hero with premium typography and subtle background treatment
- Scroll-based reveal animations used sparingly
- WhatsApp as a persistent or highly visible action path
- Section-based one-page storytelling
