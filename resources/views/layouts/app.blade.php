<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} — {{ config('app.name', 'BioKuy') }}</title>
    <meta name="description" content="BioKuy — Kelola semua link penting Anda dalam satu halaman.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Sidebar transition and collapse styling */
        #sidebar {
            transition: width 0.3s ease-in-out, transform 0.3s ease-in-out;
        }
        #main-content {
            transition: margin-left 0.3s ease-in-out;
        }
        
        /* Media Queries for Sidebar and Content Margins */
        @media (min-width: 768px) {
            #sidebar {
                width: var(--sidebar-width) !important;
            }
            #main-content {
                margin-left: var(--sidebar-width) !important;
            }
            
            #sidebar.collapsed {
                width: var(--sidebar-collapsed-width) !important;
            }
            #sidebar.collapsed ~ #main-content {
                margin-left: var(--sidebar-collapsed-width) !important;
            }
        }
        
        @media (max-width: 767.98px) {
            #sidebar {
                width: var(--sidebar-width) !important;
            }
            #main-content {
                margin-left: 0 !important;
            }
        }
        
        /* Centering elements when collapsed */
        #sidebar.collapsed .sidebar-header {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            gap: 0 !important;
        }
        #sidebar.collapsed .sidebar-link {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            gap: 0 !important;
        }
        #sidebar.collapsed .sidebar-link svg {
            margin: 0 auto !important;
        }
        #sidebar.collapsed .external-icon {
            display: none !important;
        }
        #sidebar.collapsed .user-info-wrapper {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            gap: 0 !important;
        }
        #sidebar.collapsed #sidebar-collapse-btn {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            gap: 0 !important;
        }
        #sidebar.collapsed .sidebar-logout-btn {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            gap: 0 !important;
        }
        #sidebar.collapsed .sidebar-footer {
            display: none !important;
        }
        
        #sidebar.collapsed .preview-header {
            opacity: 0 !important;
            height: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
            border: none !important;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex bg-surface-base" id="app-layout">
        <aside
            id="sidebar"
            class="fixed inset-y-0 left-0 z-40 flex flex-col bg-surface-sidebar text-text-inverse transition-all duration-300 ease-in-out max-md:translate-x-[-100%] md:translate-x-0"
            style="width: var(--sidebar-width);"
        >
            <div class="sidebar-header flex items-center gap-3 px-6 py-5 border-b border-white/10 transition-all duration-300">
                <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-brand-primary text-white font-bold text-lg shrink-0">
                    B
                </div>
                <span id="sidebar-logo-text" class="text-lg font-bold tracking-tight whitespace-nowrap overflow-hidden transition-all duration-300">
                    BioKuy
                </span>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto overflow-x-hidden">
                <a href="{{ url('/dashboard') }}" id="nav-dashboard"
                   class="sidebar-link group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('dashboard') ? 'bg-white/15 text-white' : 'text-white/60 hover:text-white hover:bg-white/8' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/>
                    </svg>
                    <span class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">Dashboard</span>
                </a>

                <a href="{{ url('/links') }}" id="nav-links"
                   class="sidebar-link group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('links*') ? 'bg-white/15 text-white' : 'text-white/60 hover:text-white hover:bg-white/8' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    <span class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">Links</span>
                </a>

                <a href="{{ url('/billing') }}" id="nav-billing"
                   class="sidebar-link group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('billing*') ? 'bg-white/15 text-white' : 'text-white/60 hover:text-white hover:bg-white/8' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    <span class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">Billing</span>
                </a>

                <div class="preview-header pt-4 pb-2 px-3 transition-all duration-300">
                    <p class="sidebar-label text-xs font-semibold uppercase tracking-wider text-white/30 whitespace-nowrap overflow-hidden transition-all duration-300">Preview</p>
                </div>

                <a href="{{ url('/' . (auth()->user()->username ?? 'preview')) }}" target="_blank" id="nav-preview"
                   class="sidebar-link group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-white/60 hover:text-white hover:bg-white/8 transition-all duration-200">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">Preview Page</span>
                    <svg class="external-icon w-3.5 h-3.5 shrink-0 ml-auto opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </nav>

            <div class="border-t border-white/10 p-3">
                <div class="user-info-wrapper flex items-center gap-3 px-3 py-2 transition-all duration-300">
                    <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover shrink-0">
                    <div class="sidebar-label min-w-0 overflow-hidden transition-all duration-300">
                        <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'User' }}</p>
                        <p class="text-xs text-white/40 truncate">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                </div>

                <button
                    id="sidebar-collapse-btn"
                    class="hidden md:flex w-full mt-2 items-center justify-center gap-2 px-3 py-2 rounded-xl text-xs font-medium text-white/40 hover:text-white hover:bg-white/8 transition-all duration-200"
                    onclick="toggleSidebar()"
                    aria-label="Toggle sidebar"
                >
                    <svg id="collapse-icon" class="w-4 h-4 shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                    <span class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">Collapse</span>
                </button>

                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <button
                        type="submit"
                        class="sidebar-logout-btn w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl text-xs font-medium text-danger/70 hover:text-danger hover:bg-danger/10 transition-all duration-200"
                        aria-label="Keluar"
                    >
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">Keluar</span>
                    </button>
                </form>
            </div>

            <div class="sidebar-footer px-6 py-3 border-t border-white/10 transition-all duration-300">
                <p class="sidebar-label text-xs text-center text-white/55 whitespace-nowrap overflow-hidden transition-all duration-300">&copy; {{ date('Y') }} BioKuy</p>
            </div>
        </aside>

        <div
            id="sidebar-overlay"
            class="fixed inset-0 z-30 bg-black/50 backdrop-blur-sm hidden md:hidden transition-opacity duration-300"
            onclick="closeMobileSidebar()"
        ></div>

        <div id="main-content" class="flex-1 flex flex-col min-h-screen transition-all duration-300 md:ml-[var(--sidebar-width)]">

            <header class="sticky top-0 z-20 bg-surface-elevated/80 backdrop-blur-md border-b border-border">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">

                    <div class="flex items-center gap-3">
                        <button
                            id="mobile-menu-btn"
                            class="md:hidden p-2 -ml-2 rounded-xl text-text-secondary hover:text-text-primary hover:bg-surface-muted transition-colors"
                            onclick="openMobileSidebar()"
                            aria-label="Open menu"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <nav class="flex items-center gap-2 text-sm" aria-label="Breadcrumb">
                            <span class="text-text-muted">{{ config('app.name') }}</span>
                            @isset($breadcrumb)
                                <svg class="w-4 h-4 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                <span class="text-text-primary font-medium">{{ $breadcrumb }}</span>
                            @endisset
                        </nav>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="relative" id="user-menu-container">
                            <button
                                id="user-menu-btn"
                                class="flex items-center gap-2 p-1.5 pr-3 rounded-xl hover:bg-surface-muted transition-colors"
                                onclick="toggleUserMenu()"
                            >
                                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover shrink-0">
                                <span class="hidden sm:block text-sm font-medium text-text-primary">{{ auth()->user()->name ?? 'User' }}</span>
                                <svg class="w-4 h-4 text-text-muted hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div
                                id="user-dropdown"
                                class="absolute right-0 top-full mt-2 w-56 bg-surface-elevated border border-border rounded-2xl shadow-elevated py-2 hidden animate-scale-in"
                            >
                                <div class="px-4 py-2 border-b border-border">
                                    <p class="text-sm font-medium text-text-primary">{{ auth()->user()->name ?? 'User' }}</p>
                                    <p class="text-xs text-text-muted">{{ auth()->user()->email ?? '' }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-text-secondary hover:text-text-primary hover:bg-surface-muted transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Profile
                                </a>
                                <div class="border-t border-border my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-danger hover:bg-danger/5 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            @isset($header)
                <div class="px-4 sm:px-6 lg:px-8 pt-6">
                    <h1 class="text-2xl font-bold text-text-primary">{{ $header }}</h1>
                </div>
            @endisset

            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        // Sidebar state
        let sidebarCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';

        function initSidebar() {
            if (sidebarCollapsed) {
                collapseSidebar(false);
            }
        }

        function toggleSidebar() {
            sidebarCollapsed = !sidebarCollapsed;
            localStorage.setItem('sidebar-collapsed', sidebarCollapsed);
            if (sidebarCollapsed) {
                collapseSidebar(true);
            } else {
                expandSidebar(true);
            }
        }

        function collapseSidebar(animate) {
            const sidebar = document.getElementById('sidebar');
            const collapseIcon = document.getElementById('collapse-icon');

            sidebar.classList.add('collapsed');
            collapseIcon.style.transform = 'rotate(180deg)';

            document.querySelectorAll('.sidebar-label').forEach(el => {
                el.style.width = '0';
                el.style.opacity = '0';
            });
            const logoText = document.getElementById('sidebar-logo-text');
            if (logoText) {
                logoText.style.width = '0';
                logoText.style.opacity = '0';
            }
        }

        function expandSidebar(animate) {
            const sidebar = document.getElementById('sidebar');
            const collapseIcon = document.getElementById('collapse-icon');

            sidebar.classList.remove('collapsed');
            collapseIcon.style.transform = 'rotate(0deg)';

            document.querySelectorAll('.sidebar-label').forEach(el => {
                el.style.width = 'auto';
                el.style.opacity = '1';
            });
            const logoText = document.getElementById('sidebar-logo-text');
            if (logoText) {
                logoText.style.width = 'auto';
                logoText.style.opacity = '1';
            }
        }

        function openMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.remove('collapsed');
            sidebar.classList.remove('max-md:translate-x-[-100%]');
            sidebar.classList.add('max-md:translate-x-0');
            overlay.classList.remove('hidden');

            document.querySelectorAll('.sidebar-label').forEach(el => {
                el.style.width = 'auto';
                el.style.opacity = '1';
            });
            const logoText = document.getElementById('sidebar-logo-text');
            if (logoText) {
                logoText.style.width = 'auto';
                logoText.style.opacity = '1';
            }
        }

        function closeMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.add('max-md:translate-x-[-100%]');
            sidebar.classList.remove('max-md:translate-x-0');
            overlay.classList.add('hidden');
        }

        function toggleUserMenu() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            const container = document.getElementById('user-menu-container');
            const dropdown = document.getElementById('user-dropdown');
            if (container && !container.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', initSidebar);
    </script>
</body>
</html>
