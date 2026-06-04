<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Profile' }} — {{ config('app.name', 'BioKuy') }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Check out my links on BioKuy' }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $title ?? 'Profile' }} — BioKuy">
    <meta property="og:description" content="{{ $metaDescription ?? 'Check out my links on BioKuy' }}">
    <meta property="og:type" content="profile">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --profile-bg: {{ $profileBg ?? 'linear-gradient(145deg, oklch(0.98 0 0), oklch(0.94 0.02 165))' }};
            --profile-text: {{ $profileText ?? 'oklch(0.15 0 0)' }};
            --profile-accent: {{ $profileAccent ?? 'oklch(0.65 0.18 165)' }};
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center" style="background: var(--profile-bg); color: var(--profile-text);">

        <div class="w-full max-w-lg mx-auto px-4 py-12 flex-1">
            {{ $slot }}
        </div>

        <footer class="w-full py-6 text-center">
            <a
                href="{{ url('/') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-medium opacity-50 hover:opacity-80 transition-opacity"
                style="color: var(--profile-text);"
                id="powered-by-biokuy"
            >
                <div class="w-4 h-4 rounded-md flex items-center justify-center text-[8px] font-bold text-white" style="background: var(--profile-accent);">B</div>
                Powered by BioKuy
            </a>
        </footer>
    </div>
</body>
</html>
