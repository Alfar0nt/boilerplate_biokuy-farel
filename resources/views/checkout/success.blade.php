<x-app-layout>
    <x-slot:breadcrumb>Payment Success</x-slot:breadcrumb>
    <x-slot:header>Pembayaran Sukses</x-slot:header>

    <div class="animate-fade-in max-w-md mx-auto text-center py-10">
        <div class="card p-8 bg-white border border-border shadow-elevated">
            {{-- Checkmark Animation Circle --}}
            <div class="w-20 h-20 bg-success/10 rounded-full flex items-center justify-center mx-auto mb-6 text-success animate-scale-in">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h2 class="text-2xl font-extrabold text-text-primary mb-2">Terima Kasih! 🎉</h2>
            <p class="text-sm text-text-secondary mb-6">
                Pembayaran Anda berhasil diverifikasi. Akun Anda kini resmi ditingkatkan ke paket <span class="font-bold text-brand-primary uppercase">{{ $planLabel }}</span>.
            </p>

            <div class="space-y-3">
                <a href="{{ route('dashboard') }}" class="btn-primary w-full justify-center py-3 text-sm cursor-pointer">
                    Masuk ke Dashboard
                </a>
                <a href="{{ route('links.index') }}" class="btn-secondary w-full justify-center py-3 text-sm cursor-pointer">
                    Mulai Tambahkan Link
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
