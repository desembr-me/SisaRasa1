<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[var(--ink)] leading-tight">
            Dashboard Dampak
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status') === 'rescue-added')
                <div class="rounded-lg border border-[var(--leaf)] bg-[var(--leaf-soft)] px-4 py-3 text-sm text-[var(--leaf)] font-medium">
                    Aksi berhasil dicatat. Terima kasih sudah menyelamatkan makanan!
                </div>
            @endif

            <!-- Stat cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Aksi tercatat</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--ink)]">{{ number_format($totalActions, 0, ',', '.') }}</div>
                </div>
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Makanan terselamatkan</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--ink)]">{{ number_format($totalKg, 1, ',', '.') }} kg</div>
                </div>
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Emisi CO2 dicegah</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--leaf)]">{{ number_format($totalCo2, 1, ',', '.') }} kg</div>
                </div>
                <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Nilai ekonomi hemat</div>
                    <div class="mt-2 text-2xl font-bold text-[var(--mango-deep)]">Rp{{ number_format($totalRp, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Quick add form -->
                <div class="lg:col-span-1 bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6">
                    <h3 class="font-semibold text-[var(--ink)] mb-4">Catat aksi baru</h3>

                    <form method="POST" action="{{ route('rescues.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="source" value="Sumber" />
                            <select id="source" name="source" required
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="masak" @selected(old('source') === 'masak')>Masak dari sisa</option>
                                <option value="klaim" @selected(old('source') === 'klaim')>Klaim surplus</option>
                            </select>
                            <x-input-error :messages="$errors->get('source')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Deskripsi (opsional)" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                                :value="old('description')" maxlength="160" placeholder="mis. Tumis sisa sayur" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="kg_saved" value="Kg diselamatkan" />
                            <x-text-input id="kg_saved" name="kg_saved" type="number" step="0.1" min="0.1" max="100"
                                class="mt-1 block w-full" :value="old('kg_saved')" required />
                            <x-input-error :messages="$errors->get('kg_saved')" class="mt-2" />
                        </div>

                        <x-primary-button class="w-full justify-center">
                            Catat Aksi
                        </x-primary-button>
                    </form>
                </div>

                <!-- Recent activity -->
                <div class="lg:col-span-2 bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6">
                    <h3 class="font-semibold text-[var(--ink)] mb-4">Aktivitas terbaru</h3>

                    @forelse ($recent as $rescue)
                        <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-[var(--line)]' : '' }}">
                            <div>
                                <div class="text-sm font-semibold text-[var(--ink)]">
                                    {{ $rescue->sourceLabel() }}
                                    @if ($rescue->description)
                                        <span class="font-normal text-[var(--ink-soft)]">&mdash; {{ $rescue->description }}</span>
                                    @endif
                                </div>
                                <div class="text-xs text-[var(--ink-soft)] mt-1">
                                    {{ $rescue->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="text-right shrink-0 ml-4">
                                <div class="text-sm font-bold text-[var(--ink)]">{{ number_format((float) $rescue->kg_saved, 1, ',', '.') }} kg</div>
                                <div class="text-xs text-[var(--ink-soft)]">Rp{{ number_format($rescue->moneySaved(), 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-[var(--ink-soft)]">Belum ada aksi tercatat. Yuk mulai dari form di samping.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
