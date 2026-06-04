<x-app-layout>
    <x-slot:breadcrumb>Links</x-slot:breadcrumb>
    <x-slot:header>Kelola Link Anda</x-slot:header>

    <div class="animate-fade-in space-y-6">
        <div class="card p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1.5 flex-1">
                <div class="flex items-center gap-2.5">
                    <h3 class="font-bold text-text-primary">Penggunaan Link</h3>
                    <span class="{{ auth()->user()->getActivePlan()->badgeClass() }}">{{ auth()->user()->getActivePlan()->label() }}</span>
                </div>
                <p class="text-sm text-text-secondary">
                    Anda telah menggunakan <span class="font-semibold text-text-primary">{{ $links->count() }}</span> dari <span class="font-semibold text-text-primary">{{ $linkLimit === PHP_INT_MAX ? 'Tak Terbatas' : $linkLimit }}</span> slot link aktif.
                </p>
                @if($linkLimit !== PHP_INT_MAX)
                    <div class="w-full bg-border rounded-full h-2 mt-2">
                        <div class="bg-brand-primary h-2 rounded-full transition-all duration-300" style="width: {{ ($links->count() / $linkLimit) * 100 }}%"></div>
                    </div>
                @endif
            </div>
            
            <div class="shrink-0 flex items-center gap-3">
                @if($canAddLink)
                    <a href="{{ route('links.create') }}" class="btn-primary">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Link
                    </a>
                @else
                    <div class="flex flex-col sm:flex-row items-center gap-3">
                        <span class="text-xs font-semibold text-danger bg-danger/10 px-3 py-1.5 rounded-xl border border-danger/20">Slot Penuh</span>
                        <a href="{{ route('billing.index') }}" class="btn-primary bg-brand-secondary hover:bg-brand-secondary-hover shadow-sm">
                            Upgrade Plan
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            {{-- Kolom Kiri: Pengelolaan Link (2/3 lebar) --}}
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="font-semibold text-text-primary">Daftar Link (Tarik & Lepas untuk Mengurutkan)</h4>
                    <p class="text-xs text-text-muted">Total: {{ $links->count() }} Link</p>
                </div>

                <div id="links-container" class="space-y-3">
                    @forelse($links as $link)
                        <div 
                            class="card flex items-center justify-between p-4 bg-white transition-all duration-200 border border-border rounded-2xl hover:border-brand-primary/30 drag-item"
                            draggable="true"
                            data-id="{{ $link->id }}"
                        >
                            {{-- Left Side: Drag handle + Details --}}
                            <div class="flex items-center gap-3.5 min-w-0">
                                {{-- Drag Handle --}}
                                <div class="cursor-grab active:cursor-grabbing text-text-muted hover:text-text-primary p-1 shrink-0 select-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                                    </svg>
                                </div>

                                <div class="w-10 h-10 rounded-xl bg-surface-muted border border-border flex items-center justify-center text-lg shrink-0">
                                    {{ $link->icon ?? '🔗' }}
                                </div>

                                <div class="min-w-0">
                                    <h5 class="font-semibold text-text-primary truncate">{{ $link->title }}</h5>
                                    <a href="{{ $link->url }}" target="_blank" class="text-xs text-brand-primary hover:underline truncate block mt-0.5">{{ $link->url }}</a>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 shrink-0">
                                <div class="hidden sm:flex flex-col items-end text-xs text-text-muted mr-1">
                                    <span class="font-semibold text-text-primary">{{ $link->click_count ?? 0 }}</span>
                                    <span>Klik</span>
                                </div>

                                <form method="POST" action="{{ route('links.toggle', $link) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $link->is_active ? 'bg-brand-primary' : 'bg-border' }}" role="switch" aria-checked="{{ $link->is_active ? 'true' : 'false' }}">
                                        <span aria-hidden="true" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow-sm ring-0 transition duration-200 ease-in-out {{ $link->is_active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                    </button>
                                </form>

                                <a href="{{ route('links.edit', $link) }}" class="p-2 rounded-xl bg-surface-muted text-text-secondary hover:text-brand-primary hover:bg-brand-primary/10 transition-colors" title="Edit Link">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>

                                <form method="POST" action="{{ route('links.destroy', $link) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus link ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-xl bg-surface-muted text-text-secondary hover:text-danger hover:bg-danger/10 transition-colors" title="Hapus Link">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="card text-center py-12 border border-dashed border-border rounded-2xl">
                            <div class="w-12 h-12 rounded-full bg-surface-muted flex items-center justify-center mx-auto mb-4 text-text-muted">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            </div>
                            <h4 class="font-bold text-text-primary mb-1">Belum Ada Link</h4>
                            <p class="text-sm text-text-muted mb-4">Mulai tambahkan link penting Anda untuk dipublikasikan di halaman BioKuy.</p>
                            @if($canAddLink)
                                <a href="{{ route('links.create') }}" class="btn-primary inline-flex">
                                    Tambah Link Baru
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Kolom Kanan: Analitik & Statistik (1/3 lebar) --}}
            <div class="space-y-4">
                <h4 class="font-semibold text-text-primary">Analitik Pengunjung</h4>
                
                @if(auth()->user()->getActivePlan() === \App\Enums\PlanEnum::Pro)
                    <div class="card p-5 bg-white border border-border space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold text-brand-primary bg-brand-primary/10 px-2.5 py-1 rounded-lg">Real-time</span>
                            <span class="text-xs text-text-muted">30 Hari Terakhir</span>
                        </div>
                        
                        <div class="space-y-3.5 pt-1">
                            @php
                                $popularLinks = $links->sortByDesc('click_count')->take(3);
                            @endphp
                            @forelse($popularLinks as $popLink)
                                <div class="space-y-1.5">
                                    <div class="flex justify-between text-xs font-medium">
                                        <span class="text-text-primary truncate max-w-[150px] font-semibold">{{ $popLink->title }}</span>
                                        <span class="text-text-secondary font-bold">{{ $popLink->click_count }} klik</span>
                                    </div>
                                    <div class="w-full bg-border rounded-full h-1.5">
                                        <div class="bg-brand-primary h-1.5 rounded-full" style="width: {{ $links->sum('click_count') > 0 ? ($popLink->click_count / $links->sum('click_count')) * 100 : 0 }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-xs text-text-muted text-center py-6">Belum ada data klik tautan.</p>
                            @endforelse
                        </div>
                    </div>
                @else
                    {{-- Premium Feature Lock Overlay --}}
                    <div class="card p-5 bg-white border border-border relative overflow-hidden min-h-[220px] flex flex-col justify-center">
                        <div class="absolute inset-0 bg-white/80 backdrop-blur-[1px] flex flex-col items-center justify-center text-center p-5 z-10">
                            <svg class="w-8 h-8 text-brand-primary mb-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <h5 class="font-bold text-text-primary text-xs">Analitik Lanjutan Terkunci</h5>
                            <p class="text-[10px] text-text-muted max-w-[185px] mt-1 mb-3">
                                Pelacakan statistik rujukan dan rincian performa klik tautan hanya tersedia di paket **PRO**.
                            </p>
                            <a href="{{ route('billing.index') }}" class="btn-primary py-1.5 px-3 text-[10px] bg-brand-primary hover:bg-brand-primary-hover">
                                Aktifkan di Paket Pro
                            </a>
                        </div>

                        {{-- Blurred Dummy content --}}
                        <div class="filter blur-[3px] select-none space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] bg-slate-100 px-2 py-0.5 rounded">Real-time</span>
                                <span class="text-[10px] text-slate-400">30 Hari Terakhir</span>
                            </div>
                            <div class="space-y-3.5 pt-1">
                                <div class="space-y-1.5">
                                    <div class="flex justify-between text-[10px] font-medium">
                                        <span>Instagram Profile</span>
                                        <span>382 klik</span>
                                    </div>
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full">
                                        <div class="bg-slate-300 h-1.5 rounded-full" style="width: 70%"></div>
                                    </div>
                                </div>
                                <div class="space-y-1.5">
                                    <div class="flex justify-between text-[10px] font-medium">
                                        <span>Portfolio Web</span>
                                        <span>145 klik</span>
                                    </div>
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full">
                                        <div class="bg-slate-300 h-1.5 rounded-full" style="width: 35%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('links-container');
            let dragItem = null;

            container.addEventListener('dragstart', (e) => {
                const target = e.target.closest('.drag-item');
                if (target) {
                    dragItem = target;
                    target.classList.add('opacity-40');
                }
            });

            container.addEventListener('dragend', (e) => {
                const target = e.target.closest('.drag-item');
                if (target) {
                    target.classList.remove('opacity-40');
                }
                saveOrder();
            });

            container.addEventListener('dragover', (e) => {
                e.preventDefault();
                const afterElement = getDragAfterElement(container, e.clientY);
                if (afterElement == null) {
                    container.appendChild(dragItem);
                } else {
                    container.insertBefore(dragItem, afterElement);
                }
            });

            function getDragAfterElement(container, y) {
                const draggableElements = [...container.querySelectorAll('.drag-item:not(.opacity-40)')];

                return draggableElements.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;
                    if (offset < 0 && offset > closest.offset) {
                        return { offset: offset, element: child };
                    } else {
                        return closest;
                    }
                }, { offset: Number.NEGATIVE_INFINITY }).element;
            }

            function saveOrder() {
                const ids = [...container.querySelectorAll('.drag-item')].map(item => item.dataset.id);
                
                // Send AJAX request
                fetch("{{ route('links.reorder') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ ids: ids })
                })
                .then(res => {
                    if(!res.ok) {
                        console.error('Gagal mengurutkan link.');
                    }
                })
                .catch(err => console.error(err));
            }
        });
    </script>
</x-app-layout>
