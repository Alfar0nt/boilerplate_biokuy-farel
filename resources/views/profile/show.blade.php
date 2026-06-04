@php
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

    // Map background preset colors to layout variables
    $bgColorPreset = $themeSettings['bg_color'];
    $profileBg = $bgColorPreset;
    $profileText = 'oklch(0.15 0 0)'; // Default dark text

    // Set layout variables based on bg_color
    if ($bgColorPreset === '#0f172a') {
        $profileBg = '#0f172a';
        $profileText = 'oklch(0.98 0 0)'; // Light text for dark bg
    } elseif ($bgColorPreset === '#f0fdfa') {
        $profileText = 'oklch(0.12 0.02 165)';
    } elseif ($bgColorPreset === '#faf5ff') {
        $profileText = 'oklch(0.15 0.02 290)';
    } elseif ($bgColorPreset === '#fff1f2') {
        $profileText = 'oklch(0.15 0.02 350)';
    }

    $cardStyle = $themeSettings['card_style'] ?? 'card-shadow';
    $isDarkBg = ($bgColorPreset === '#0f172a');

    // Setup style variables based on card_style and background brightness
    if ($cardStyle === 'glassmorphism') {
        if ($isDarkBg) {
            $outerCardClass = 'bg-white/10 backdrop-blur-xl border border-white/15 shadow-elevated';
            $cardClass = 'bg-white/15 backdrop-blur-md border border-white/15 hover:bg-white/25 text-white shadow-md';
            $titleColorClass = 'text-white';
            $bioColorClass = 'text-white/80';
            $avatarBorderClass = 'border-white/20 bg-white/10';
        } else {
            $outerCardClass = 'bg-white/40 backdrop-blur-xl border border-white/40 shadow-elevated';
            $cardClass = 'bg-white/30 backdrop-blur-md border border-white/30 hover:bg-white/50 text-text-primary shadow-md';
            $titleColorClass = 'text-text-primary';
            $bioColorClass = 'text-text-secondary';
            $avatarBorderClass = 'border-white/40 bg-white/20';
        }
    } elseif ($cardStyle === 'dark-mode') {
        $outerCardClass = 'bg-surface-dark border border-white/10 shadow-elevated';
        $cardClass = 'bg-white/5 border border-white/10 hover:bg-white/10 text-white shadow-md';
        $titleColorClass = 'text-white';
        $bioColorClass = 'text-white/70';
        $avatarBorderClass = 'border-surface-dark bg-surface-dark';
    } else { // card-shadow (default)
        $outerCardClass = 'bg-white border border-border shadow-elevated';
        $cardClass = 'bg-white border border-border hover:bg-surface-muted text-text-primary shadow-sm';
        $titleColorClass = 'text-text-primary';
        $bioColorClass = 'text-text-secondary';
        $avatarBorderClass = 'border-white bg-white';
    }

    // Font family class
    $fontClass = $themeSettings['font_family'] ?? 'font-sans';

    // Show membership badge logic
    $showMembership = true;
    if ($user->plan !== \App\Enums\PlanEnum::Free) {
        $showMembership = filter_var($themeSettings['show_membership'], FILTER_VALIDATE_BOOLEAN);
    }
@endphp

<x-public-layout :profile-bg="$profileBg" :profile-text="$profileText">
    <x-slot:title>{{ $user->name }} — BioKuy</x-slot:title>
    <x-slot:metaDescription>{{ $user->bio ?? 'Temukan tautan penting dari ' . $user->name . ' di BioKuy.' }}</x-slot:metaDescription>

    <div class="{{ $fontClass }} {{ $outerCardClass }} p-0 overflow-hidden relative rounded-[2rem] w-full max-w-md mx-auto animate-fade-in">
        <div class="h-32 bg-gradient-to-r {{ $themeSettings['banner_gradient'] ?? 'from-emerald-400 to-blue-500' }} w-full"></div>
        
        <div class="px-6 pb-8 pt-0 flex flex-col items-center -mt-12">
            <div class="relative w-24 h-24 rounded-full border-4 {{ $avatarBorderClass }} shadow-sm overflow-hidden shrink-0">
                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
            </div>
            
            <div class="flex items-center gap-2 mt-4">
                <h1 class="text-xl font-bold {{ $titleColorClass }}">{{ $user->name }}</h1>
                @if($showMembership)
                    @if($user->plan === \App\Enums\PlanEnum::Pro)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-primary/10 text-brand-primary border border-brand-primary/20 uppercase tracking-wider">
                            PRO
                        </span>
                    @elseif($user->plan === \App\Enums\PlanEnum::Student)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-secondary/10 text-brand-secondary border border-brand-secondary/20 uppercase tracking-wider">
                            STUDENT
                        </span>
                    @elseif($user->plan === \App\Enums\PlanEnum::Free)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-500/10 text-slate-500 border border-slate-500/20 uppercase tracking-wider">
                            FREE
                        </span>
                    @endif
                @endif
            </div>
            
            <p class="text-sm {{ $bioColorClass }} text-center mt-2 max-w-xs leading-relaxed">
                {{ $user->bio ?? 'Selamat datang di halaman BioKuy saya!' }}
            </p>
            
            <div class="w-full mt-8 space-y-4">
                @forelse($links as $link)
                    <a href="{{ route('links.go', $link) }}" target="_blank" class="w-full flex items-center justify-center gap-3 px-6 py-4 rounded-2xl active:scale-[0.98] transition-all duration-200 text-sm font-bold text-center {{ $cardClass }}">
                        @if($link->icon)
                            <span class="text-base shrink-0">{{ $link->icon }}</span>
                        @endif
                        <span>{{ $link->title }}</span>
                    </a>
                @empty
                    <div class="text-center py-6 text-sm text-text-muted">
                        Belum ada tautan aktif saat ini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-public-layout>
