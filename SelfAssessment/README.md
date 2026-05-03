# CAST Clinical — Project Notes

## What this is
A mockup single-page web app for a personalised 4-week mental health and wellbeing program.  
Built with plain HTML, CSS, and vanilla JavaScript. No frameworks, no build tools.  
Hosted on GitHub Pages: https://fireflyxserenity.github.io/castclinical/

---

## Files
| File | Purpose |
|---|---|
| `index.html` | Landing page (entry point) |
| `app.html` | Triage form + plan generator |
| `style.css` | Shared styles (logo, theme toggle, reset) |
| `landing.css` | Landing page styles |
| `app.css` | App/form styles |

---

## Fixed on GitHub Pages (mockup-safe)
- Dark mode flash (FOUC) — inline script restores theme before first paint
- SEO meta descriptions + Open Graph tags on both pages
- 4-week program overview — dynamically generated from user responses
- Crisis safety banner — auto-shown for high-risk response combinations
- Certificate copy — accurate ("received a plan", not "completed" at triage)
- Parenting teaser — removed unverified provincial approval claim
- "Email to myself" button — mailto link pre-filled with plan summary
- "28+ Conditions Addressed" softened to "28+ Focus Areas"
- Mobile responsive — 4-week grid collapses to 2-column on phones

---

## Needs a Real Hosting Server

### Priority 1 — Core business (nothing works without these)
1. **Payment** — Stripe or Square checkout, invoicing, refund handling
2. **Backend email delivery** — send the full PDF plan to the user server-side (e.g. SendGrid, Resend). The current "Email to myself" is a mailto fallback only.
3. **Data persistence** — store triage responses in a database (for clinician review, user history, analytics)

### Priority 2 — Product completeness
4. **User accounts** — login, saved history, returning users ("continue where you left off")
5. **Week 2–4 interactive tracking** — daily check-ins, progress logging, streak/completion tracking
6. **Real AI personalisation** — replace the JS rule logic with GPT/Claude API generating genuinely unique plans per user

### Priority 3 — Clinical & legal
7. **Clinician portal** — separate view for practitioners to see referred client plans
8. **Privacy/compliance infrastructure** — HIPAA (US), PIPEDA (CA), Privacy Act 1988 (AU) compliant data handling, consent records, data deletion
9. **About/credentials page** — who runs CAST Clinical, qualifications, privacy policy, terms of service (required before charging money)

### Priority 4 — Growth
10. **Analytics** — track funnel drop-off, which conditions are most common, completion rates
11. **Referral/clinician onboarding** — GP/therapist referral links, white-label options
12. **Parenting Certificate pathway** — implement once the program content is ready and any required approvals are in place

---

## Tech stack recommendation (when ready to build properly)
- **Frontend:** Keep the existing HTML/CSS/JS or migrate to Next.js for server-side rendering and auth
- **Backend:** Node.js (Express) or Python (FastAPI) — or a BaaS like Supabase/Firebase for rapid MVP
- **Email:** Resend or SendGrid
- **Payments:** Stripe
- **Auth:** Supabase Auth, Clerk, or Auth0
- **Database:** PostgreSQL (via Supabase) for structured triage data
- **AI:** OpenAI API (GPT-4o) or Anthropic (Claude) for plan generation
- **Hosting:** Vercel (frontend) + Supabase (backend/db) is the fastest path to a working product
