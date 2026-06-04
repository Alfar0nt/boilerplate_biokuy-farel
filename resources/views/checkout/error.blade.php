<x-app-layout>
    <x-slot:breadcrumb>Payment Failed</x-slot:breadcrumb>
    <x-slot:header>Pembayaran Gagal</x-slot:header>

    <div class="animate-fade-in max-w-md mx-auto text-center py-10">
        <div class="card p-8 bg-white border border-border shadow-elevated">
            {{-- Error Icon --}}
            <div class="w-20 h-20 bg-danger/10 rounded-full flex items-center justify-center mx-auto mb-6 text-danger animate-scale-in">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <h2 class="text-2xl font-extrabold text-text-primary mb-2">Pembayaran Gagal / Dibatalkan</h2>
            <p class="text-sm text-text-secondary mb-6">
                Sayang sekali, transaksi pembayaran Anda tidak berhasil diselesaikan atau telah dibatalkan secara manual.
            </p>

            <div class="space-y-3">
                <a href="{{ route('billing.index') }}" class="btn-primary w-full justify-center py-3 text-sm cursor-pointer">
                    Coba Upgrade Lagi
                </a>
                <a href="{{ route('dashboard') }}" class="btn-secondary w-full justify-center py-3 text-sm cursor-pointer">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
