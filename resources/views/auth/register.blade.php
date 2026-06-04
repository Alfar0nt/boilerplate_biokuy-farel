<x-guest-layout>
    <x-slot:title>Daftar — BioKuy</x-slot:title>

    <div class="w-full sm:max-w-md animate-fade-in">
        <div class="card p-8">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-text-primary">Daftar Akun Baru</h2>
                <p class="text-sm text-text-secondary mt-1">Mulai buat halaman link-in-bio Anda gratis</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="name" value="Nama Lengkap" />
                    <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" placeholder="Nama lengkap Anda" autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" value="Alamat Email" />
                    <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" placeholder="nama@email.com" autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div>
                    <x-input-label for="password" value="Kata Sandi" />
                    <x-text-input id="password" class="block w-full"
                                    type="password"
                                    name="password"
                                    placeholder="Minimal 8 karakter"
                                 autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
                    <x-text-input id="password_confirmation" class="block w-full"
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="Ulangi kata sandi Anda"
                                 autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" />
                </div>

                <div class="flex flex-col gap-4 pt-2">
                    <x-primary-button class="w-full justify-center">
                        Daftar
                    </x-primary-button>

                    <div class="text-center text-sm">
                        <a class="text-text-secondary hover:text-brand-primary transition-colors duration-150 underline" href="{{ route('login') }}">
                            Sudah terdaftar? Masuk
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
