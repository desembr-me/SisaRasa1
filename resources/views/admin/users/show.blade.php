<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-[var(--ink)] leading-tight">
                {{ $viewedUser->name }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-[var(--leaf)] hover:underline">&larr; Kembali</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <div class="font-semibold text-[var(--ink)] text-lg">{{ $viewedUser->name }}</div>
                        <div class="text-sm text-[var(--ink-soft)]">{{ $viewedUser->email }}</div>
                        <div class="text-xs text-[var(--ink-soft)] mt-1">Bergabung {{ $viewedUser->created_at->format('d M Y') }}</div>
                    </div>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                        {{ $viewedUser->isAdmin() ? 'bg-[var(--mango)]/20 text-[var(--mango-deep)]' : 'bg-[var(--leaf-soft)] text-[var(--leaf)]' }}">
                        {{ $viewedUser->isAdmin() ? 'Admin' : 'User' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Aksi tercatat</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--ink)]">{{ number_format($viewedUser->rescues_count, 0, ',', '.') }}</div>
                </div>
                @php
                    $userTotalKg = (float) $viewedUser->rescues_sum_kg_saved;
                @endphp
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Makanan terselamatkan</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--ink)]">{{ number_format($userTotalKg, 1, ',', '.') }} kg</div>
                </div>
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">CO2 dicegah</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--leaf)]">{{ number_format($userTotalKg * \App\Models\Rescue::CO2_PER_KG, 1, ',', '.') }} kg</div>
                </div>
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Nilai ekonomi</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--mango-deep)]">Rp{{ number_format($userTotalKg * \App\Models\Rescue::RP_PER_KG, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6">
                <h3 class="font-semibold text-[var(--ink)] mb-4">Riwayat aktivitas</h3>

                @forelse ($rescues as $rescue)
                    <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-[var(--line)]' : '' }}">
                        <div>
                            <div class="text-sm font-semibold text-[var(--ink)]">
                                {{ $rescue->sourceLabel() }}
                                @if ($rescue->description)
                                    <span class="font-normal text-[var(--ink-soft)]">&mdash; {{ $rescue->description }}</span>
                                @endif
                            </div>
                            <div class="text-xs text-[var(--ink-soft)] mt-1">{{ $rescue->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="text-right shrink-0 ml-4">
                            <div class="text-sm font-bold text-[var(--ink)]">{{ number_format((float) $rescue->kg_saved, 1, ',', '.') }} kg</div>
                            <div class="text-xs text-[var(--ink-soft)]">Rp{{ number_format($rescue->moneySaved(), 0, ',', '.') }}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-[var(--ink-soft)]">Pengguna ini belum mencatat aksi apa pun.</p>
                @endforelse

                <div class="mt-4">
                    {{ $rescues->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
