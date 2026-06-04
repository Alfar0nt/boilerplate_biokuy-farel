@php
    $isFree = $user->getActivePlan() === \App\Enums\PlanEnum::Free;
    $themeSettings = $user->theme_settings ?? [
        'banner_gradient' => 'from-emerald-400 to-blue-500',
        'card_style' => 'card-shadow',
        'font_family' => 'font-sans',
        'bg_color' => '#f8fafc',
        'show_membership' => 'true'
    ];
    
    // Pastikan key tambahan terisi default jika settings sudah ada di DB sebelumnya
    $themeSettings['bg_color'] = $themeSettings['bg_color'] ?? '#f8fafc';
    $themeSettings['show_membership'] = $themeSettings['show_membership'] ?? 'true';
@endphp

<section class="relative overflow-hidden">
    {{-- Overlay Proteksi Paket Free --}}
    @if($isFree)
        <div class="absolute inset-0 bg-white/80 backdrop-blur-xs z-10 flex flex-col items-center justify-center text-center p-6 transition-all duration-300">
            <div class="w-12 h-12 rounded-full bg-brand-primary/10 text-brand-primary flex items-center justify-center mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h3 class="font-bold text-text-primary text-base">Tema Kustom Terkunci</h3>
            <p class="text-xs text-text-secondary max-w-sm mt-1 mb-4">
                Kustomisasi warna banner, gaya kartu, dan tipe font hanya tersedia bagi pengguna paket <span class="font-bold text-brand-secondary">Student</span> & <span class="font-bold text-brand-primary">Pro</span>.
            </p>
            <a href="{{ route('billing.index') }}" class="btn-primary py-2 px-4.5 text-xs">
                Upgrade Plan Sekarang
            </a>
        </div>
    @endif

    <header>
        <div class="flex items-center gap-2.5">
            <h2 class="text-lg font-medium text-text-primary">
                {{ __('Tema Profil Publik') }}
            </h2>
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-primary/15 text-brand-primary border border-brand-primary/10 uppercase tracking-wide">
                Premium
            </span>
        </div>

        <p class="mt-1 text-sm text-text-secondary">
            {{ __("Kustomisasikan tampilan halaman profil publik Anda dengan berbagai pilihan gaya visual.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.theme.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Pilihan Gradasi Banner --}}
        <div>
            <x-input-label for="banner_gradient" value="Gradasi Banner Atas" />
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 mt-2">
                @foreach([
                    'from-emerald-400 to-blue-500' => 'Emerald Blue',
                    'from-orange-400 to-rose-500' => 'Sunset Gold',
                    'from-sky-400 to-indigo-600' => 'Ocean Blue',
                    'from-purple-500 to-indigo-700' => 'Royal Purple',
                    'from-slate-700 to-slate-900' => 'Charcoal Dark'
                ] as $value => $label)
                    <label class="relative flex flex-col items-center justify-between p-3 rounded-xl border border-border bg-surface-elevated hover:border-brand-primary/30 cursor-pointer select-none transition-all">
                        <input type="radio" name="theme_settings[banner_gradient]" value="{{ $value }}" class="sr-only" {{ $themeSettings['banner_gradient'] === $value ? 'checked' : '' }} {{ $isFree ? 'disabled' : '' }}>
                        <div class="w-full h-8 rounded-lg bg-gradient-to-r {{ $value }} mb-2.5 shadow-sm border border-black/5"></div>
                        <span class="text-xs font-semibold text-text-primary text-center">{{ $label }}</span>
                        
                        {{-- Checked indicator --}}
                        <div class="absolute -top-1.5 -right-1.5 w-5 h-5 rounded-full bg-brand-primary border-2 border-white items-center justify-center text-white hidden select-checked">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                    </label>
                @endforeach
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('theme_settings.banner_gradient')" />
        </div>

        {{-- Pilihan Warna Latar Belakang --}}
        <div>
            <x-input-label for="bg_color" value="Warna Latar Belakang Profil" />
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 mt-2">
                @foreach([
                    '#f8fafc' => 'Slate Light',
                    '#f0fdfa' => 'Soft Mint',
                    '#faf5ff' => 'Soft Lavender',
                    '#fff1f2' => 'Soft Rose',
                    '#0f172a' => 'Charcoal Dark'
                ] as $value => $label)
                    <label class="relative flex flex-col items-center justify-between p-3 rounded-xl border border-border bg-surface-elevated hover:border-brand-primary/30 cursor-pointer select-none transition-all">
                        <input type="radio" name="theme_settings[bg_color]" value="{{ $value }}" class="sr-only" {{ $themeSettings['bg_color'] === $value ? 'checked' : '' }} {{ $isFree ? 'disabled' : '' }}>
                        <div class="w-full h-8 rounded-lg mb-2.5 shadow-sm border border-black/5" style="background-color: {{ $value }}"></div>
                        <span class="text-xs font-semibold text-text-primary text-center">{{ $label }}</span>
                        
                        {{-- Checked indicator --}}
                        <div class="absolute -top-1.5 -right-1.5 w-5 h-5 rounded-full bg-brand-primary border-2 border-white items-center justify-center text-white hidden select-checked">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                    </label>
                @endforeach
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('theme_settings.bg_color')" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            {{-- Pilihan Gaya Kartu Tautan --}}
            <div>
                <x-input-label for="card_style" value="Gaya Kartu Tautan" />
                <select name="theme_settings[card_style]" class="input-field mt-1 block w-full cursor-pointer" {{ $isFree ? 'disabled' : '' }}>
                    <option value="card-shadow" {{ $themeSettings['card_style'] === 'card-shadow' ? 'selected' : '' }}>Putih Klasik (Bayangan Lembut)</option>
                    <option value="glassmorphism" {{ $themeSettings['card_style'] === 'glassmorphism' ? 'selected' : '' }}>Kaca Transparan (Glassmorphism)</option>
                    <option value="dark-mode" {{ $themeSettings['card_style'] === 'dark-mode' ? 'selected' : '' }}>Hitam Premium (Dark Mode)</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('theme_settings.card_style')" />
            </div>

            {{-- Pilihan Tipe Font --}}
            <div>
                <x-input-label for="font_family" value="Jenis Huruf (Font)" />
                <select name="theme_settings[font_family]" class="input-field mt-1 block w-full cursor-pointer" {{ $isFree ? 'disabled' : '' }}>
                    <option value="font-sans" {{ $themeSettings['font_family'] === 'font-sans' ? 'selected' : '' }}>Inter (Sans-Serif Standard)</option>
                    <option value="font-serif" {{ $themeSettings['font_family'] === 'font-serif' ? 'selected' : '' }}>Georgia (Serif Elegant)</option>
                    <option value="font-mono" {{ $themeSettings['font_family'] === 'font-mono' ? 'selected' : '' }}>Fira Code (Monospace Retro)</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('theme_settings.font_family')" />
            </div>
        </div>

        {{-- Pilihan Menampilkan Status Keanggotaan --}}
        <div class="p-4 rounded-xl border border-border bg-surface-muted/30">
            <div class="flex items-start gap-3">
                <div class="flex items-center h-5">
                    <input type="hidden" name="theme_settings[show_membership]" value="false">
                    <input id="show_membership" type="checkbox" name="theme_settings[show_membership]" value="true" class="h-4.5 w-4.5 rounded border-border text-brand-primary focus:ring-brand-primary/20"
                        {{ $isFree ? 'checked disabled' : ($themeSettings['show_membership'] === 'true' ? 'checked' : '') }}>
                </div>
                <div class="text-sm">
                    <label for="show_membership" class="font-medium text-text-primary">Tampilkan Status Keanggotaan</label>
                    <p class="text-xs text-text-secondary mt-0.5">
                        Tampilkan badge plan keanggotaan Anda (misal: Student atau Pro) di halaman profil publik Anda.
                    </p>
                    @if($isFree)
                        <p class="text-[11px] text-brand-secondary font-medium mt-1">
                            * Pengguna dengan paket Free diwajibkan menampilkan badge status keanggotaan.
                        </p>
                    @endif
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('theme_settings.show_membership')" />
        </div>

        {{-- Save Button --}}
        <div class="flex items-center gap-4 pt-2">
            <x-primary-button :disabled="$isFree">{{ __('Simpan Tema') }}</x-primary-button>

            @if (session('status') === 'theme-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-text-secondary animate-fade-in"
                >{{ __('Tema diperbarui.') }}</p>
            @endif

            @if (session('error'))
                <p class="text-sm text-danger animate-fade-in">{{ session('error') }}</p>
            @endif
        </div>
    </form>

    <style>
        /* Custom radio checked styling */
        label:has(input[type="radio"]:checked) {
            border-color: var(--color-brand-primary) !important;
            box-shadow: 0 0 0 2px oklch(0.65 0.18 165 / 0.15);
        }
        label:has(input[type="radio"]:checked) .select-checked {
            display: flex !important;
        }
    </style>
</section>
