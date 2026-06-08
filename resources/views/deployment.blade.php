<?php

/**
 * resources/views/deployment.blade.php
 *
 * Deployment documentation page. Provides an overview of the infrastructure:
 *   - AWS EC2 as web server
 *   - AWS RDS as database
 *   - Cloudflare as DNS and reverse proxy
 *   - GitHub Actions for CI/CD automation
 *
 * The page uses the existing guest layout and applies modern UI aesthetics
 * (gradient background, glassmorphism cards, subtle animations).
 */
?>
<x-guest-layout>
    <x-slot name="title">Deployment Documentation</x-slot>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700 text-white p-8">
        <div class="max-w-5xl mx-auto space-y-12">
            <!-- Header -->
            <div class="text-center space-y-4 animate-fade-in">
                <h1 class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">
                    Deployment Documentation
                </h1>
                <p class="text-lg text-gray-300">
                    How this project is hosted, secured and continuously delivered.
                </p>
            </div>

            <!-- Cards Container -->
            <div class="grid gap-8 md:grid-cols-2">
                <!-- EC2 Card -->
                <div class="bg-white/10 backdrop-blur-xl rounded-xl border border-white/20 p-6 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold mb-3 text-indigo-300">
                        🖥️ AWS EC2 – Web Server
                    </h2>
                    <p class="text-gray-200 mb-2">
                        The application runs on an Ubuntu 22.04 LTS EC2 instance behind a security group that only allows
                        HTTP/HTTPS (80/443) from Cloudflare IPs.
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300">
                        <li>Instance type: <code>t3.medium</code> (2 vCPU, 4 GiB RAM)</li>
                        <li>Deployment directory: <code>/var/www/biokuy</code></li>
                        <li>Web server: <code>nginx</code> with PHP‑FPM pool</li>
                        <li>Automatic reloading via <code>systemd</code> service</li>
                    </ul>
                </div>

                <!-- RDS Card -->
                <div class="bg-white/10 backdrop-blur-xl rounded-xl border border-white/20 p-6 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold mb-3 text-green-300">
                        📦 AWS RDS – Database
                    </h2>
                    <p class="text-gray-200 mb-2">
                        Managed MySQL 8.0 instance, isolated in a private subnet.
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300">
                        <li>Endpoint stored in <code>.env</code> as <code>DB_HOST</code></li>
                        <li>Credentials managed via AWS Secrets Manager</li>
                        <li>Automated daily snapshots and Multi‑AZ for high availability</li>
                        <li>Connection encrypted with TLS 1.2+</li>
                    </ul>
                </div>

                <!-- Cloudflare Card -->
                <div class="bg-white/10 backdrop-blur-xl rounded-xl border border-white/20 p-6 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold mb-3 text-yellow-300">
                        ☁️ Cloudflare – DNS & Reverse Proxy
                    </h2>
                    <p class="text-gray-200 mb-2">
                        Cloudflare provides DNS resolution, SSL termination and caching.
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300">
                        <li>Domain points to Cloudflare; Cloudflare forwards to EC2 via a CNAME</li>
                        <li>SSL mode: Full (strict) – end‑to‑end encryption</li>
                        <li>Web Application Firewall (WAF) rules enabled</li>
                        <li>Automatic HTTP/2 and Brotli compression</li>
                    </ul>
                </div>

                <!-- GitHub Actions Card -->
                <div class="bg-white/10 backdrop-blur-xl rounded-xl border border-white/20 p-6 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold mb-3 text-purple-300">
                        🚀 GitHub Actions – CI/CD
                    </h2>
                    <p class="text-gray-200 mb-2">
                        The workflow builds the Laravel app, runs tests and deploys to the EC2 instance.
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300">
                        <li>Workflow file: <code>.github/workflows/deploy.yml</code></li>
                        <li>Jobs:
                            <ul class="ml-4 list-disc">
                                <li>Setup PHP & Composer</li>
                                <li>Run <code>php artisan test</code></li>
                                <li>SSH into EC2 and pull latest changes</li>
                                <li>Run migrations, cache clear, queue restart</li>
                            </ul>
                        </li>
                        <li>Secrets stored in repository settings (AWS_SSH_KEY, EC2_HOST, etc.)</li>
                    </ul>
                </div>
            </div>

            <!-- Footer navigation -->
            <div class="text-center mt-8 animate-fade-in">
                <a href="{{ route('landing') }}" class="inline-block px-6 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-md transition-colors">
                    ← Kembali ke Landing Page
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
