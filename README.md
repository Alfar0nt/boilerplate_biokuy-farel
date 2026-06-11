<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<h1 align="center">BioKuy — Link-in-Bio Platform</h1>

<p align="center">
  <strong>Satu Link untuk Semua Platform.</strong><br>
  A modern, open-source link-in-bio application built with Laravel 12.
</p>

---

## What is BioKuy?

BioKuy is a **link-in-bio** platform — similar to Linktree — that lets users create a single, customizable landing page to house all their important links (social media, portfolio, store, etc.). Instead of sharing multiple URLs, users share **one link** that leads to their personalized BioKuy page.

### Core Features

- **User Authentication** — Registration, login, and email verification powered by Laravel Breeze.
- **Link Management** — Create, edit, reorder, toggle, and delete links via a dashboard. Each link tracks click counts.
- **Public Profile Pages** — Every user gets a public page at `/{username}` that visitors can view without logging in.
- **Subscription Plans** — Three tiers with different capabilities:
  | Plan | Price | Links | Custom Theme | Analytics |
  |------|-------|-------|--------------|-----------|
  | **Free** | Rp 0 | Up to 5 | No | Basic |
  | **Student** | Rp 29,000/mo | Up to 15 | Yes | Standard |
  | **Pro** | Rp 79,000/mo | Unlimited | Yes | Advanced |
- **Payment Integration** — Checkout flow with Midtrans payment gateway and a simulation mode for testing.
- **Avatar Upload** — Profile picture uploads via Cloudinary with automatic fallback to generated avatars.
- **Theme Customization** — Paid users can customize the look and feel of their public profile page.
- **Click Tracking** — Each link records how many times it has been clicked.
- **Responsive UI** — Built with Tailwind CSS 4 and Alpine.js for a modern, mobile-friendly experience.

## Tech Stack

| Layer | Technology |
|-------|-----------|
| **Framework** | Laravel 12 (PHP 8.2+) |
| **Frontend** | Tailwind CSS 4, Alpine.js, Vite 6 |
| **Authentication** | Laravel Breeze |
| **Database** | SQLite (dev) / MySQL 8.4 (production via AWS RDS) |
| **Image Storage** | Cloudinary |
| **Payment Gateway** | Midtrans |
| **CI/CD** | GitHub Actions |
| **Hosting** | AWS EC2 + Cloudflare |

## Project Structure

```
app/
├── Enums/            # PlanEnum (Free, Student, Pro plan definitions)
├── Http/Controllers/
│   ├── Auth/         # Login, Registration, Password management
│   ├── BillingController.php       # Subscription billing page
│   ├── CheckoutController.php      # Midtrans checkout & callbacks
│   ├── DashboardController.php     # User dashboard
│   ├── LandingController.php       # Public landing page
│   ├── LinkController.php          # CRUD for user links
│   ├── ProfileController.php       # Profile editing & theme settings
│   └── PublicProfileController.php # Public profile display & link redirect
├── Models/           # User, Link, Subscription
└── Providers/        # App service provider

resources/views/
├── auth/             # Login & register pages
├── billing/          # Subscription management
├── checkout/         # Payment success, pending, error, simulation
├── dashboard/        # User dashboard
├── links/            # Link CRUD views
├── profile/          # Profile edit & public profile
├── landing.blade.php # Landing page with pricing
└── deployment.blade.php # Deployment documentation page

routes/
├── web.php           # All application routes
└── auth.php          # Breeze authentication routes

database/migrations/  # Users, links, subscriptions, theme settings
.github/workflows/    # GitHub Actions CI/CD pipeline
```

## Local Development Setup

Follow these steps to run BioKuy on your own machine:

### Prerequisites

- **PHP** >= 8.2
- **Composer** (PHP dependency manager)
- **Node.js** & **npm** (for frontend assets)
- **SQLite** (default database) or **MySQL**

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/boilerplate_biokuy-farel.git
   cd boilerplate_biokuy-farel
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies:**
   ```bash
   npm install
   ```

4. **Set up environment variables:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure the database:**

   The default `.env.example` uses **SQLite** (no extra setup needed). Just run:
   ```bash
   touch database/database.sqlite
   ```

   Or, if you prefer MySQL, uncomment and fill these in your `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=biokuy
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

6. **Run database migrations:**
   ```bash
   php artisan migrate
   ```

7. **Optional — Configure Cloudinary (for avatar uploads):**

   Add these to your `.env`:
   ```
   CLOUDINARY_URL=cloudinary://YOUR_KEY:YOUR_SECRET@YOUR_CLOUD_NAME
   CLOUDINARY_UPLOAD_PRESET=your_preset
   ```
   If you skip this, avatar uploads won't work, but generated fallback avatars will still display.

8. **Optional — Configure Midtrans (for payment):**

   Add your Midtrans credentials to `.env` for the checkout flow to work.

9. **Start the development server:**
   ```bash
   composer dev
   ```
   This runs the Laravel server, Vite dev server, queue listener, and log viewer concurrently.

   Alternatively, run them separately:
   ```bash
   php artisan serve    # Laravel server
   npm run dev         # Vite dev server
   ```

10. **Open the app:**

    Visit `http://localhost:8000` in your browser.

### Running Tests

```bash
php artisan test
```

## Deployment (Production — AWS + Cloudflare)

The deployment architecture for this project is documented in detail on the **Deployment Documentation page** accessible at the `/deployment` route in the app (source: [`resources/views/deployment.blade.php`](resources/views/deployment.blade.php)).

Here is a summary of the infrastructure used:

### Infrastructure Overview

| Component | Service | Details |
|-----------|---------|---------|
| **Web Server** | AWS EC2 | Debian 13 LTS, `t3.medium` (2 vCPU, 4 GiB RAM), Nginx + PHP-FPM |
| **Database** | AWS RDS | Managed MySQL 8.4, private subnet, automated snapshots, Multi-AZ |
| **DNS & SSL** | Cloudflare | Full (strict) SSL, WAF, HTTP/2, Brotli compression |
| **CI/CD** | GitHub Actions | Automated deploy on push to `main` branch |

### How to Deploy Like This

If you want to replicate this deployment setup on AWS, here are the steps:

#### 1. Set Up the EC2 Instance

- Launch a **Debian 13 LTS** instance on AWS EC2 (type `t3.medium` or similar).
- Configure the **Security Group** to only allow HTTP/HTTPS (ports 80/443) from [Cloudflare IP ranges](https://www.cloudflare.com/ips/).
- SSH into the instance and install:
  ```bash
  sudo apt update && sudo apt install -y nginx php8.2-fpm php8.2-cli php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-sqlite3 git composer nodejs npm
  ```
- Clone the repository to the deployment directory:
  ```bash
  sudo mkdir -p /var/www/biokuy
  sudo git clone https://github.com/your-username/boilerplate_biokuy-farel.git /var/www/biokuy
  ```
- Set up the `.env` file on the server with production values (database credentials, app key, Cloudinary, Midtrans, etc.).
- Configure **Nginx** to serve the app from `/var/www/biokuy/public` with PHP-FPM.

#### 2. Set Up the RDS Database

- Create a **MySQL 8.4** RDS instance in a private subnet.
- Enable **Multi-AZ** for high availability and **automated daily snapshots**.
- Store credentials in **AWS Secrets Manager**.
- Configure the `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in the EC2 `.env` file.
- Ensure TLS 1.2+ encryption for the database connection.

#### 3. Configure Cloudflare

- Add your domain to Cloudflare.
- Set a **CNAME** record pointing to your EC2 instance's public IP or DNS.
- Set SSL mode to **Full (strict)** for end-to-end encryption.
- Enable the **Web Application Firewall (WAF)**, HTTP/2, and Brotli compression.

#### 4. Set Up GitHub Actions CI/CD

The project includes a GitHub Actions workflow at [`.github/workflows/deploy.yml`](.github/workflows/deploy.yml) that automatically deploys on every push to `main`.

Add these **secrets** to your GitHub repository settings (`Settings > Secrets and variables > Actions`):

| Secret | Description |
|--------|-------------|
| `EC2_HOST` | Your EC2 instance's public IP or hostname |
| `EC2_USERNAME` | SSH username (e.g., `admin` for Debian) |
| `EC2_SSH_KEY` | The private SSH key for accessing your EC2 instance |

On every push to `main`, the workflow will:

1. SSH into the EC2 instance
2. Pull the latest code (`git reset --hard origin/main`)
3. Install PHP dependencies (`composer install --optimize-autoloader`)
4. Install Node dependencies and build assets (`npm install && npm run build`)
5. Run database migrations (`php artisan migrate --force`)
6. Clear and rebuild Laravel caches (`optimize:clear`, `config:cache`, `route:cache`, `view:cache`)

#### 5. First-Time Production Setup on EC2

After cloning and configuring `.env` on the server, run:
```bash
cd /var/www/biokuy
composer install --no-interaction --prefer-dist --optimize-autoloader
npm install && npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Set proper permissions:
```bash
sudo chown -R www-data:www-data /var/www/biokuy/storage /var/www/biokuy/bootstrap/cache
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
