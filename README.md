# Dr Sujay J — Cardiac Surgeon Website

Public marketing site + blog engine + Filament admin dashboard for a cardiac /
cardiothoracic surgeon.

**Production domain:** [drsujayj.in](https://drsujayj.in)

**Stack:** Laravel 12 · Filament 3 · Livewire 3 · Blade (server-rendered public
site) · **SQLite** (WAL mode) · deployed on CloudPanel.

> **Status:** Phase 1 (Foundation) scaffolded. This repo currently contains the
> application skeleton, database migrations, Eloquent models, and the Filament
> admin panel provider. Dependencies are **not** installed yet — run the setup
> below. Filament *resources* (the admin CRUD screens) are generated locally via
> artisan, see [step 6](#6-generate-the-filament-admin-resources).

---

## Requirements

- PHP **8.2+** (with `pdo_sqlite`, `mbstring`, `intl`, `gd` or `imagick` for image uploads)
- [Composer](https://getcomposer.org/)
- Node.js 18+ (only needed once Vite/asset compilation is added in Phase 2)

## Setup

### 1. Install dependencies
```bash
composer install
```

### 2. Environment
```bash
cp .env.example .env          # Windows: copy .env.example .env
php artisan key:generate
```

### 3. Create the SQLite database file
```bash
# macOS / Linux
touch database/database.sqlite

# Windows (PowerShell)
New-Item database/database.sqlite -ItemType File
```
The `.sqlite` file is git-ignored — it is the data store, not source. WAL journal
mode and a 5s busy timeout are configured in `config/database.php`.

### 4. Migrate + seed
```bash
php artisan migrate --seed
```
Seeding creates an initial admin user and default site settings.

### 5. Install Filament assets + create your admin login
```bash
php artisan filament:install --panels    # publishes Filament assets (first time only)
php artisan make:filament-user           # or use the seeded admin below
```

**Seeded admin login** (change the password immediately):
- Email: `admin@example.com`
- Password: `password`

### 6. Generate the Filament admin resources
The models and migrations exist, so Filament can auto-generate CRUD screens from
them. Run once per model:

```bash
php artisan make:filament-resource Post --generate --view
php artisan make:filament-resource Category --generate
php artisan make:filament-resource Procedure --generate --view
php artisan make:filament-resource Appointment --generate --view
php artisan make:filament-resource Testimonial --generate --view
php artisan make:filament-resource Enquiry --generate --view
php artisan make:filament-resource Tag --generate
```
`--generate` infers form fields and table columns from the table schema;
`--view` adds a read-only view page. Tweak the generated classes in
`app/Filament/Resources/` afterwards (rich editor for `Post.body`, file uploads
for images, an enum `Select` for `status`, etc.).

### 7. Run it
```bash
php artisan serve
```
- Public site: http://localhost:8000
- Admin panel: http://localhost:8000/admin

---

## Domain model

| Model | Table | Purpose |
|-------|-------|---------|
| `User` | `users` | Admin login (Filament panel access) |
| `Category` | `categories` | Blog post categories |
| `Tag` | `tags` | Blog post tags (many-to-many via `post_tag`) |
| `Post` | `posts` | Blog articles (draft/published, scheduled publish, SEO meta) |
| `Procedure` | `procedures` | Service/procedure pages (CABG, valve replacement, …) |
| `Appointment` | `appointments` | Booking requests (status workflow + consent) |
| `Testimonial` | `testimonials` | Patient stories (approval + stored consent file) |
| `Enquiry` | `enquiries` | Contact form submissions (read/unread + consent) |
| `Media` | `media` | Reusable uploaded files |
| `Setting` | `settings` | Key/value store: SEO defaults, homepage stats, contact info |

Slugs (`Post`, `Procedure`, `Category`, `Tag`) are auto-generated and unique via
the `App\Models\Concerns\HasSlug` trait, and used as the route key.

Statuses are PHP enums in `app/Enums/` (`PostStatus`, `AppointmentStatus`) that
implement Filament's `HasLabel` + `HasColor` for nicely rendered badges.

---

## Roadmap

- **Phase 1 — Foundation** ✅ skeleton, SQLite, migrations, models, Filament panel
- **Phase 2 — Public site** — Home, About, Procedures, Contact, responsive, WhatsApp CTA
- **Phase 3 — Blog engine** — public listing/single, categories, SEO meta, schema.org
- **Phase 4 — Appointments + enquiries** — booking flow, email notifications, DPDP consent
- **Phase 5 — Polish + deploy** — testimonials, media library, SEO settings, sitemap, CloudPanel

## Deployment notes (CloudPanel)

- Domain: **drsujayj.in** — point the CloudPanel site's web root to `public/`,
  set `APP_URL=https://drsujayj.in` and `APP_ENV=production`, `APP_DEBUG=false`,
  and issue a Let's Encrypt certificate (force HTTPS).
- The site user (e.g. `www-data` / CloudPanel site user) needs **write** access to
  both `database/database.sqlite` **and** the `database/` directory (SQLite writes
  `-wal`/`-shm` temp files alongside it).
- Back up the database = copy `database/database.sqlite` (+ `-wal`/`-shm`) on a
  daily cron to off-server storage.
- `php artisan storage:link`, `php artisan config:cache`, `php artisan route:cache`,
  `php artisan filament:optimize` on deploy.

## Data privacy (India — DPDP Act 2023)

- Every public form (appointment, enquiry, testimonial) must capture explicit
  consent — the `consent` columns back this.
- Notifications must not carry medical details in plaintext; link to the dashboard.
- Testimonials require **written** consent stored in `testimonials.consent_file`.
