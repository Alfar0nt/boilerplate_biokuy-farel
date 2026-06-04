<x-app-layout>
    <x-slot:breadcrumb>Billing</x-slot:breadcrumb>
    <x-slot:header>Langganan & Tagihan</x-slot:header>

    <div class="animate-fade-in space-y-8">
        {{-- Status Langganan Saat Ini --}}
        <div class="card p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 bg-gradient-to-br from-surface-elevated to-surface-muted border border-border">
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <h3 class="font-bold text-text-primary text-lg">Paket Aktif Anda</h3>
                    <span class="{{ $currentPlan->badgeClass() }}">{{ $currentPlan->label() }}</span>
                </div>
                
                @if($currentPlan === \App\Enums\PlanEnum::Free)
                    <p class="text-sm text-text-secondary">
                        Anda sedang menggunakan paket gratis dengan kapasitas maksimal <span class="font-semibold text-text-primary">5 link</span>. Upgrade untuk menikmati tema kustom dan analitik lanjutan.
                    </p>
                @else
                    <p class="text-sm text-text-secondary">
                        Layanan aktif Anda berakhir pada: <span class="font-semibold text-text-primary">{{ $activeSubscription ? $activeSubscription->expires_at->translatedFormat('d F Y') : '-' }}</span>
                        ({{ $activeSubscription ? $activeSubscription->remainingDays() : 0 }} hari tersisa).
                    </p>
                @endif
            </div>

            @if($currentPlan !== \App\Enums\PlanEnum::Pro)
                <div class="shrink-0">
                    <a href="#pricing-plans" class="btn-primary">
                        Mulai Upgrade
                    </a>
                </div>
            @endif
        </div>

        {{-- Paket Pilihan (Pricing Cards) --}}
        <div id="pricing-plans" class="space-y-4">
            <div>
                <h3 class="font-bold text-text-primary text-lg">Pilih Upgrade Paket Anda</h3>
                <p class="text-sm text-text-muted">Pilih paket langganan di bawah ini untuk meningkatkan kapasitas dan fitur personal branding Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">
                {{-- Free Plan Card --}}
                <div class="card flex flex-col justify-between p-6 bg-surface-elevated border border-border relative {{ $currentPlan === \App\Enums\PlanEnum::Free ? 'ring-2 ring-brand-primary/20' : '' }}">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="badge-free">Free</span>
                            @if($currentPlan === \App\Enums\PlanEnum::Free)
                                <span class="text-xs font-bold text-brand-primary flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-primary animate-ping"></span> Aktif
                                </span>
                            @endif
                        </div>
                        <div class="mb-4">
                            <span class="text-3xl font-extrabold text-text-primary">Rp 0</span>
                            <span class="text-text-secondary text-xs">/ selamanya</span>
                        </div>
                        <p class="text-xs text-text-secondary mb-5">Fitur dasar untuk membuat link-in-bio Anda.</p>
                        
                        <ul class="space-y-3 text-xs">
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-text-secondary font-medium">Maksimal 5 Tautan</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-text-secondary font-medium">Analitik Dasar</span>
                            </li>
                            <li class="flex items-start gap-2.5 opacity-50">
                                <svg class="w-4 h-4 text-text-muted shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-text-muted line-through">Tema Kustom</span>
                            </li>
                        </ul>
                    </div>
                    
                    <button disabled class="btn-secondary w-full justify-center mt-6 opacity-50 cursor-not-allowed">
                        {{ $currentPlan === \App\Enums\PlanEnum::Free ? 'Paket Saat Ini' : 'Mulai Gratis' }}
                    </button>
                </div>

                {{-- Student Plan Card --}}
                <div class="card flex flex-col justify-between p-6 bg-surface-elevated border relative {{ $currentPlan === \App\Enums\PlanEnum::Student ? 'border-2 border-brand-primary ring-2 ring-brand-primary/20' : 'border-border' }}">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="badge-student">Student</span>
                            @if($currentPlan === \App\Enums\PlanEnum::Student)
                                <span class="text-xs font-bold text-brand-secondary flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-secondary animate-ping"></span> Aktif
                                </span>
                            @endif
                        </div>
                        <div class="mb-4">
                            <span class="text-3xl font-extrabold text-text-primary">Rp 29.000</span>
                            <span class="text-text-secondary text-xs">/ bulan</span>
                        </div>
                        <p class="text-xs text-text-secondary mb-5">Pilihan pas bagi mahasiswa atau pelajar untuk berkreasi.</p>
                        
                        <ul class="space-y-3 text-xs">
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-text-secondary font-medium">Maksimal 15 Tautan</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-text-secondary font-medium">Tema Kustom</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-text-secondary font-medium">Analitik Standar</span>
                            </li>
                        </ul>
                    </div>

                    @if($currentPlan === \App\Enums\PlanEnum::Student)
                        <button disabled class="btn-primary w-full justify-center mt-6 bg-brand-secondary opacity-80 cursor-not-allowed">
                            Paket Aktif
                        </button>
                    @else
                        <form method="POST" action="{{ route('checkout.create', 'student') }}">
                            @csrf
                            <button type="submit" class="btn-primary w-full justify-center mt-6 bg-brand-secondary hover:bg-brand-secondary-hover cursor-pointer">
                                Pilih Student
                            </button>
                        </form>
                    @endif
                </div>

                {{-- Pro Plan Card --}}
                <div class="card flex flex-col justify-between p-6 bg-surface-elevated border relative {{ $currentPlan === \App\Enums\PlanEnum::Pro ? 'border-2 border-brand-primary ring-2 ring-brand-primary/20' : 'border-border' }}">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="badge-pro">Pro</span>
                            @if($currentPlan === \App\Enums\PlanEnum::Pro)
                                <span class="text-xs font-bold text-brand-primary flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-primary animate-ping"></span> Aktif
                                </span>
                            @endif
                        </div>
                        <div class="mb-4">
                            <span class="text-3xl font-extrabold text-text-primary">Rp 79.000</span>
                            <span class="text-text-secondary text-xs">/ bulan</span>
                        </div>
                        <p class="text-xs text-text-secondary mb-5">Fitur terlengkap tanpa batasan untuk personal branding profesional.</p>
                        
                        <ul class="space-y-3 text-xs">
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-text-secondary font-medium">Tautan Tanpa Batas</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-text-secondary font-medium">Tema Kustom Bebas</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-brand-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-text-secondary font-medium">Analitik Tingkat Lanjut</span>
                            </li>
                        </ul>
                    </div>

                    @if($currentPlan === \App\Enums\PlanEnum::Pro)
                        <button disabled class="btn-primary w-full justify-center mt-6 opacity-80 cursor-not-allowed">
                            Paket Aktif
                        </button>
                    @else
                        <form method="POST" action="{{ route('checkout.create', 'pro') }}">
                            @csrf
                            <button type="submit" class="btn-primary w-full justify-center mt-6 cursor-pointer">
                                Pilih Pro
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Riwayat Transaksi --}}
        <div class="card p-6">
            <div class="mb-4">
                <h3 class="font-bold text-text-primary text-base">Riwayat Transaksi</h3>
                <p class="text-xs text-text-muted">Semua riwayat tagihan dan status transaksi akun Anda.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-text-secondary border-collapse">
                    <thead>
                        <tr class="border-b border-border text-text-primary font-bold text-xs uppercase bg-surface-muted/50">
                            <th class="py-3 px-4 rounded-l-xl">ID Order</th>
                            <th class="py-3 px-4">Paket</th>
                            <th class="py-3 px-4">Jumlah</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Tanggal Pembelian</th>
                            <th class="py-3 px-4 rounded-r-xl">Tanggal Berakhir</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border/60">
                        @php
                            $history = $user->subscriptions()->latest()->get();
                        @endphp
                        @forelse($history as $sub)
                            <tr class="hover:bg-surface-muted/20 transition-colors">
                                <td class="py-3.5 px-4 font-mono text-xs text-text-primary">{{ $sub->midtrans_order_id ?? $sub->id }}</td>
                                <td class="py-3.5 px-4">
                                    <span class="font-semibold text-text-primary">{{ $sub->plan->label() }}</span>
                                </td>
                                <td class="py-3.5 px-4 font-semibold text-text-primary">
                                    Rp {{ number_format($sub->amount) }}
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($sub->status === 'active')
                                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-success/15 text-success border border-success/20 uppercase tracking-wide">Aktif</span>
                                    @elseif($sub->status === 'pending')
                                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-warning/15 text-warning border border-warning/20 uppercase tracking-wide">Tertunda</span>
                                    @elseif($sub->status === 'expired')
                                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-text-muted/15 text-text-muted border border-text-muted/20 uppercase tracking-wide">Kadaluwarsa</span>
                                    @else
                                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-danger/15 text-danger border border-danger/20 uppercase tracking-wide">Batal</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-xs">{{ $sub->started_at ? $sub->started_at->translatedFormat('d M Y, H:i') : '-' }}</td>
                                <td class="py-3.5 px-4 text-xs">{{ $sub->expires_at ? $sub->expires_at->translatedFormat('d M Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-xs text-text-muted">
                                    Belum ada transaksi pembayaran untuk akun Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
