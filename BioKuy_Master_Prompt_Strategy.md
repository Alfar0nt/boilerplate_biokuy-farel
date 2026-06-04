# 🚀 BioKuy — Master Prompt Strategy
### Panduan Vibe Coding Lengkap untuk Membangun SaaS Linktree Clone
> **Cara Pakai:** Gunakan setiap prompt secara berurutan. Copy seluruh isi blok prompt (termasuk System Rules) ke Claude Sonnet/Opus atau AI coding assistant pilihan Anda. Tunggu hingga setiap fase selesai dan kode berjalan sebelum lanjut ke fase berikutnya.

---

## 🗺️ Arsitektur Aplikasi (Baca Sebelum Memulai)

```
biokuy/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/          ← Breeze controllers
│   │   ├── DashboardController.php
│   │   ├── LinkController.php
│   │   ├── BillingController.php
│   │   ├── CheckoutController.php
│   │   └── PublicProfileController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Link.php
│   │   └── Subscription.php
│   └── Services/
│       └── MidtransService.php
├── database/migrations/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php       ← Layout dashboard
│   │   │   ├── guest.blade.php     ← Layout auth/landing
│   │   │   └── public.blade.php    ← Layout halaman publik
│   │   ├── components/             ← Blade components
│   │   ├── landing.blade.php
│   │   ├── dashboard/
│   │   ├── links/
│   │   ├── billing/
│   │   └── profile/[username].blade.php
│   └── css/app.css
└── routes/web.php
```

**Paket Langganan:**
| Plan | Harga | Max Links | Custom Theme | Analytics |
|------|-------|-----------|--------------|-----------|
| Free | Rp 0 | 5 links | ❌ | Basic |
| Student | Rp 29.000/bln | 15 links | ✅ | Standard |
| Pro | Rp 79.000/bln | Unlimited | ✅ | Advanced |

---

---

# PHASE 1: Project Setup & Design System Foundation

---

## 📋 PROMPT PHASE 1

```
============================================================
SYSTEM RULES — BACA DAN PATUHI SEPANJANG SESI INI:
============================================================
Kamu adalah Senior Full-Stack Laravel Developer dengan keahlian
dalam Tailwind CSS v4 dan UI/UX modern. Ikuti aturan berikut:

1. SELALU tulis kode yang lengkap, siap pakai, bukan pseudocode.
2. SELALU sertakan nama file lengkap di atas setiap code block
   dengan format: // FILE: path/to/file.ext
3. Jangan skip bagian apapun dengan komentar "// ... rest of code"
4. Jika membuat migration, sertakan juga rollback (down method).
5. Gunakan PHP 8.2+ syntax (readonly, match, named args).
6. JANGAN gunakan PostCSS config — project ini pakai Tailwind CSS v4
   dengan Vite plugin (@tailwindcss/vite), bukan postcss.
7. Setelah memberikan semua kode, sertakan checklist langkah
   eksekusi terminal yang harus dijalankan secara berurutan.
============================================================

## TUGAS: Setup Proyek BioKuy — Phase 1

Saya sedang membangun aplikasi SaaS bernama **BioKuy** (clone Linktree)
dengan stack:
- Laravel 12
- MySQL
- Blade + Vanilla JS
- Tailwind CSS v4 (via @tailwindcss/vite, TANPA postcss.config.js)
- Laravel Breeze (Blade stack)

### STEP 1 — Inisialisasi Proyek
Tuliskan perintah terminal lengkap (berurutan) untuk:
1. Membuat project Laravel 12 baru bernama `biokuy`
2. Install Laravel Breeze (pilih stack: blade)
3. Install Tailwind CSS v4 dengan cara yang BENAR untuk Laravel 12
   (gunakan `@tailwindcss/vite` plugin, bukan postcss)
4. Setup database `.env` untuk MySQL
Untuk step 1 diatas semuanya sudah saya lakukan tetapi tolong cek tiap langkah 1-4 apakah sudah sesuai

### STEP 2 — Design System Foundation
Buat file `resources/css/app.css` yang mendefinisikan:

**CSS Custom Properties (Design Tokens):**
```
--color-brand-primary: oklch(0.65 0.18 165)      /* Emerald accent */
--color-brand-secondary: oklch(0.55 0.15 240)    /* Blue accent */
--color-surface-base: oklch(0.98 0 0)            /* Near white */
--color-surface-elevated: oklch(1 0 0)           /* Pure white card */
--color-surface-muted: oklch(0.96 0 0)           /* Subtle bg */
--color-text-primary: oklch(0.15 0 0)            /* Near black */
--color-text-secondary: oklch(0.45 0 0)          /* Gray text */
--color-text-muted: oklch(0.65 0 0)              /* Muted text */
--color-border: oklch(0.90 0 0)                  /* Subtle border */
--radius-card: 1.25rem                           /* 20px — rounded-2xl */
--radius-btn: 0.75rem                            /* 12px — rounded-xl */
--shadow-card: 0 4px 24px oklch(0 0 0 / 0.06)
--shadow-elevated: 0 8px 40px oklch(0 0 0 / 0.10)
```

**Custom Utility Classes (gunakan @layer utilities di Tailwind v4):**
- `.card` → surface elevated, border, shadow-card, radius-card, padding
- `.card-hover` → card + hover:shadow-elevated + hover:-translate-y-0.5 + transition
- `.btn-primary` → bg brand-primary, text white, radius-btn, padding, hover effect
- `.btn-secondary` → border brand-primary, text brand-primary, hover fill effect
- `.btn-ghost` → transparent, text secondary, hover:bg-surface-muted
- `.input-field` → border, radius, padding, focus:ring brand-primary, transition
- `.badge-free` → slate colored badge
- `.badge-student` → blue colored badge  
- `.badge-pro` → emerald/gradient colored badge

### STEP 3 — Blade Layout Files
Buat 3 layout file utama:

**A. `resources/views/layouts/app.blade.php`** (Dashboard Layout)
- Sidebar kiri (lebar 260px, collapsible di mobile)
- Sidebar berisi: Logo BioKuy, nav links dengan icon (Dashboard, Links,
  Billing, Preview Page), user avatar + nama di bawah, tombol collapse
- Main content area dengan top header (breadcrumb + notification bell
  + user menu dropdown)
- Footer kecil di sidebar: "© 2025 BioKuy"
- Smooth sidebar collapse dengan JS vanilla
- Responsive: sidebar jadi bottom nav di mobile (max-md)

**B. `resources/views/layouts/guest.blade.php`** (Auth & Landing Layout)
- Minimal: hanya slot konten, tidak ada sidebar
- Background: gradient halus dari surface-base ke surface-muted
- Logo di pojok kiri atas yang linkable ke home

**C. `resources/views/layouts/public.blade.php`** (Halaman Profil Publik)
- Sangat minimal, centered
- Background bisa dikustomisasi via CSS variable yang dipass dari controller
- "Powered by BioKuy" di footer kecil

### STEP 4 — Database Migrations
Buat migration untuk semua tabel yang dibutuhkan:

**Modifikasi `users` table (add_biokuy_fields_to_users_table):**
- `username` (string, unique, nullable)
- `bio` (text, nullable)
- `avatar` (string, nullable)
- `theme` (string, default: 'default')
- `plan` (enum: 'free','student','pro', default: 'free')
- `custom_url` (string, nullable, unique)
- `is_active` (boolean, default: true)

**Buat tabel `links`:**
- `id` (ulid/uuid primary key)
- `user_id` (FK ke users, cascade delete)
- `title` (string, max 100)
- `url` (string, max 500)
- `icon` (string, nullable — simpan nama icon/emoji)
- `sort_order` (integer, default: 0)
- `is_active` (boolean, default: true)
- `click_count` (integer, default: 0)
- timestamps

**Buat tabel `subscriptions`:**
- `id` (ulid)
- `user_id` (FK ke users, cascade delete)
- `plan` (enum: 'free','student','pro')
- `status` (enum: 'active','expired','cancelled','pending')
- `midtrans_order_id` (string, nullable, unique)
- `midtrans_transaction_id` (string, nullable)
- `amount` (integer — dalam rupiah)
- `started_at` (timestamp, nullable)
- `expires_at` (timestamp, nullable)
- timestamps

### STEP 5 — Model & Relationships
Buat/update Model:

**`app/Models/User.php`:**
- HasMany Links
- HasMany Subscriptions  
- HasOne aktif Subscription (latestOfMany dengan scope active)
- Method: `canAddLink()` → cek limit berdasarkan plan
- Method: `getActivePlan()` → return plan name
- Method: `getLinkLimit()` → return int (5/15/PHP_INT_MAX)
- Cast: `plan` as enum (buat PlanEnum)
- Accessor: `avatar_url` → return default avatar jika null
- Accessor: `public_url` → return full URL halaman publik

**`app/Models/Link.php`:**
- BelongsTo User
- Cast: `is_active` as boolean
- Scope: `active()` → where is_active = true
- Scope: `ordered()` → orderBy sort_order

**`app/Models/Subscription.php`:**
- BelongsTo User
- Scope: `active()` → where status = active AND expires_at > now()
- Cast: amounts dan dates

### STEP 6 — Routes (web.php)
Setup routing lengkap:
```php
// Public
Route::get('/', [LandingController::class, 'index']);
Route::get('/{username}', [PublicProfileController::class, 'show']);

// Auth routes (Breeze default)
// ...

// Protected Dashboard routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/links', LinkController::class)->except(['show']);
    Route::patch('/links/{link}/toggle', [LinkController::class, 'toggle']);
    Route::post('/links/reorder', [LinkController::class, 'reorder']);
    Route::get('/billing', [BillingController::class, 'index']);
    Route::post('/checkout/{plan}', [CheckoutController::class, 'create']);
    Route::post('/checkout/callback', [CheckoutController::class, 'callback']);
});
```

### OUTPUT YANG DIHARAPKAN:
1. Daftar perintah terminal untuk setup
2. `resources/css/app.css` (design tokens + utilities)
3. `vite.config.js` yang dikonfigurasi dengan benar untuk Tailwind v4
4. 3 layout blade files (app, guest, public)
5. 4 migration files
6. 3 model files (User, Link, Subscription)
7. `app/Enums/PlanEnum.php`
8. `routes/web.php`
9. Checklist eksekusi: `php artisan migrate`, npm commands, dll.
```

---

---

# PHASE 2: Auth & Landing Page

---

## 📋 PROMPT PHASE 2

```
============================================================
SYSTEM RULES — BACA DAN PATUHI SEPANJANG SESI INI:
============================================================
1. Kamu melanjutkan project Laravel 12 "BioKuy" dari Phase 1.
   Semua migration, model, layout, dan design system SUDAH ADA.
2. Tulis kode LENGKAP dan SIAP PAKAI. Tidak ada placeholder.
3. Setiap file harus dimulai dengan komentar // FILE: path/to/file
4. Gunakan design tokens yang sudah didefinisikan di app.css:
   var(--color-brand-primary), .card, .btn-primary, .input-field, dll.
5. Semua UI menggunakan Tailwind CSS v4 utility classes.
6. Vanilla JS untuk semua interaktivitas (JANGAN gunakan Alpine.js
   atau Livewire — kecuali diminta).
7. Semua form harus include @csrf dan proper validation display.
8. Gunakan Blade components untuk elemen yang reusable.
============================================================

## TUGAS: Auth Pages & Landing Page — Phase 2

### CONTEXT DESAIN:
- Style: Modern minimalis, terinspirasi Linktree terbaru + Bento UI
- Warna: Slate/Gray base, Emerald sebagai aksen utama
- Karakter: Clean, trustworthy, sedikit playful di landing page
- Semua halaman auth menggunakan layout `layouts.guest`

---

### STEP 1 — Reusable Blade Components
Buat components berikut di `resources/views/components/`:

**A. `alert.blade.php`** — Alert/notification component
Props: $type (success|error|warning|info), $message
Style: colored left border, icon sesuai type, dismissible dengan JS

**B. `form-error.blade.php`** — Inline field error
Props: $field
Tampilkan $errors->first($field) dengan style merah kecil

**C. `plan-badge.blade.php`** — Badge paket langganan
Props: $plan (free|student|pro)
Gunakan class .badge-free/.badge-student/.badge-pro dari design system

**D. `link-card.blade.php`** — Card untuk satu link di dashboard
Props: $link (Link model)
Berisi: drag handle, icon, title, url (truncated), toggle switch, edit & delete button
Style: .card-hover, smooth drag cursor

---

### STEP 2 — Custom Auth Pages (Override Breeze)
Buat ulang tampilan auth Breeze dengan design BioKuy:

**A. `resources/views/auth/login.blade.php`**
Layout: Split screen
- Kiri (hidden di mobile): Ilustrasi/visual dengan gradient emerald-blue,
  berisi quote atau tagline BioKuy, dan beberapa "floating card" dummy
  yang menunjukkan contoh halaman bio user
- Kanan: Form login
  * Logo BioKuy di atas
  * Heading: "Selamat Datang Kembali 👋"
  * Subheading: "Login untuk mengelola halaman bio kamu"
  * Input email + password dengan .input-field
  * Checkbox "Ingat saya"
  * Link "Lupa password?"
  * Button .btn-primary full width: "Masuk"
  * Divider "atau"
  * Link ke register: "Belum punya akun? Daftar gratis"
  * Tampilkan session error/status menggunakan component alert

**B. `resources/views/auth/register.blade.php`**
Layout: Centered card (max-w-md, centered vertically)
- Logo di atas
- Heading: "Buat Akun BioKuy Gratis"
- Subheading: "Mulai dalam 30 detik, tidak perlu kartu kredit"
- Form fields: Nama lengkap, Email, Username (dengan live preview URL:
  "biokuy.com/[username]" yang update realtime saat user ketik via JS),
  Password, Konfirmasi Password
- Username validation feedback (hijau ✓ atau merah ✗) via vanilla JS
  dengan debounce (gunakan endpoint AJAX GET /check-username)
- Terms checkbox: "Saya setuju dengan Syarat & Ketentuan"
- Button .btn-primary: "Buat Akun Gratis"
- Link kembali ke login

**C. `resources/views/auth/forgot-password.blade.php`**
Layout: Centered card, minimalis
Simple form email + button kirim reset link

**D. `resources/views/auth/reset-password.blade.php`**
Form reset password standar dengan design BioKuy

---

### STEP 3 — Landing Page
Buat `resources/views/landing.blade.php` dan `LandingController.php`

Halaman landing harus memiliki **7 section** berikut:

**[SECTION 1] Hero Section**
- Navbar: Logo kiri, nav links tengah (Fitur, Harga, Testimoni),
  tombol "Login" (ghost) + "Mulai Gratis" (primary) di kanan
- Navbar sticky + blur background saat scroll (JS)
- Hero content (centered):
  * Badge kecil: "✨ Lebih dari 10.000 pengguna aktif"
  * H1 (besar, bold): "Satu Link untuk Semua\nMedia Sosialmu"
  * Subtext: deskripsi singkat BioKuy
  * CTA buttons: "Buat Halaman Gratis" (primary, besar) + "Lihat Contoh" (ghost)
  * Di bawah CTA: 3 avatar dummy + teks "Bergabung dengan ribuan kreator"
- Hero Visual: Mockup browser/phone yang menampilkan contoh halaman
  bio BioKuy (gunakan CSS untuk membuat device mockup, jangan gambar external)
  Efek: floating animation subtle (CSS keyframe)

**[SECTION 2] Social Proof / Stats**
- 3 angka besar: "10K+ Halaman Dibuat", "500K+ Klik Tercatat", "99.9% Uptime"
- Background: surface-muted

**[SECTION 3] Features (Bento Grid Layout)**
- Heading section: "Semua yang Kamu Butuhkan"
- Layout: Bento grid (mirip Apple/Linktree) — mix ukuran card
- Card 1 (2 kolom wide): "Kelola Link Mudah" — drag & drop illustration
- Card 2: "Tema Custom" — color swatches preview
- Card 3: "Analitik Klik" — mini chart dummy (CSS bars)
- Card 4 (2 kolom wide): "URL Personal" — contoh URL preview
- Card 5: "Mobile Friendly" — phone mockup kecil
- Card 6: "Aman & Cepat" — shield icon + stats
- Setiap card adalah .card-hover dengan icon dan deskripsi singkat

**[SECTION 4] How It Works**
- Heading: "Cara Kerja BioKuy"
- 3 langkah dengan numbered steps yang besar dan eye-catching:
  1. Daftar gratis (30 detik)
  2. Tambahkan link-linkmu
  3. Bagikan URL-mu ke mana saja
- Layout horizontal di desktop, vertikal di mobile
- Sambungkan langkah dengan garis/connector visual

**[SECTION 5] Pricing Preview**
- Heading: "Pilih Paket yang Cocok"
- Subheading + toggle Monthly/Yearly (Yearly = diskon 20%)
- 3 pricing card: Free, Student (Rp 29.000/bln), Pro (Rp 79.000/bln)
- Card Student atau Pro ditandai sebagai "Paling Populer" dengan badge
- Setiap card: nama plan, harga, daftar fitur (✓ dan ✗), CTA button
- Card "Pro": border emerald + slight scale-up untuk emphasis

**[SECTION 6] Testimonials**
- Heading: "Apa Kata Mereka?"
- 3 testimonial card dengan: avatar (inisial), nama, role, bintang rating, kutipan
- Layout: 3 kolom grid, responsive

**[SECTION 7] Final CTA + Footer**
- CTA Section: gradient emerald-blue background, text putih
  "Siap Buat Halaman Biomu?" + button "Daftar Sekarang — Gratis"
- Footer: Logo, deskripsi singkat, links (Fitur, Harga, Blog, Kontak),
  copyright, social media icons

---

### STEP 4 — Controllers
Buat controller yang dibutuhkan:

**`LandingController.php`:**
- Method `index()`: return view landing (data dummy/static oke)

**`CheckUsernameController.php`** (untuk AJAX check):
- Method `check(Request $request)`: cek apakah username tersedia
  * Validasi format username (alphanumeric + underscore, min 3 char)
  * Cek di tabel users
  * Return JSON: `{available: true/false, message: "..."}`

**Update `RegisteredUserController.php`** (dari Breeze):
- Tambahkan field `username` ke proses registrasi
- Auto-generate username dari nama jika tidak diisi
- Buat entry subscription default (plan: free, status: active)

---

### OUTPUT YANG DIHARAPKAN:
1. 5 Blade components (alert, form-error, plan-badge, link-card)
2. 4 Auth view files (login, register, forgot-password, reset-password)
3. `landing.blade.php` (lengkap dengan semua 7 section)
4. `LandingController.php`
5. `CheckUsernameController.php`
6. Update `RegisteredUserController.php`
7. Update `routes/web.php` (tambahkan route check-username)
8. Tambahan CSS jika ada animasi/style khusus untuk landing page
```

---

---

# PHASE 3: Core Feature — Link Management & Public Page

---

## 📋 PROMPT PHASE 3

```
============================================================
SYSTEM RULES — BACA DAN PATUHI SEPANJANG SESI INI:
============================================================
1. Project BioKuy Laravel 12 sudah memiliki: setup, design system,
   auth, landing page. Sekarang kita bangun fitur utama.
2. Tulis kode LENGKAP. Tidak ada "// implement later" atau placeholder.
3. Semua UI: Tailwind CSS v4 utility classes + design tokens BioKuy.
4. Gunakan ULID untuk primary key Links (sudah di migration).
5. Semua API response untuk AJAX harus return JSON.
6. Drag & drop HANYA menggunakan HTML5 Drag and Drop API native
   (tanpa library external). Implementasi harus smooth dan reliable.
7. Setiap action yang mengubah data harus ada toast notification
   (buat vanilla JS toast system).
8. Loading states harus diimplementasikan untuk semua async actions.
9. Semua input disanitize dan divalidate di backend (Form Request).
============================================================

## TUGAS: Link Management & Public Profile Page — Phase 3

### CONTEXT:
- User bisa menambah/edit/hapus/reorder links
- Ada batasan jumlah link berdasarkan plan (5/15/unlimited)
- Halaman publik (/username) adalah output utama yang akan dibagikan user

---

### STEP 1 — Form Request Validation
Buat `app/Http/Requests/StoreLinkRequest.php` dan `UpdateLinkRequest.php`:
- `title`: required, string, max:100
- `url`: required, url, max:500, active_url validation dengan try-catch
  (jangan block jika URL valid format tapi tidak bisa diakses)
- `icon`: nullable, string, max:10 (emoji atau icon name)
- Custom messages dalam Bahasa Indonesia

---

### STEP 2 — LinkController (Full Implementation)
Buat `app/Http/Controllers/LinkController.php` dengan methods:

**`index()`:**
- Load semua links user (ordered by sort_order)
- Hitung: total links, active links, total clicks hari ini, total clicks all time
- Pass ke view: links collection, stats array, canAddMore (bool),
  linkLimit (int), currentCount (int)

**`store(StoreLinkRequest $request)`:**
- Cek `auth()->user()->canAddLink()` → jika false, redirect dengan error
  "Kamu sudah mencapai batas X link untuk paket [plan]. Upgrade untuk tambah lebih!"
- Buat link baru dengan sort_order = max(sort_order) + 1
- Return redirect dengan success message

**`edit(Link $link)`:**
- Gate check: pastikan link milik user yang login
- Return view dengan link data

**`update(UpdateLinkRequest $request, Link $link)`:**
- Gate check
- Update link
- Return redirect dengan success

**`destroy(Link $link)`:**
- Gate check
- Soft reorder: update sort_order links lain yang terpengaruh
- Delete link
- Return JSON jika request expects JSON, redirect jika tidak

**`toggle(Link $link)`:**
- Gate check
- Toggle is_active
- Return JSON: `{success: true, is_active: bool, message: "..."}`

**`reorder(Request $request)`:**
- Validate: `items` array of `{id: string, sort_order: int}`
- Gate check semua links (pastikan semua milik user)
- Update sort_order dalam satu transaction
- Return JSON: `{success: true}`

---

### STEP 3 — Views: Link Management

**A. `resources/views/links/index.blade.php`**
Layout: menggunakan `layouts.app`

Struktur halaman:
1. **Header Section:**
   - Title "Kelola Links" + badge jumlah link aktif
   - Progress bar: "X dari Y link digunakan" (warna hijau, kuning jika >80%, merah jika full)
   - Tombol "Tambah Link" (.btn-primary) — disabled + tooltip jika limit tercapai
   - Jika limit tercapai: banner "Upgrade ke Pro untuk link unlimited" dengan CTA

2. **Add/Edit Form (Inline, toggle show/hide):**
   - Form muncul di bawah header saat klik "Tambah Link" (slide down animation)
   - Fields: Emoji/Icon picker (8 emoji pilihan cepat + input manual),
     Judul Link, URL
   - Tombol "Simpan" + "Batal"
   - Validasi inline (error muncul di bawah field)
   - Loading spinner di button saat submit

3. **Links List (Drag & Drop):**
   - Container `id="links-list"` dengan `data-*` attributes untuk drag state
   - Setiap item menggunakan component `link-card`
   - Visual feedback saat drag: item yang di-drag jadi semi-transparent,
     drop zone highlight dengan dashed border emerald
   - "Drop indicator" line yang muncul antara items saat hover
   - Empty state jika belum ada link: ilustrasi + CTA tambah link

4. **Quick Tips Section** (dismissible):
   - Card kecil dengan tips: "💡 Klik dan seret untuk mengatur urutan",
     "🔗 Pastikan URL dimulai dengan https://", dll.

**B. `resources/views/links/edit.blade.php`**
- Full page edit form (untuk pengguna yang tidak mau pakai inline edit)
- Sama seperti add form tapi pre-filled
- Tombol kembali ke daftar links

---

### STEP 4 — JavaScript: Drag & Drop & Interactivity

Buat file `resources/js/links.js` dengan implementasi:

**Toast Notification System:**
```javascript
// Global toast function: showToast(message, type='success'|'error'|'warning'|'info')
// Toast muncul di pojok kanan bawah, auto dismiss setelah 3 detik
// Stack multiple toasts dengan gap
// Slide in dari kanan, slide out ke kanan
```

**Drag & Drop Manager:**
```javascript
// Class: DragDropManager
// - init(containerSelector, itemSelector, onReorder callback)
// - Handle dragstart, dragover, dragenter, dragleave, drop, dragend
// - Visual feedback: dragging class, over class, drop indicator
// - Debounced AJAX call ke /links/reorder setelah drop
// - Error handling: jika reorder gagal, kembalikan ke urutan sebelumnya
```

**Inline Form Toggle:**
```javascript
// Toggle form dengan smooth slide animation
// Reset form saat toggle close
// Escape key untuk close form
```

**Toggle Link Active:**
```javascript
// AJAX call ke /links/{id}/toggle
// Optimistic UI update (toggle dulu, rollback jika error)
// Show toast notification
```

**Delete Link:**
```javascript
// Confirm dialog custom (bukan browser default alert)
// Modal konfirmasi: "Hapus link ini?" dengan preview judul link
// AJAX delete atau form submit
// Fade out animasi sebelum remove dari DOM
```

---

### STEP 5 — Profile Settings (Inline di halaman Links)

Di sidebar kanan halaman links (atau section bawah di mobile):

Buat partial `resources/views/links/partials/profile-card.blade.php`:
- Preview mini halaman publik user (avatar, nama, bio, beberapa link)
- Tombol "Edit Profil" yang buka modal
- Modal edit profil: upload/ubah avatar (preview langsung), bio (max 150 char
  dengan counter), username (dengan cek ketersediaan)
- Tombol "Lihat Halaman Publik" → buka /username di tab baru

---

### STEP 6 — Public Profile Page
Buat `resources/views/profile/show.blade.php` dan `PublicProfileController.php`

**`PublicProfileController.php`:**
- Method `show($username)`:
  * Cari user berdasarkan username (atau 404)
  * Cek is_active user
  * Load links yang aktif (ordered)
  * Increment view counter (optional: track di session agar tidak spam)
  * Track klik link via AJAX endpoint terpisah
  * Pass theme settings ke view

**`resources/views/profile/show.blade.php`** (menggunakan `layouts.public`):

Layout: Centered, single column, max-w-sm di mobile / max-w-md di desktop

Design halaman publik:
1. **Background:** Full page gradient atau solid sesuai theme user
   (default: subtle slate gradient)

2. **Profile Header:**
   - Avatar (circular, border putih, shadow) — 80px
   - Nama user (bold, besar)
   - Bio teks (text-muted, max 2 baris)
   - Username kecil (@username) dengan warna brand

3. **Links List:**
   - Setiap link: card putih dengan rounded-2xl, shadow halus
   - Layout: icon kiri, teks tengah (title bold, domain URL kecil), arrow kanan
   - Hover effect: scale 1.02, shadow elevated, warna brand
   - Click animation: scale 0.98 sebentar (bounce effect)
   - Smooth fade-in stagger animation saat halaman load (CSS @keyframes)

4. **Footer:**
   - "Buat halaman biomu di" + Logo BioKuy kecil
   - Link ke landing page (UTM tracking: ?ref=public_profile)

5. **Click Tracking:**
   - Setiap klik link kirim AJAX ke `/track/{linkId}` sebelum redirect
   - Gunakan `navigator.sendBeacon()` untuk reliable tracking
   - Buat route dan controller method untuk ini

---

### STEP 7 — Click Tracking Controller

Buat `app/Http/Controllers/TrackController.php`:
- Method `click($linkId)`: increment link click_count, return JSON success
- Rate limiting: 1 klik per IP per link per jam (gunakan Laravel RateLimiter)

---

### OUTPUT YANG DIHARAPKAN:
1. `StoreLinkRequest.php` dan `UpdateLinkRequest.php`
2. `LinkController.php` (lengkap semua methods)
3. `resources/views/links/index.blade.php` (full)
4. `resources/views/links/edit.blade.php`
5. `resources/views/links/partials/profile-card.blade.php`
6. `resources/js/links.js` (toast + drag drop + interactivity)
7. `resources/views/profile/show.blade.php` (full public page)
8. `PublicProfileController.php`
9. `TrackController.php`
10. Update `routes/web.php` dengan route tracking
11. Update `vite.config.js` jika perlu tambah JS entry point baru
```

---

---

# PHASE 4: SaaS Billing & Checkout

---

## 📋 PROMPT PHASE 4

```
============================================================
SYSTEM RULES — BACA DAN PATUHI SEPANJANG SESI INI:
============================================================
1. Project BioKuy sudah memiliki: setup, auth, link management,
   public page. Sekarang kita bangun sistem monetisasi SaaS.
2. Integrasi Midtrans menggunakan SIMULASI/SANDBOX mode.
3. Gunakan Midtrans Snap.js (CDN) untuk payment popup.
4. Semua transaksi keuangan harus atomic (database transaction).
5. Webhook/callback dari Midtrans harus diverifikasi signature-nya.
6. Sensitive config (Midtrans keys) WAJIB di .env, jangan hardcode.
7. Buat Service class terpisah untuk logika Midtrans.
8. Error handling yang proper: semua edge case ditangani.
9. Semua amount dalam Rupiah (integer, bukan float).
10. Tulis kode LENGKAP, siap production (sandbox mode).
============================================================

## TUGAS: Billing System & Midtrans Integration — Phase 4

### CONTEXT BISNIS:
- Plan Free: Rp 0, 5 links, no custom theme
- Plan Student: Rp 29.000/bulan, 15 links, custom theme, standard analytics
- Plan Pro: Rp 79.000/bulan, unlimited links, all features, advanced analytics
- Yearly discount: 20% (Student: Rp 278.400/tahun, Pro: Rp 758.400/tahun)
- Saat ini user bisa downgrade ke Free kapan saja (instant)
- Upgrade berlaku setelah pembayaran confirmed

---

### STEP 1 — Environment & Config Setup
Tambahkan ke `.env`:
```
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxx
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_MERCHANT_ID=G12345678
APP_URL=http://localhost:8000
```

Buat `config/midtrans.php`:
- server_key, client_key, is_production, merchant_id dari env
- snap_url: sandbox vs production URL
- notification_url: APP_URL + '/checkout/callback'
- finish_url, error_url, pending_url

---

### STEP 2 — MidtransService
Buat `app/Services/MidtransService.php`:

```php
class MidtransService {
    // createSnapToken(User $user, string $plan, string $billingCycle): array
    // - Generate unique order_id: "BIOKUY-{userId}-{plan}-{timestamp}"
    // - Hitung amount berdasarkan plan + billing cycle
    // - Build parameter sesuai Midtrans Snap API:
    //   * transaction_details: order_id, gross_amount
    //   * customer_details: first_name, email, phone
    //   * item_details: [{id, price, qty, name}]
    //   * callbacks: finish, error, pending URLs
    // - Call Midtrans Snap API dengan curl (bukan library — untuk kontrol penuh)
    // - Return: {snap_token, order_id, amount}

    // verifySignature(string $orderId, string $statusCode, 
    //                 string $grossAmount, string $signature): bool
    // - Verifikasi SHA512 hash: orderId+statusCode+grossAmount+serverKey
    
    // handleCallback(array $payload): string (return status: success/pending/failed)
    // - Verifikasi signature
    // - Cari subscription berdasarkan order_id
    // - Handle berdasarkan transaction_status:
    //   * capture/settlement → activate subscription, update user plan
    //   * pending → biarkan status pending
    //   * deny/cancel/expire → update status, jangan ubah plan user
    // - Semua dalam DB transaction
    // - Log semua callback untuk audit
}
```

---

### STEP 3 — CheckoutController
Buat `app/Http/Controllers/CheckoutController.php`:

**`create(Request $request, string $plan)`:**
- Validate plan (must be student|pro)
- Validate billing_cycle dari request (monthly|yearly, default monthly)
- Cek apakah user sudah punya plan aktif yang sama → redirect dengan info
- Buat record subscription dengan status 'pending' di database
- Call MidtransService::createSnapToken()
- Return JSON: `{snap_token, client_key, order_id, amount}`
  (untuk di-handle oleh JS frontend)

**`callback(Request $request)`:**
- Endpoint untuk Midtrans server-to-server notification
- Validate request payload
- Call MidtransService::handleCallback()
- Return response 200 OK (wajib untuk Midtrans)

**`finish(Request $request)`:**
- Endpoint redirect setelah user selesai di Snap
- Tampilkan halaman sukses/gagal berdasarkan query params
- Redirect ke billing page dengan flash message

---

### STEP 4 — BillingController
Buat `app/Http/Controllers/BillingController.php`:

**`index()`:**
- Load: subscription aktif user, riwayat subscription (last 10),
  available plans data (nama, harga, fitur)
- Pass semua ke view

---

### STEP 5 — Billing View
Buat `resources/views/billing/index.blade.php` (layout: layouts.app):

**Struktur:**

1. **Current Plan Status Card:**
   - Badge plan aktif (dengan warna sesuai .badge-*)
   - Info: tanggal mulai, tanggal berakhir (jika berbayar)
   - Progress bar: "X dari Y link digunakan"
   - Untuk plan berbayar: tombol "Batalkan Langganan" (ghost, confirm dialog)
   - Untuk plan Free: CTA "Upgrade Sekarang"

2. **Pricing Plans Section:**
   - Toggle switch "Bulanan / Tahunan" (smooth toggle animation)
   - Saat toggle Tahunan: harga berubah animasi, tampil badge "Hemat 20%"
   - 3 pricing card dengan design:
     * **Free Card:** Border normal, badge "Gratis", fitur list, tombol disabled jika sudah aktif
     * **Student Card:** Border biru, badge "Student ⭐", highlight "Paling Populer"
     * **Pro Card:** Border emerald + subtle gradient background,
       badge "Pro 🚀", tombol lebih besar dan eye-catching
   - Setiap card: nama plan, harga animasi, deskripsi, fitur list (✓/✗), CTA button
   - Tombol upgrade trigger checkout modal
   - "Semua harga sudah termasuk PPN" note kecil

3. **Checkout Modal:**
   - Muncul saat klik tombol upgrade plan
   - Summary pesanan: nama plan, periode, harga
   - "Lanjut Bayar" button trigger Midtrans Snap popup
   - Midtrans Snap.js diload dari CDN di halaman ini saja
   - JS handle: token fetch → snap.pay() → callback handling

4. **Payment History Table:**
   - Kolom: Tanggal, Plan, Periode, Amount, Status badge, Order ID
   - Status badge: success (hijau), pending (kuning), failed (merah), cancelled (abu)
   - Pagination jika banyak
   - Empty state jika belum ada transaksi: "Belum ada riwayat pembayaran"

---

### STEP 6 — JavaScript: Billing & Checkout
Buat `resources/js/billing.js`:

```javascript
// PricingToggle: 
// - Toggle monthly/yearly dengan animasi harga (count-up atau fade)
// - Update semua harga di kartu secara bersamaan
// - Simpan pilihan di dataset/variable

// CheckoutModal:
// - Open/close modal dengan backdrop
// - Update summary saat plan/cycle dipilih
// - fetchSnapToken(plan, cycle): AJAX POST ke /checkout/{plan}
// - Setelah dapat token: panggil window.snap.pay(token, {...})
//   * onSuccess: redirect ke halaman sukses atau refresh billing
//   * onPending: show toast "Pembayaran pending, kami akan konfirmasi segera"
//   * onError: show toast error
//   * onClose: close modal, show info "Pembayaran dibatalkan"

// DowngradeConfirm:
// - Custom confirm dialog untuk konfirmasi downgrade
// - Tampilkan konsekuensi downgrade (link akan di-nonaktifkan jika melebihi batas)
```

---

### STEP 7 — Halaman Checkout Sukses/Gagal
Buat `resources/views/billing/finish.blade.php`:
- Layout: guest (tanpa sidebar)
- Jika sukses: animasi checkmark hijau, "Pembayaran Berhasil!",
  detail plan yang diaktifkan, tombol "Ke Dashboard"
- Jika pending: icon jam, instruksi pembayaran, tombol "Cek Status"
- Jika gagal: icon X merah, pesan error, tombol "Coba Lagi"

---

### STEP 8 — Middleware: Plan Access Control
Buat `app/Http/Middleware/CheckPlanLimit.php`:
- Cek apakah user mencoba melampaui batas plan-nya
- Jika ya: redirect ke billing dengan flash message informatif
- Daftarkan di bootstrap/app.php sebagai 'plan.limit'

---

### STEP 9 — Update User Model Methods
Tambahkan methods ke User model:
- `activateSubscription(Subscription $sub)`: update user plan + subscription
- `deactivateExpiredSubscriptions()`: cek dan update yang expired
- `getRemainingLinks()`: hitung sisa slot link

---

### OUTPUT YANG DIHARAPKAN:
1. `config/midtrans.php`
2. `app/Services/MidtransService.php` (lengkap dengan curl implementation)
3. `CheckoutController.php`
4. `BillingController.php`
5. `resources/views/billing/index.blade.php` (full dengan modal)
6. `resources/views/billing/finish.blade.php`
7. `resources/js/billing.js`
8. `app/Http/Middleware/CheckPlanLimit.php`
9. Update `User.php` model
10. Update `routes/web.php` (billing routes)
11. Update `vite.config.js` jika perlu
12. Tambahan .env variables yang dibutuhkan
```

---

---

# PHASE 5: Dashboard & Final Polish

---

## 📋 PROMPT PHASE 5

```
============================================================
SYSTEM RULES — BACA DAN PATUHI SEPANJANG SESI INI:
============================================================
1. Ini adalah FASE FINAL dari project BioKuy.
2. Focus pada: Dashboard yang informatif, UX yang halus di semua halaman,
   konsistensi desain, dan persiapan deployment.
3. Semua data statistik harus real dari database (bukan dummy).
4. Performance: query harus efisien (eager loading, caching sederhana).
5. Semua halaman harus fully responsive (mobile-first).
6. Tambahkan micro-interactions yang belum ada.
7. Buat semua halaman "pixel perfect" sesuai design system BioKuy.
8. Tulis kode LENGKAP. Ini fase final, tidak boleh ada yang di-skip.
9. Setelah semua selesai, berikan Production Checklist.
============================================================

## TUGAS: Dashboard, Polish & Final Touches — Phase 5

---

### STEP 1 — Dashboard Controller & Data
Buat/Update `app/Http/Controllers/DashboardController.php`:

**Method `index()`:**
Kumpulkan semua data berikut secara efisien:

```php
$stats = [
    'total_links' => // jumlah links user
    'active_links' => // jumlah links aktif
    'total_clicks_today' => // clicks hari ini (aggregate dari links)
    'total_clicks_week' => // clicks 7 hari terakhir
    'total_clicks_month' => // clicks 30 hari terakhir
    'total_clicks_all' => // total klik semua waktu
    'profile_views_today' => // (jika sudah ada tracking)
];

$topLinks = // 5 links dengan click tertinggi (bulan ini)

$clicksChartData = // Data klik per hari untuk 7 hari terakhir
// Format: [{date: '2025-01-01', clicks: 23}, ...]
// Query dengan groupBy date dari click_count field
// (Catatan: karena kita track dengan increment, perlu tabel clicks_log
//  atau gunakan data simulasi jika belum ada tabel tersebut)

$currentPlan = // info plan aktif user
$linkUsage = [
    'used' => $totalLinks,
    'limit' => auth()->user()->getLinkLimit(),
    'percentage' => // hitung persentase
];
```

---

### STEP 2 — Dashboard View
Buat `resources/views/dashboard/index.blade.php` (layout: layouts.app):

**Layout Grid Dashboard:**
```
┌─────────────────────────────────────────────────────────┐
│ Welcome Header + Plan Badge + "Lihat Halaman Saya" CTA  │
├──────────┬──────────┬──────────┬──────────┬────────────┤
│ Stat 1   │ Stat 2   │ Stat 3   │ Stat 4   │            │
│ Total    │ Klik     │ Klik     │ Links    │            │
│ Klik     │ Hari Ini │ Minggu   │ Aktif    │            │
├──────────┴──────────┴──────────┴──────────┤ Preview    │
│                                           │ Halaman    │
│ Chart: Klik 7 Hari (Bar chart CSS)        │ Publik     │
│                                           │ (iframe    │
│                                           │ atau CSS   │
├───────────────────────────────────────────┤ mockup)    │
│                                           │            │
│ Top 5 Links (table dengan click count     │            │
│ dan progress bar visual)                  ├────────────┤
│                                           │ Plan Usage │
│                                           │ Progress   │
│                                           │ Bar + CTA  │
└───────────────────────────────────────────┴────────────┘
```

**Detail setiap section:**

1. **Welcome Header:**
   - "Selamat datang kembali, [Nama]! 👋" (greeting berubah sesuai waktu:
     Selamat pagi/siang/sore/malam via JS)
   - Tanggal hari ini
   - Plan badge + tombol "Lihat Halaman Publik" di kanan

2. **Stat Cards (4 kartu):**
   - Setiap kartu: .card, icon berwarna, angka besar (bold), label, 
     perbandingan dengan periode sebelumnya (jika ada: +X% ▲ atau -X% ▼)
   - Angka muncul dengan count-up animation saat pertama load (vanilla JS)
   - Kartu: Total Klik, Klik Hari Ini, Klik Minggu Ini, Links Aktif

3. **Klik Chart (7 Hari):**
   - Pure CSS bar chart (jangan pakai library chart)
   - Bar berwarna emerald dengan hover tooltip (tanggal + jumlah klik)
   - Label tanggal di bawah bar
   - Y-axis labels di kiri (angka tertinggi, tengah, 0)
   - Responsive: scroll horizontal di mobile

4. **Top 5 Links Table:**
   - Kolom: Rank (1-5), Icon + Judul Link, URL (truncated), Klik, Bar visual
   - Bar visual: progress bar yang panjangnya proporsional dengan klik tertinggi
   - Tombol kecil "Edit" di setiap row
   - Empty state jika belum ada klik

5. **Preview Halaman Publik:**
   - Mockup kecil di sidebar kanan (desktop)
   - Tampilkan avatar, nama, 3 links pertama
   - Tombol "Buka" dan "Salin Link" (copy to clipboard dengan toast)
   - "Share" section kecil: tombol copy URL yang elegant

6. **Plan Usage Widget:**
   - Circular progress atau linear progress bar
   - "X dari Y link digunakan"
   - Warna berubah: hijau (<60%), kuning (60-90%), merah (>90%)
   - CTA "Upgrade ke Pro" jika plan Free/Student

---

### STEP 3 — Quick Actions (Floating Action Button Mobile)
Di layout `app.blade.php`, tambahkan:
- FAB (Floating Action Button) di mobile only (fixed bottom right)
- Klik FAB: expand menjadi 3 opsi: "Tambah Link", "Preview", "Share"
- Smooth expand animation

---

### STEP 4 — Profile Edit Page
Buat `resources/views/profile/edit.blade.php` dan update `ProfileController.php`:

Halaman edit profil lengkap:
- Upload avatar: drag & drop zone ATAU klik untuk browse
  * Preview gambar sebelum upload
  * Validasi: max 2MB, format jpg/png/webp
  * Jika avatar ada, tampilkan dengan tombol "Hapus"
- Field: Nama lengkap, Username, Bio (textarea dengan char counter 150),
  Email (readonly, dengan note "Hubungi support untuk mengubah email")
- Section "Tampilan Halaman" (hanya plan Student ke atas):
  * Color picker untuk background color
  * Pilihan tema: Default, Dark, Gradient, Minimal
  * Preview real-time perubahan tema (update CSS variable via JS)
  * Jika plan Free: section terkunci dengan overlay "Upgrade ke Pro"
- Tombol "Simpan Perubahan" + "Pratinjau Halaman"

---

### STEP 5 — Notifications & Empty States Polish

Pastikan semua halaman memiliki empty state yang menarik:

**Links Index (empty):**
- Ilustrasi (SVG inline) + "Belum ada link. Mulai tambahkan link pertamamu!"
- CTA button langsung ke form tambah

**Dashboard (baru register):**
- Onboarding card: 3 langkah (Setup profil → Tambah links → Bagikan URL)
- Setiap langkah ada status (done/pending) berdasarkan data user
- Progress tracker horizontal

**Billing (belum ada transaksi):**
- Teks simpel + icon invoice

---

### STEP 6 — Global UI Polish

Tinjau dan perbaiki di semua halaman:

**A. Loading States:**
- Tombol submit: ganti teks jadi spinner + "Menyimpan..." saat loading
- Table/list: skeleton loading saat fetch data (pure CSS skeleton)
- Gunakan konsisten di semua form

**B. Transitions & Animations:**
- Page load: fade-in pada main content (CSS)
- Sidebar nav items: smooth hover state
- Modal open/close: backdrop fade + content scale
- Alert/toast: slide in/out
- Semua transitions: 150-200ms ease-out

**C. Responsive Polish:**
- Cek semua breakpoint: sm (640), md (768), lg (1024), xl (1280)
- Sidebar menjadi bottom navigation di mobile
- Table menjadi card list di mobile (sembunyikan kolom tidak penting)
- Floating action button di mobile

**D. Accessibility:**
- Semua interactive elements punya focus:ring
- Form labels terhubung ke inputs (htmlFor)
- Alt text untuk images
- ARIA labels untuk icon-only buttons
- Keyboard navigable modals (trap focus, Escape to close)

---

### STEP 7 — Error Pages
Buat halaman error custom:

**`resources/views/errors/404.blade.php`:**
- Layout public (tanpa auth)
- Ilustrasi/visual "404" yang fun
- Pesan: "Halaman tidak ditemukan"
- Untuk /username yang tidak ada: "Hmm, @username belum terdaftar di BioKuy.
  Kamu bisa mendaftarkannya!" dengan CTA register

**`resources/views/errors/429.blade.php`:**
- Rate limit exceeded
- Pesan friendly + countdown timer

**`resources/views/errors/500.blade.php`:**
- Server error
- Pesan friendly tanpa expose teknis

---

### STEP 8 — SEO & Meta Tags
Update layouts dengan meta tags:

**Landing Page:**
- OG tags, twitter cards, canonical URL
- Structured data (JSON-LD) untuk website

**Halaman Publik (/username):**
- Dynamic OG tags berdasarkan data user
- `og:title`: "[Nama] | BioKuy"
- `og:description`: Bio user
- `og:image`: Avatar user (atau default)
- Canonical URL

---

### STEP 9 — Performance Optimizations

**A. Eager Loading:**
Review semua Controller, pastikan tidak ada N+1 query:
```php
// LinkController
$links = auth()->user()->links()->ordered()->get();

// DashboardController  
$user = auth()->user()->load(['links' => fn($q) => $q->active()]);
```

**B. View Caching:**
- Cache data statistik dashboard selama 5 menit per user
- `Cache::remember("dashboard_stats_{$userId}", 300, fn() => ...)`

**C. Asset Optimization:**
- Pastikan `npm run build` menghasilkan assets yang ter-minify
- Inline critical CSS untuk above-the-fold content halaman publik

---

### STEP 10 — Production Checklist & Deployment Guide

Setelah semua kode diberikan, sertakan **Production Checklist** berformat:

**PRE-DEPLOYMENT:**
- [ ] Semua .env production values diset
- [ ] APP_DEBUG=false di production
- [ ] APP_ENV=production
- [ ] Generate APP_KEY: php artisan key:generate
- [ ] Midtrans keys sudah diganti ke production keys
- [ ] Database migration sudah dijalankan
- [ ] Storage link: php artisan storage:link
- [ ] Optimisasi: php artisan optimize
- [ ] Build assets: npm run build
- [ ] Queue worker (jika ada jobs): php artisan queue:work

**POST-DEPLOYMENT:**
- [ ] Test complete user flow: register → add links → checkout → view public page
- [ ] Test Midtrans sandbox payment
- [ ] Test responsive di mobile
- [ ] Cek semua routes tidak 404/500
- [ ] Setup cron untuk artisan schedule:run (jika ada scheduled tasks)

---

### OUTPUT YANG DIHARAPKAN:
1. `DashboardController.php` (update lengkap)
2. `resources/views/dashboard/index.blade.php` (full dashboard)
3. Update `resources/views/layouts/app.blade.php` (FAB, polish)
4. `resources/views/profile/edit.blade.php`
5. Update `ProfileController.php`
6. Update semua empty states di view yang ada
7. `resources/views/errors/404.blade.php`
8. `resources/views/errors/429.blade.php`
9. `resources/views/errors/500.blade.php`
10. Update semua layout dengan SEO meta tags
11. `resources/js/dashboard.js` (count-up, chart, copy, greeting)
12. Production Checklist lengkap
13. Summary semua file yang dibuat/diubah selama 5 phase
```

---

---

## 💡 TIPS PENGGUNAAN MASTER PROMPT INI

### Urutan Kerja yang Disarankan:
```
Phase 1 → Test: php artisan migrate, npm run dev
Phase 2 → Test: Register, Login, Landing page tampil
Phase 3 → Test: Tambah link, drag & drop, kunjungi /{username}
Phase 4 → Test: Klik upgrade, Midtrans popup muncul, callback berfungsi
Phase 5 → Test: Dashboard stats real, semua responsive, polish OK
```

### Jika AI Memberikan Kode yang Error:
Gunakan prompt lanjutan ini:
```
Error yang saya dapat:
[paste error message]

Context: Saya sedang di Phase [X] project BioKuy Laravel 12.
File yang bermasalah: [nama file]

Tolong perbaiki kode tersebut. Berikan kode lengkapnya (bukan hanya bagian yang diubah).
Jelaskan penyebab error dan cara mencegahnya di file lain.
```

### Jika Ingin Menambah Fitur:
```
Saya ingin menambahkan fitur [nama fitur] ke project BioKuy.
Context: Stack Laravel 12, Tailwind v4, design system BioKuy sudah ada.

Fitur ini harus:
- Konsisten dengan design system yang ada (.card, .btn-primary, dll)
- Tidak break existing features
- Mengikuti coding style yang sudah ada (Form Request, Service class, dll)

Berikan: migration (jika perlu), model update, controller, view, dan update routes.
```

---

## 📊 Ringkasan Semua File yang Akan Dibuat

| Phase | Jumlah File | File Utama |
|-------|-------------|------------|
| 1 | ~15 file | migrations, models, layouts, config |
| 2 | ~12 file | auth views, landing page, components |
| 3 | ~12 file | link CRUD, public profile, JS |
| 4 | ~10 file | billing, checkout, midtrans service |
| 5 | ~12 file | dashboard, profile edit, error pages |
| **Total** | **~61 file** | |

---

*BioKuy Master Prompt Strategy — Dibuat untuk Vibe Coding dengan AI*
*Gunakan Claude Sonnet 4 atau Opus 4 untuk hasil terbaik*
