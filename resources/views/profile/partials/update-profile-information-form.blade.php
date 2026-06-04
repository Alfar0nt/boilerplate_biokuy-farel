<!-- Cropper.js CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

<section>
    <header>
        <h2 class="text-lg font-medium text-text-primary">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-text-secondary">
            {{ __("Perbarui informasi profil akun, foto profil, dan deskripsi diri Anda.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" autocomplete="off" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Avatar Upload & Crop --}}
        <div class="flex items-center gap-4.5">
            <div class="relative w-16 h-16 rounded-full overflow-hidden bg-brand-primary/10 flex items-center justify-center border border-border shrink-0 shadow-sm">
                <img id="avatar-preview" src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1">
                <x-input-label for="avatar" value="Foto Profil" />
                
                <div class="flex items-center gap-3">
                    <input id="avatar" name="avatar" type="file" accept="image/*" class="mt-1 block w-full text-sm text-text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-primary/10 file:text-brand-primary file:cursor-pointer hover:file:bg-brand-primary/20" />
                    
                    @if($user->avatar_public_id)
                        <button type="button" onclick="confirmDeleteAvatar()" class="mt-1 shrink-0 text-xs font-semibold text-danger bg-danger/10 hover:bg-danger/20 px-3.5 py-2 rounded-xl border border-danger/20 transition-all duration-200 cursor-pointer">
                            Hapus Foto
                        </button>
                    @endif
                </div>
                
                <p class="text-xs text-text-muted mt-1.5">PNG, JPG atau GIF (Maks. 2MB)</p>
                <x-input-error class="mt-1" :messages="$errors->get('avatar')" />
            </div>
        </div>

        {{-- Name --}}
        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Alamat Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        {{-- Username --}}
        <div>
            <x-input-label for="username" value="Username" />
            <div class="relative flex items-center">
                <span class="absolute left-3.5 text-text-secondary text-sm font-semibold select-none">@</span>
                <x-text-input id="username" name="username" type="text" class="mt-1 block w-full pl-8" :value="old('username', $user->username)" required placeholder="username-kamu" />
            </div>
            <p class="text-xs text-text-muted mt-1.5">
                Profil publik Anda akan diakses di: <span class="font-medium text-brand-primary">{{ url('/') }}/<span id="url-username-preview">{{ old('username', $user->username) ?? 'username-kamu' }}</span></span>
            </p>
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        {{-- Bio --}}
        <div>
            <x-input-label for="bio" value="Bio Singkat" />
            <textarea id="bio" name="bio" rows="3" class="input-field mt-1 block w-full resize-none" placeholder="Tulis bio singkat Anda di sini..." maxlength="200">{{ old('bio', $user->bio) }}</textarea>
            <div class="flex justify-between items-center mt-1">
                <p class="text-xs text-text-muted">Jelaskan tentang diri Anda secara singkat.</p>
                <p class="text-xs text-text-muted"><span id="bio-char-count">0</span>/200</p>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        {{-- Custom URL --}}
        <div>
            <x-input-label for="custom_url" value="Custom URL (Opsional)" />
            <x-text-input id="custom_url" name="custom_url" type="text" class="mt-1 block w-full" :value="old('custom_url', $user->custom_url)" placeholder="url-kustom-pilihan" />
            <p class="text-xs text-text-muted mt-1.5">
                Alamat alternatif profil Anda (jika diisi): <span class="font-medium text-brand-primary">{{ url('/') }}/<span id="url-custom-preview">{{ old('custom_url', $user->custom_url) ?? 'url-kustom-pilihan' }}</span></span>
            </p>
            <x-input-error class="mt-2" :messages="$errors->get('custom_url')" />
        </div>

        {{-- Save Button --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-text-secondary animate-fade-in"
                >{{ __('Tersimpan.') }}</p>
            @endif

            @if (session('status') === 'avatar-deleted')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-success animate-fade-in"
                >{{ __('Foto profil telah dihapus.') }}</p>
            @endif
        </div>
    </form>

    {{-- Hidden form delete avatar --}}
    @if($user->avatar_public_id)
        <form id="delete-avatar-form" method="POST" action="{{ route('profile.avatar.destroy') }}" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif

    {{-- Modal Crop Avatar --}}
    <div id="crop-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm hidden p-4 transition-all duration-300">
        <div class="bg-surface-elevated rounded-2xl border border-border shadow-elevated w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh] animate-scale-in">
            <div class="px-6 py-4 border-b border-border flex justify-between items-center">
                <h3 class="font-bold text-text-primary text-base">Sesuaikan & Potong Foto</h3>
                <button type="button" onclick="closeCropModal()" class="text-text-muted hover:text-text-primary p-1 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="p-4 flex-1 bg-surface-muted/50 flex items-center justify-center min-h-[350px]">
                <div class="w-full h-[350px] md:h-[400px] relative">
                    <img id="crop-image" src="" alt="Gambar untuk dipotong" class="block max-w-full max-h-full mx-auto">
                </div>
            </div>
            
            <div class="px-6 py-4 border-t border-border flex justify-end gap-3">
                <button type="button" onclick="closeCropModal()" class="btn-ghost text-xs cursor-pointer">Batal</button>
                <button type="button" id="crop-save-btn" class="btn-primary text-xs cursor-pointer">Potong & Simpan</button>
            </div>
        </div>
    </div>

    <script>
        let cropper = null;
        const avatarInput = document.getElementById('avatar');
        const cropModal = document.getElementById('crop-modal');
        const cropImage = document.getElementById('crop-image');
        const cropSaveBtn = document.getElementById('crop-save-btn');

        // Deteksi input gambar
        avatarInput.addEventListener('change', function(e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                const file = files[0];
                const reader = new FileReader();
                reader.onload = function(event) {
                    cropImage.src = event.target.result;
                    cropModal.classList.remove('hidden');
                    
                    // Inisialisasi Cropper.js dengan ratio 1:1
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(cropImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        autoCropArea: 1,
                        restore: false,
                        guides: true,
                        center: true,
                        highlight: false,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: false,
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        // Tutup modal crop
        function closeCropModal() {
            cropModal.classList.add('hidden');
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            avatarInput.value = ''; // Reset input agar file yang sama bisa memicu ulang
        }

        // Potong gambar & simpan ke input file asli
        cropSaveBtn.addEventListener('click', function() {
            if (!cropper) return;

            cropper.getCroppedCanvas({
                width: 400,
                height: 400
            }).toBlob(function(blob) {
                // Buat file baru dari blob
                const croppedFile = new File([blob], 'avatar_cropped.png', { type: 'image/png' });
                
                // Gunakan DataTransfer API untuk memodifikasi file pada input
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);
                avatarInput.files = dataTransfer.files;

                // Perbarui pratinjau gambar di form
                document.getElementById('avatar-preview').src = URL.createObjectURL(croppedFile);
                
                // Sembunyikan modal
                cropModal.classList.add('hidden');
                cropper.destroy();
                cropper = null;
            }, 'image/png');
        });

        // Konfirmasi Hapus Foto
        function confirmDeleteAvatar() {
            if (confirm('Apakah Anda yakin ingin menghapus foto profil ini dan kembali ke avatar bawaan?')) {
                document.getElementById('delete-avatar-form').submit();
            }
        }

        // Live text preview listeners
        document.getElementById('username')?.addEventListener('input', function(e) {
            const preview = document.getElementById('url-username-preview');
            if (preview) {
                preview.textContent = e.target.value || 'username-kamu';
            }
        });

        document.getElementById('custom_url')?.addEventListener('input', function(e) {
            const preview = document.getElementById('url-custom-preview');
            if (preview) {
                preview.textContent = e.target.value || 'url-kustom-pilihan';
            }
        });

        // Bio character counter
        const bioTextarea = document.getElementById('bio');
        const bioCharCount = document.getElementById('bio-char-count');
        if (bioTextarea && bioCharCount) {
            bioCharCount.textContent = bioTextarea.value.length;
            bioTextarea.addEventListener('input', function(e) {
                bioCharCount.textContent = e.target.value.length;
            });
        }
    </script>
</section>
