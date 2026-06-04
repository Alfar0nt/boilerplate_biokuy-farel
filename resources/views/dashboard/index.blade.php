<x-app-layout>
    <x-slot:breadcrumb>Dashboard</x-slot:breadcrumb>
    <x-slot:header>Dashboard</x-slot:header>

    <div class="animate-fade-in">
        <div class="mb-6">
            <p class="text-text-secondary">
                Selamat datang kembali, <span class="font-semibold text-text-primary">{{ $user->name }}</span>! 👋
            </p>
        </div>

        @php
            $hasUsername = !empty($user->username);
            $hasAvatar = !empty($user->avatar_url);
            $hasBio = !empty($user->bio);
            $hasLinks = $linksCount > 0;
            $profileCompleted = $hasUsername && $hasAvatar && $hasBio && $hasLinks;
        @endphp

        @if(!$profileCompleted)
            <div class="card bg-brand-primary/5 border-brand-primary/20 mb-8 animate-fade-in">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2">
                        <h3 class="font-bold text-text-primary text-lg flex items-center gap-2">
                            <span>Lengkapi Profil BioKuy Anda! 🚀</span>
                        </h3>
                        <p class="text-sm text-text-secondary">
                            Profil yang lengkap dan menarik dapat meningkatkan interaksi pengunjung. Selesaikan langkah berikut untuk mengoptimalkan halaman Anda:
                        </p>
                        
                        <div class="flex flex-wrap gap-x-6 gap-y-2.5 mt-3 text-sm">
                            <div class="flex items-center gap-2">
                                @if($hasUsername)
                                    <span class="text-success font-semibold flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Username
                                    </span> 
                                @else
                                    <a href="{{ route('profile.edit') }}" class="text-text-muted hover:text-brand-primary flex items-center gap-1.5 transition-colors">
                                        <div class="w-4.5 h-4.5 rounded-full border border-text-muted/50 flex items-center justify-center text-[10px]"></div>
                                        Atur Username
                                    </a>
                                @endif
                            </div>
                            
                            <div class="flex items-center gap-2">
                                @if($hasAvatar)
                                    <span class="text-success font-semibold flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Foto Profil
                                    </span>
                                @else
                                    <a href="{{ route('profile.edit') }}" class="text-text-muted hover:text-brand-primary flex items-center gap-1.5 transition-colors">
                                        <div class="w-4.5 h-4.5 rounded-full border border-text-muted/50 flex items-center justify-center text-[10px]"></div>
                                        Unggah Foto Profil
                                    </a>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                @if($hasBio)
                                    <span class="text-success font-semibold flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Bio Singkat
                                    </span>
                                @else
                                    <a href="{{ route('profile.edit') }}" class="text-text-muted hover:text-brand-primary flex items-center gap-1.5 transition-colors">
                                        <div class="w-4.5 h-4.5 rounded-full border border-text-muted/50 flex items-center justify-center text-[10px]"></div>
                                        Tulis Bio Singkat
                                    </a>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                @if($hasLinks)
                                    <span class="text-success font-semibold flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Tautan Pertama
                                    </span>
                                @else
                                    <a href="{{ route('links.create') }}" class="text-text-muted hover:text-brand-primary flex items-center gap-1.5 transition-colors">
                                        <div class="w-4.5 h-4.5 rounded-full border border-text-muted/50 flex items-center justify-center text-[10px]"></div>
                                        Tambah Link Pertama
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('profile.edit') }}" class="btn-primary py-2 px-4.5 text-xs">
                            Atur Profil Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="card-hover">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-brand-primary/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </div>
                    <span class="{{ $user->getActivePlan()->badgeClass() }}">{{ $user->getActivePlan()->label() }}</span>
                </div>
                <p class="text-2xl font-bold text-text-primary">{{ $linksCount }}</p>
                <p class="text-sm text-text-muted">Total Links</p>
            </div>

            <div class="card-hover">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-success/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-text-primary">{{ $activeLinksCount }}</p>
                <p class="text-sm text-text-muted">Active Links</p>
            </div>

            <div class="card-hover">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-brand-secondary/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-brand-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-text-primary">{{ number_format($totalClicks) }}</p>
                <p class="text-sm text-text-muted">Total Clicks</p>
            </div>

            <div class="card-hover">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-warning/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-text-primary">{{ $linksCount }}/{{ $linkLimit === PHP_INT_MAX ? '∞' : $linkLimit }}</p>
                <p class="text-sm text-text-muted">Link Usage</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
            {{-- Quick Actions --}}
            <div class="card lg:col-span-2 flex flex-col justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-text-primary mb-4">Quick Actions</h2>
                    <p class="text-xs text-text-muted mb-6">Kelola halaman BioKuy Anda dengan tombol akses cepat di bawah ini.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('links.create') }}" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Link
                    </a>
                    <a href="{{ $user->public_url }}" target="_blank" class="btn-secondary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Lihat Profile
                    </a>
                    <a href="{{ route('billing.index') }}" class="btn-ghost">
                        Upgrade Plan →
                    </a>
                </div>
            </div>

            {{-- Quick Analytics --}}
            <div>
                @if(auth()->user()->getActivePlan() === \App\Enums\PlanEnum::Pro)
                    <div class="card p-5 bg-white border border-border h-full flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-bold text-text-primary text-sm">Tautan Terpopuler</h3>
                                <span class="text-[10px] bg-brand-primary/10 text-brand-primary px-2 py-0.5 rounded font-semibold">Live</span>
                            </div>
                            
                            <div class="space-y-3">
                                @php
                                    $popularLinks = $user->links()->orderByDesc('click_count')->take(3)->get();
                                @endphp
                                @forelse($popularLinks as $popLink)
                                    <div class="space-y-1">
                                        <div class="flex justify-between text-xs font-medium">
                                            <span class="text-text-primary truncate max-w-[130px] font-semibold">{{ $popLink->title }}</span>
                                            <span class="text-text-secondary font-bold">{{ $popLink->click_count }} klik</span>
                                        </div>
                                        <div class="w-full bg-border rounded-full h-1">
                                            <div class="bg-brand-primary h-1 rounded-full" style="width: {{ $totalClicks > 0 ? ($popLink->click_count / $totalClicks) * 100 : 0 }}%"></div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-xs text-text-muted text-center py-4">Belum ada data klik.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Locked state --}}
                    <div class="card p-5 bg-white border border-border relative overflow-hidden h-full min-h-[170px] flex flex-col justify-center">
                        <div class="absolute inset-0 bg-white/80 backdrop-blur-[1px] flex flex-col items-center justify-center text-center p-4 z-10">
                            <svg class="w-7 h-7 text-brand-primary mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <h5 class="font-bold text-text-primary text-[11px]">Analitik Pengunjung</h5>
                            <p class="text-[9px] text-text-muted max-w-[170px] mt-0.5 mb-2.5">
                                Analitik klik rujukan dan performa link detail hanya untuk paket **PRO**.
                            </p>
                            <a href="{{ route('billing.index') }}" class="btn-primary py-1 px-2.5 text-[9px] bg-brand-primary hover:bg-brand-primary-hover">
                                Aktifkan Pro
                            </a>
                        </div>

                        {{-- Blurred dummy --}}
                        <div class="filter blur-[3px] select-none space-y-3">
                            <div class="flex justify-between text-[9px]">
                                <span>Portfolio Web</span>
                                <span>382 klik</span>
                            </div>
                            <div class="w-full bg-slate-100 h-1 rounded-full">
                                <div class="bg-slate-300 h-1 rounded-full" style="width: 70%"></div>
                            </div>
                            <div class="flex justify-between text-[9px]">
                                <span>Instagram Profile</span>
                                <span>145 klik</span>
                            </div>
                            <div class="w-full bg-slate-100 h-1 rounded-full">
                                <div class="bg-slate-300 h-1 rounded-full" style="width: 35%"></div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
