<x-app-layout>
    <x-slot:breadcrumb>Payment Pending</x-slot:breadcrumb>
    <x-slot:header>Pembayaran Tertunda</x-slot:header>

    <div class="animate-fade-in max-w-md mx-auto text-center py-10">
        <div class="card p-8 bg-white border border-border shadow-elevated">
            {{-- Pending Icon --}}
            <div class="w-20 h-20 bg-warning/10 rounded-full flex items-center justify-center mx-auto mb-6 text-warning animate-scale-in">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            <h2 class="text-2xl font-extrabold text-text-primary mb-2">Menunggu Pembayaran ⏳</h2>
            <p class="text-sm text-text-secondary mb-6">
                Transaksi Anda telah dibuat. Silakan selesaikan pembayaran transfer bank Anda sebelum batas waktu berakhir.
            </p>

            <div class="bg-surface-muted border border-border rounded-xl p-4 mb-6 text-left space-y-3">
                <div class="text-xs">
                    <span class="text-text-muted block font-medium">Bank Penerima</span>
                    <span class="text-text-primary font-bold text-sm">BANK MANDIRI (DUMMY)</span>
                </div>
                <div class="text-xs">
                    <span class="text-text-muted block font-medium">Nomor Rekening Virtual Account</span>
                    <span class="text-text-primary font-mono font-bold text-sm select-all">88012 87654 32109</span>
                </div>
                <div class="text-xs">
                    <span class="text-text-muted block font-medium">Batas Waktu</span>
                    <span class="text-text-primary font-semibold text-xs">24 Jam dari Sekarang</span>
                </div>
            </div>

            <div class="space-y-3">
                <a href="{{ route('billing.index') }}" class="btn-primary w-full justify-center py-3 text-sm cursor-pointer">
                    Cek Status Langganan
                </a>
                <a href="{{ route('dashboard') }}" class="btn-secondary w-full justify-center py-3 text-sm cursor-pointer">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
