<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[var(--ink)] leading-tight">
            Toko Saya — {{ $store->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="rounded-lg border border-[var(--leaf)] bg-[var(--leaf-soft)] px-4 py-3 text-sm text-[var(--leaf)] font-medium">
                    @switch(session('status'))
                        @case('listing-created') Listing berhasil dibuat. @break
                        @case('listing-updated') Listing berhasil diperbarui. @break
                        @case('listing-deleted') Listing berhasil dihapus. @break
                    @endswitch
                </div>
            @endif

            <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6 flex items-center justify-between flex-wrap gap-4">
                <div>
                    <div class="font-semibold text-[var(--ink)]">{{ $store->name }}</div>
                    <div class="text-sm text-[var(--ink-soft)]">{{ $store->address }}</div>
                </div>
                <a href="{{ route('mitra.listings.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    + Listing Baru
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Listing aktif</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--ink)]">{{ number_format($activeCount, 0, ',', '.') }}</div>
                </div>
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Porsi diklaim</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--ink)]">{{ number_format($totalClaimed, 0, ',', '.') }}</div>
                </div>
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Kg tersalurkan</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--leaf)]">{{ number_format($totalKgDistributed, 1, ',', '.') }} kg</div>
                </div>
            </div>

            <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6">
                <h3 class="font-semibold text-[var(--ink)] mb-4">Listing</h3>

                @forelse ($listings as $listing)
                    @php
                        $remaining = $listing->remainingQuantity();
                        $status = match (true) {
                            $listing->isExpired() => ['label' => 'Kedaluwarsa', 'class' => 'bg-red-100 text-red-700'],
                            $remaining <= 0 => ['label' => 'Habis', 'class' => 'bg-[var(--paper-warm)] text-[var(--ink-soft)]'],
                            default => ['label' => 'Aktif', 'class' => 'bg-[var(--leaf-soft)] text-[var(--leaf)]'],
                        };
                    @endphp
                    <div class="flex items-center justify-between py-3 gap-4 {{ !$loop->last ? 'border-b border-[var(--line)]' : '' }}">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-semibold text-[var(--ink)] truncate">{{ $listing->title }}</span>
                                <span class="shrink-0 px-2 py-0.5 rounded-full text-[10px] font-semibold uppercase tracking-wide {{ $status['class'] }}">{{ $status['label'] }}</span>
                            </div>
                            <div class="text-xs text-[var(--ink-soft)] mt-1">
                                {{ $listing->priceLabel() }} &middot; sisa {{ $remaining }}/{{ $listing->quantity }}
                                &middot; sampai {{ $listing->expires_at->translatedFormat('d M Y H:i') }}
                            </div>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <a href="{{ route('mitra.listings.edit', $listing) }}" class="text-xs font-semibold text-[var(--leaf)] hover:underline">Ubah</a>
                            <form method="POST" action="{{ route('mitra.listings.destroy', $listing) }}" onsubmit="return confirm('Hapus listing ini?');">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-xs font-semibold text-red-500 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--line)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 mx-auto mb-3">
                            <path d="M4 11h16v3a5 5 0 0 1-5 5h-6a5 5 0 0 1-5-5v-3Z" />
                            <path d="M2 11h20" />
                            <path d="M9 11V8M15 11V8" />
                        </svg>
                        <p class="text-sm text-[var(--ink-soft)]">Belum ada listing. Buat listing pertamamu untuk mulai menyalurkan surplus.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
