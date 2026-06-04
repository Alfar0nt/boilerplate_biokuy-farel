# 🚀 BioKuy — System Detail

### Aplikasi SaaS Linktree Clone Sederhana Menggunakan Laravel 12, Tailwind CSS v4, dan Midtrans Payment Gateway

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
