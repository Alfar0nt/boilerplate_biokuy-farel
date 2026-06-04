<x-app-layout>
    <x-slot:breadcrumb>
        <div class="flex items-center gap-2 text-sm text-text-muted">
            <a href="{{ route('links.index') }}" class="hover:text-text-primary transition-colors">Links</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-text-primary font-medium">Edit Link</span>
        </div>
    </x-slot:breadcrumb>
    <x-slot:header>Edit Link</x-slot:header>

    <div class="animate-fade-in max-w-2xl">
        <div class="card p-6">
            <form method="POST" action="{{ route('links.update', $link) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="icon" value="Emoji / Icon" />
                    <div class="flex gap-3">
                        <div id="emoji-preview" class="w-12 h-12 rounded-xl bg-surface-muted border border-border flex items-center justify-center text-2xl shrink-0">
                            {{ old('icon', $link->icon) ?? '🔗' }}
                        </div>
                        <div class="flex-1">
                            <x-text-input id="icon" name="icon" type="text" class="block w-full" placeholder="🔗" :value="old('icon', $link->icon)" required maxlength="10" />
                        </div>
                    </div>
                    <p class="text-xs text-text-muted mt-1.5">Pilih emoji populer di bawah ini atau masukkan sendiri.</p>
                    
                    <div class="flex flex-wrap gap-2 mt-3">
                        @foreach(['🔗', '💼', '🐙', '📱', '✉️', '🌐', '🎥', '🖥️', '🎨', '✍️', '📷', '🎧', '🎮', '🛍️', '🔥', '🚀', '❤️', '💡', '🎓', '⭐'] as $emoji)
                            <button type="button" class="w-10 h-10 rounded-lg border border-border bg-surface-elevated hover:bg-brand-primary/10 hover:border-brand-primary/30 flex items-center justify-center text-lg transition-colors cursor-pointer emoji-btn" data-emoji="{{ $emoji }}">
                                {{ $emoji }}
                            </button>
                        @endforeach
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('icon')" />
                </div>

                <div>
                    <x-input-label for="title" value="Judul Link" />
                    <x-text-input id="title" name="title" type="text" class="block w-full" placeholder="Contoh: Ikuti Portfolio Saya" :value="old('title', $link->title)" required autofocus />
                    <p class="text-xs text-text-muted mt-1.5">Judul yang akan ditampilkan di halaman profil publik Anda.</p>
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                </div>

                <div>
                    <x-input-label for="url" value="URL Tujuan" />
                    <x-text-input id="url" name="url" type="url" class="block w-full" placeholder="https://example.com/username" :value="old('url', $link->url)" required />
                    <p class="text-xs text-text-muted mt-1.5">Pastikan URL diawali dengan http:// atau https://</p>
                    <x-input-error class="mt-2" :messages="$errors->get('url')" />
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn-primary">
                        Update Link
                    </button>
                    <a href="{{ route('links.index') }}" class="btn-ghost">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const emojiInput = document.getElementById('icon');
            const emojiPreview = document.getElementById('emoji-preview');
            const emojiButtons = document.querySelectorAll('.emoji-btn');

            emojiButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const emoji = btn.dataset.emoji;
                    emojiInput.value = emoji;
                    emojiPreview.textContent = emoji;
                });
            });

            emojiInput.addEventListener('input', (e) => {
                emojiPreview.textContent = e.target.value || '🔗';
            });
        });
    </script>
</x-app-layout>
