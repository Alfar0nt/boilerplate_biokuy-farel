<x-app-layout>
    <x-slot:breadcrumb>Payment Simulation</x-slot:breadcrumb>
    <x-slot:header>Simulasi Pembayaran (Midtrans SandBox)</x-slot:header>

    <div class="animate-fade-in max-w-xl mx-auto">
        <div class="card p-6 border border-border shadow-elevated bg-white">
            <div class="text-center pb-6 border-b border-border mb-6">
                <div class="w-12 h-12 rounded-full bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <h3 class="font-bold text-text-primary text-lg">BioKuy Payment Gateway</h3>
                <p class="text-xs text-text-muted mt-1">Simulasi Pembayaran Midtrans SandBox</p>
            </div>

            <div class="space-y-4 mb-8">
                <div class="flex items-center justify-between text-sm py-1">
                    <span class="text-text-secondary">Paket Upgrade</span>
                    <span class="font-bold text-text-primary uppercase">{{ $planLabel }}</span>
                </div>
                <div class="flex items-center justify-between text-sm py-1">
                    <span class="text-text-secondary">Metode Pembayaran</span>
                    <span class="font-medium text-text-primary">Simulasi Bank Transfer</span>
                </div>
                <div class="flex items-center justify-between text-sm py-1 border-t border-border pt-4">
                    <span class="text-text-primary font-semibold">Total Tagihan</span>
                    <span class="text-xl font-bold text-brand-primary">Rp {{ number_format($amount) }}</span>
                </div>
            </div>

            <div class="space-y-3">
                <p class="text-xs text-text-muted text-center mb-4">
                    Pilih skenario pembayaran di bawah ini untuk mensimulasikan respons webhook Midtrans:
                </p>

                <div class="grid grid-cols-1 gap-2.5">
                    {{-- Sukses --}}
                    <a href="{{ route('checkout.success') }}" class="btn-primary w-full py-3 text-sm justify-center cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Simulasi Pembayaran Sukses
                    </a>

                    {{-- Pending --}}
                    <a href="{{ route('checkout.pending') }}" class="btn-primary w-full py-3 text-sm justify-center bg-warning hover:bg-warning/90 border-none cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Simulasi Pembayaran Pending (Bayar Nanti)
                    </a>

                    {{-- Gagal --}}
                    <a href="{{ route('checkout.error') }}" class="btn-secondary w-full py-3 text-sm justify-center text-danger border-danger hover:bg-danger/10 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Simulasi Pembayaran Gagal / Batal
                    </a>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-border text-center">
                <a href="{{ route('billing.index') }}" class="text-xs text-text-muted hover:text-text-primary transition-colors">
                    Kembali ke Halaman Billing
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
