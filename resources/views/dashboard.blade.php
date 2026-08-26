<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[var(--ink)] leading-tight">
            Dashboard Dampak
        </h2>
        <p class="mt-1 text-sm text-[var(--ink-soft)]">Pantau seberapa besar kontribusimu mengurangi sisa makanan.</p>
    </x-slot>

    @php
        $hour = now()->hour;
        $greeting = match (true) {
            $hour < 11 => 'Selamat pagi',
            $hour < 15 => 'Selamat siang',
            $hour < 19 => 'Selamat sore',
            default => 'Selamat malam',
        };
        $remainingKg = max(0, $nextMilestone - $totalKg);
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status') === 'rescue-added')
                <div class="rounded-lg border border-[var(--leaf)] bg-[var(--leaf-soft)] px-4 py-3 text-sm text-[var(--leaf)] font-medium dash-fade">
                    Aksi berhasil dicatat. Terima kasih sudah menyelamatkan makanan!
                </div>
            @endif

            <!-- Greeting + milestone progress -->
            <div class="dash-fade relative overflow-hidden rounded-xl border border-[var(--line)] p-6 sm:p-7"
                style="background: linear-gradient(120deg, var(--leaf-soft) 0%, var(--paper-card) 65%);">
                <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--leaf)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="dash-sprout w-14 h-14 shrink-0">
                        <path d="M5 13c0-5 4-9 14-9 0 10-4 14-9 14-3 0-5-2-5-5Z" />
                        <path d="M6 18 17 7" />
                    </svg>

                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-3">
                            <h3 class="font-serif text-xl sm:text-2xl font-semibold text-[var(--ink)]">
                                {{ $greeting }}, {{ explode(' ', auth()->user()->name)[0] }} 👋
                            </h3>

                            @if ($streak > 0)
                                <span class="dash-streak-pill inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold text-[#9A5B12]">
                                    <svg viewBox="0 0 24 24" fill="#F4903F" stroke="#D9701F" stroke-width="1" class="dash-streak-flame w-4 h-4">
                                        <path d="M12 22c4 0 7-3 7-7 0-4-3-6-4-9-1 3-2 4-4 4-1-2-1-4 0-6-4 2-6 6-6 10 0 4.5 3 8 7 8Z" />
                                    </svg>
                                    {{ $streak }} hari beruntun
                                </span>
                            @endif
                        </div>
                        <p class="mt-1 text-sm text-[var(--ink-soft)]">
                            Kamu sudah menyelamatkan <strong class="text-[var(--ink)]">{{ number_format($totalKg, 1, ',', '.') }} kg</strong> makanan lewat {{ $totalActions }} aksi.
                        </p>

                        <div class="mt-4">
                            <div class="flex justify-between text-xs font-semibold text-[var(--ink-soft)] mb-1.5">
                                <span>Menuju {{ $nextMilestone }} kg</span>
                                <span>{{ number_format($remainingKg, 1, ',', '.') }} kg lagi</span>
                            </div>
                            <div class="dash-progress-track max-w-md">
                                <div class="dash-progress-fill" style="width: {{ $progressToMilestone }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="dash-fade dash-stat border border-[var(--line)] rounded-lg pl-6 pr-5 py-5"
                    style="--stat-accent: var(--ink-soft); --stat-bg: color-mix(in srgb, var(--ink-soft) 6%, var(--paper-card)); animation-delay: 60ms">
                    <div class="dash-stat-icon w-10 h-10 rounded-full flex items-center justify-center mb-3"
                        style="--icon-bg: color-mix(in srgb, var(--ink-soft) 16%, transparent); --icon-fg: var(--ink-soft)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <path d="M9 4h6a1 1 0 0 1 1 1v1H8V5a1 1 0 0 1 1-1Z" />
                            <path d="M6 6h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1Z" />
                            <path d="m9 13 2 2 4-4" />
                        </svg>
                    </div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Aksi tercatat</div>
                    <div class="mt-1 text-2xl font-bold text-[var(--ink)]"><span data-count-to="{{ $totalActions }}">{{ number_format($totalActions, 0, ',', '.') }}</span></div>
                </div>

                <div class="dash-fade dash-stat border border-[var(--line)] rounded-lg pl-6 pr-5 py-5"
                    style="--stat-accent: var(--leaf); --stat-bg: color-mix(in srgb, var(--leaf) 8%, var(--paper-card)); animation-delay: 120ms">
                    <div class="dash-stat-icon w-10 h-10 rounded-full flex items-center justify-center mb-3"
                        style="--icon-bg: var(--leaf-soft); --icon-fg: var(--leaf)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <path d="M5 13c0-5 4-9 14-9 0 10-4 14-9 14-3 0-5-2-5-5Z" />
                            <path d="M6 18 17 7" />
                        </svg>
                    </div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Makanan terselamatkan</div>
                    <div class="mt-1 text-2xl font-bold text-[var(--ink)]"><span data-count-to="{{ $totalKg }}" data-count-decimals="1">{{ number_format($totalKg, 1, ',', '.') }}</span> kg</div>
                </div>

                <div class="dash-fade dash-stat border border-[var(--line)] rounded-lg pl-6 pr-5 py-5"
                    style="--stat-accent: var(--color-indigo-500); --stat-bg: color-mix(in srgb, var(--color-indigo-500) 8%, var(--paper-card)); animation-delay: 180ms">
                    <div class="dash-stat-icon w-10 h-10 rounded-full flex items-center justify-center mb-3"
                        style="--icon-bg: color-mix(in srgb, var(--color-indigo-500) 18%, transparent); --icon-fg: var(--color-indigo-500)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <path d="M7 18h10a4 4 0 0 0 .5-7.97A5.5 5.5 0 0 0 7.1 9.1 4 4 0 0 0 7 18Z" />
                        </svg>
                    </div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Emisi CO2 dicegah</div>
                    <div class="mt-1 text-2xl font-bold text-[var(--color-indigo-500)]"><span data-count-to="{{ $totalCo2 }}" data-count-decimals="1">{{ number_format($totalCo2, 1, ',', '.') }}</span> kg</div>
                </div>

                <div class="dash-fade dash-stat border border-[var(--line)] rounded-lg pl-6 pr-5 py-5"
                    style="--stat-accent: var(--mango-deep); --stat-bg: color-mix(in srgb, var(--mango) 10%, var(--paper-card)); animation-delay: 240ms">
                    <div class="dash-stat-icon w-10 h-10 rounded-full flex items-center justify-center mb-3"
                        style="--icon-bg: color-mix(in srgb, var(--mango-deep) 18%, transparent); --icon-fg: var(--mango-deep)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <rect x="3" y="7" width="18" height="11" rx="2" />
                            <circle cx="12" cy="12.5" r="2.25" />
                            <path d="M7 7V6a2 2 0 0 1 2-2h8" />
                        </svg>
                    </div>
                    <div class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)]">Nilai ekonomi hemat</div>
                    <div class="mt-1 text-2xl font-bold text-[var(--mango-deep)]">Rp<span data-count-to="{{ $totalRp }}">{{ number_format($totalRp, 0, ',', '.') }}</span></div>
                </div>
            </div>

            <!-- Achievement badges -->
            <div class="dash-fade bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6" style="animation-delay: 280ms">
                <h3 class="font-semibold text-[var(--ink)] mb-1">Lencana pencapaian</h3>
                <p class="text-xs text-[var(--ink-soft)] mb-4">Terus catat aksi penyelamatan untuk membuka semuanya.</p>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                    @foreach ($badges as $i => $badge)
                        @php
                            $accents = ['var(--leaf)', 'var(--color-indigo-500)', 'var(--mango-deep)'];
                            $accent = $accents[$i % 3];
                        @endphp
                        <div title="{{ $badge['desc'] }}"
                            class="dash-badge {{ $badge['achieved'] ? 'dash-badge-earned' : 'dash-badge-locked bg-[var(--paper-warm)]' }} border border-[var(--line)] rounded-lg p-3 text-center"
                            style="{{ $badge['achieved'] ? '--badge-bg: color-mix(in srgb, '.$accent.' 14%, var(--paper-card)); --badge-fg: '.$accent.'; --badge-glow: color-mix(in srgb, '.$accent.' 35%, transparent)' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="{{ $badge['achieved'] ? $accent : 'var(--ink-soft)' }}" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="dash-badge-icon w-6 h-6 mx-auto mb-1.5">
                                @switch($badge['icon'])
                                    @case('clipboard')
                                        <path d="M9 4h6a1 1 0 0 1 1 1v1H8V5a1 1 0 0 1 1-1Z" />
                                        <path d="M6 6h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1Z" />
                                        <path d="m9 13 2 2 4-4" />
                                        @break
                                    @case('leaf')
                                        <path d="M5 13c0-5 4-9 14-9 0 10-4 14-9 14-3 0-5-2-5-5Z" />
                                        <path d="M6 18 17 7" />
                                        @break
                                    @case('flame')
                                        <path d="M12 22c4 0 7-3 7-7 0-4-3-6-4-9-1 3-2 4-4 4-1-2-1-4 0-6-4 2-6 6-6 10 0 4.5 3 8 7 8Z" />
                                        @break
                                    @case('trophy')
                                        <path d="M7 4h10v3a5 5 0 0 1-10 0V4Z" />
                                        <path d="M7 5H4a3 3 0 0 0 3 5" />
                                        <path d="M17 5h3a3 3 0 0 1-3 5" />
                                        <path d="M12 12v4" />
                                        <path d="M9 20h6" />
                                        <path d="M10.5 16h3l.8 4h-4.6l.8-4Z" />
                                        @break
                                @endswitch
                            </svg>
                            <div class="text-[11px] font-semibold leading-tight text-[var(--ink)]">{{ $badge['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Trend chart -->
                <div class="dash-fade lg:col-span-2 bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6" style="animation-delay: 300ms">
                    <h3 class="font-semibold text-[var(--ink)] mb-1">Tren 14 hari terakhir</h3>
                    <p class="text-xs text-[var(--ink-soft)] mb-4">Kilogram makanan yang diselamatkan per hari.</p>

                    <div class="h-48 relative">
                        <canvas id="trendChart"></canvas>
                    </div>
                    <script type="application/json" id="trendChart-data">{!! json_encode($trend) !!}</script>
                </div>

                <!-- Source breakdown donut -->
                <div class="dash-fade bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6" style="animation-delay: 330ms">
                    <h3 class="font-semibold text-[var(--ink)] mb-1">Sumber penyelamatan</h3>
                    <p class="text-xs text-[var(--ink-soft)] mb-4">Masak dari sisa vs klaim surplus.</p>

                    @if ($sourceBreakdown['masak'] > 0 || $sourceBreakdown['klaim'] > 0)
                        <div class="h-40 relative">
                            <canvas id="sourceChart"></canvas>
                        </div>
                        <script type="application/json" id="sourceChart-data">{!! json_encode($sourceBreakdown) !!}</script>
                        <div class="mt-4 flex justify-center gap-4 text-xs font-semibold">
                            <span class="flex items-center gap-1.5 text-[var(--leaf)]"><span class="w-2.5 h-2.5 rounded-full bg-[var(--leaf)] inline-block"></span>Masak</span>
                            <span class="flex items-center gap-1.5 text-[var(--color-indigo-500)]"><span class="w-2.5 h-2.5 rounded-full bg-[var(--color-indigo-500)] inline-block"></span>Klaim</span>
                        </div>
                    @else
                        <div class="h-40 flex items-center justify-center text-center px-4">
                            <p class="text-sm text-[var(--ink-soft)]">Belum ada data. Catat aksi pertamamu dulu.</p>
                        </div>
                    @endif
                </div>

                <!-- Quick add form -->
                <div class="dash-fade bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6" style="animation-delay: 360ms">
                    <h3 class="font-semibold text-[var(--ink)] mb-4">Catat aksi baru</h3>

                    <form method="POST" action="{{ route('rescues.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="source" value="Sumber" />
                            <select id="source" name="source" required
                                class="mt-1 block w-full bg-[var(--paper-card)] text-[var(--ink)] border-[var(--line)] focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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
            </div>

            <!-- Recent activity -->
            <div class="dash-fade bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6" style="animation-delay: 420ms">
                <h3 class="font-semibold text-[var(--ink)] mb-4">Aktivitas terbaru</h3>

                @forelse ($recent as $rescue)
                    <div class="dash-activity-row flex items-center justify-between px-2 py-3 {{ !$loop->last ? 'border-b border-[var(--line)]' : '' }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="dash-activity-icon shrink-0 w-9 h-9 rounded-full flex items-center justify-center"
                                style="{{ $rescue->source === 'masak' ? '--icon-bg: var(--leaf-soft); --icon-fg: var(--leaf)' : '--icon-bg: color-mix(in srgb, var(--color-indigo-500) 18%, transparent); --icon-fg: var(--color-indigo-500)' }}">
                                @if ($rescue->source === 'masak')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px]">
                                        <path d="M4 11h16v3a5 5 0 0 1-5 5h-6a5 5 0 0 1-5-5v-3Z" />
                                        <path d="M2 11h20" />
                                        <path d="M9 11V8M15 11V8" />
                                    </svg>
                                @else
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px]">
                                        <path d="M3 9 6 4h12l3 5" />
                                        <path d="M3 9v9a1 1 0 0 0 1 1h4v-6h8v6h4a1 1 0 0 0 1-1V9" />
                                        <path d="M3 9h18" />
                                    </svg>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <div class="text-sm font-semibold text-[var(--ink)] truncate">
                                    {{ $rescue->sourceLabel() }}
                                    @if ($rescue->description)
                                        <span class="font-normal text-[var(--ink-soft)]">&mdash; {{ $rescue->description }}</span>
                                    @endif
                                </div>
                                <div class="text-xs text-[var(--ink-soft)] mt-0.5">
                                    {{ $rescue->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        <div class="text-right shrink-0 ml-4">
                            <div class="text-sm font-bold text-[var(--ink)]">{{ number_format((float) $rescue->kg_saved, 1, ',', '.') }} kg</div>
                            <div class="text-xs text-[var(--ink-soft)]">Rp{{ number_format($rescue->moneySaved(), 0, ',', '.') }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--line)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 mx-auto mb-2">
                            <path d="M5 13c0-5 4-9 14-9 0 10-4 14-9 14-3 0-5-2-5-5Z" />
                            <path d="M6 18 17 7" />
                        </svg>
                        <p class="text-sm text-[var(--ink-soft)]">Belum ada aksi tercatat. Yuk mulai dari form di atas.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @vite('resources/js/dashboard.js')
</x-app-layout>
