<x-guest-layout>
    <x-slot:title>BioKuy — Satu Link untuk Semua</x-slot:title>

    <div class="w-full max-w-5xl mx-auto px-4 py-8">
        <div class="text-center max-w-2xl mx-auto animate-fade-in mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-primary/10 text-brand-primary text-sm font-medium mb-6">
                <span class="w-2 h-2 rounded-full bg-brand-primary animate-pulse"></span>
                Link-in-Bio untuk semua orang
            </div>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-text-primary leading-tight mb-4">
                Satu Link.<br>
                <span class="bg-gradient-to-r from-brand-primary to-brand-secondary bg-clip-text text-transparent">Semua Platform.</span>
            </h1>
            <p class="text-lg text-text-secondary max-w-lg mx-auto mb-8">
                Buat halaman link-in-bio profesional dalam hitungan menit. Gratis untuk memulai.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('register') }}" class="btn-primary text-base px-8 py-3">
                    Mulai Gratis
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
                <a href="{{ route('login') }}" class="btn-ghost text-base px-6 py-3">
                    Sudah punya akun? Login
                </a>
            </div>
        </div>

        <div class="mt-20 animate-fade-in" style="animation-delay: 150ms;">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-text-primary mb-3">Pilihan Paket Langganan</h2>
                <p class="text-text-secondary">Pilih paket yang paling cocok untuk memaksimalkan personal branding Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                <div class="card-hover flex flex-col justify-between p-8 relative">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="badge-free">Free</span>
                        </div>
                        <div class="mb-6">
                            <span class="text-4xl font-extrabold text-text-primary">Rp 0</span>
                            <span class="text-text-secondary text-sm">/ selamanya</span>
                        </div>
                        <p class="text-sm text-text-secondary mb-6">Cocok untuk pemula yang ingin mencoba link-in-bio sederhana.</p>
                        
                        <ul class="space-y-3.5">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-text-secondary font-medium">Maksimal 5 Tautan</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-text-secondary font-medium">Analitik Dasar</span>
                            </li>
                            <li class="flex items-start gap-3 opacity-60">
                                <svg class="w-5 h-5 text-text-muted shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-sm text-text-muted line-through">Tema Kustom</span>
                            </li>
                            <li class="flex items-start gap-3 opacity-60">
                                <svg class="w-5 h-5 text-text-muted shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-sm text-text-muted line-through">Analitik Tingkat Lanjut</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ auth()->check() ? route('billing.index') : route('register', ['plan' => 'free']) }}" class="btn-secondary w-full justify-center mt-8">
                        Mulai Gratis
                    </a>
                </div>

                <div class="card-hover flex flex-col justify-between p-8 relative border-2 border-brand-primary bg-surface-elevated overflow-hidden shadow-elevated">
                    <div class="absolute top-0 right-0 bg-brand-primary text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-bl-lg">
                        Populer
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="badge-student">Student</span>
                        </div>
                        <div class="mb-6">
                            <span class="text-4xl font-extrabold text-text-primary">Rp 29k</span>
                            <span class="text-text-secondary text-sm">/ bulan</span>
                        </div>
                        <p class="text-sm text-text-secondary mb-6">Pilihan pas bagi mahasiswa atau pelajar untuk berkreasi.</p>
                        
                        <ul class="space-y-3.5">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-text-secondary font-medium">Maksimal 15 Tautan</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-text-secondary font-medium">Tema Kustom</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-text-secondary font-medium">Analitik Standar</span>
                            </li>
                            <li class="flex items-start gap-3 opacity-60">
                                <svg class="w-5 h-5 text-text-muted shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-sm text-text-muted line-through">Analitik Tingkat Lanjut</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ auth()->check() ? route('billing.index', ['plan' => 'student']) : route('register', ['plan' => 'student']) }}" class="btn-primary w-full justify-center mt-8 bg-brand-secondary hover:bg-brand-secondary-hover">
                        Pilih Student
                    </a>
                </div>

                <div class="card-hover flex flex-col justify-between p-8 relative">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="badge-pro">Pro</span>
                        </div>
                        <div class="mb-6">
                            <span class="text-4xl font-extrabold text-text-primary">Rp 79k</span>
                            <span class="text-text-secondary text-sm">/ bulan</span>
                        </div>
                        <p class="text-sm text-text-secondary mb-6">Fitur terlengkap tanpa batasan untuk branding profesional.</p>
                        
                        <ul class="space-y-3.5">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-text-secondary font-medium">Tautan Tanpa Batas</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-text-secondary font-medium">Tema Kustom Bebas</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-text-secondary font-medium">Analitik Tingkat Lanjut</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-text-secondary font-medium">Prioritas Bantuan CS</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ auth()->check() ? route('billing.index', ['plan' => 'pro']) : route('register', ['plan' => 'pro']) }}" class="btn-primary w-full justify-center mt-8">
                        Pilih Pro
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
