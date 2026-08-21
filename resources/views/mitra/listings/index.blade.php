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
                <a href="{{ route('mitra.listings.create') }}" class="btn btn-primary" style="padding:10px 20px;">+ Listing Baru</a>
            </div>

            <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6">
                <h3 class="font-semibold text-[var(--ink)] mb-4">Listing aktif</h3>

                @forelse ($listings as $listing)
                    <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-[var(--line)]' : '' }}">
                        <div>
                            <div class="text-sm font-semibold text-[var(--ink)]">{{ $listing->title }}</div>
                            <div class="text-xs text-[var(--ink-soft)] mt-1">
                                {{ $listing->priceLabel() }} · sisa {{ $listing->remainingQuantity() }}/{{ $listing->quantity }}
                                · sampai {{ $listing->expires_at->translatedFormat('d M Y H:i') }}
                                @if ($listing->isExpired()) <span class="text-red-400">(kedaluwarsa)</span> @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-3 shrink-0 ml-4">
                            <a href="{{ route('mitra.listings.edit', $listing) }}" class="text-xs font-semibold text-[var(--leaf)] hover:underline">Ubah</a>
                            <form method="POST" action="{{ route('mitra.listings.destroy', $listing) }}" onsubmit="return confirm('Hapus listing ini?');">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-xs font-semibold text-red-400 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-[var(--ink-soft)]">Belum ada listing. Buat listing pertamamu untuk mulai menyalurkan surplus.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
