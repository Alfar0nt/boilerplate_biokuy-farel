<x-guest-layout>
    <x-slot:title>Masuk — BioKuy</x-slot:title>

    <div class="w-full sm:max-w-md animate-fade-in">
        <div class="card p-8">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-text-primary">Selamat Datang</h2>
                <p class="text-sm text-text-secondary mt-1">Masuk ke akun BioKuy Anda</p>
            </div>

            @if ($errors->get('error'))
                <x-auth-session-status class="mb-4 text-sm" :status="$errors->get('error')[0]" />
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="email" value="Alamat Email" />
                    <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" placeholder="nama@email.com" autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div>
                    <x-input-label for="password" value="Kata Sandi" />
                    <x-text-input id="password" class="block w-full"
                                    type="password"
                                    name="password"
                                    placeholder="••••••••"
                                    autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-border text-brand-primary shadow-sm focus:ring-brand-primary/20 focus:border-brand-primary cursor-pointer w-4.5 h-4.5" name="remember">
                        <span class="ms-2 text-sm text-text-secondary">Ingat saya</span>
                    </label>
                </div>

                <div class="flex flex-col gap-4 pt-2">
                    <x-primary-button class="w-full justify-center">
                        Masuk
                    </x-primary-button>

                    <div class="text-center text-xs sm:text-sm">
                        <a class="text-text-secondary hover:text-brand-primary transition-colors duration-150 underline" href="{{ route('register') }}">
                            Belum punya akun? Daftar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
