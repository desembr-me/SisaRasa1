<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[var(--ink)] leading-tight">
            Resepmu Siap
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status') === 'rescue-added')
                <div class="rounded-lg border border-[var(--leaf)] bg-[var(--leaf-soft)] px-4 py-3 text-sm text-[var(--leaf)] font-medium">
                    Aksi berhasil dicatat ke Dashboard Dampak. Terima kasih sudah menyelamatkan makanan!
                </div>
            @endif

            <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6 space-y-5">
                @if (! empty($recipe['image']))
                    <img
                        src="{{ $recipe['image'] }}"
                        alt="{{ $recipe['title'] }}"
                        class="w-full h-56 sm:h-72 object-cover rounded-lg border border-[var(--line)]"
                        loading="lazy"
                    >
                @endif

                <div>
                    <h3 class="font-serif text-2xl font-semibold text-[var(--ink)]">{{ $recipe['title'] }}</h3>
                    <p class="mt-2 text-sm text-[var(--ink-soft)]">{{ $recipe['description'] }}</p>
                </div>

                <div class="flex flex-wrap gap-4 text-xs font-mono text-[var(--ink-soft)]">
                    <span>&#9201; {{ $recipe['cook_time_minutes'] }} menit</span>
                    <span>&#127811; {{ number_format((float) $recipe['estimated_kg_saved'], 1, ',', '.') }} kg terselamatkan</span>
                </div>

                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)] mb-2">Bahan yang dipakai</h4>
                    <ul class="flex flex-wrap gap-2">
                        @foreach ($recipe['ingredients_used'] as $item)
                            <li class="px-3 py-1 rounded-full bg-[var(--leaf-soft)] text-[var(--leaf)] text-xs font-semibold">{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-[var(--ink-soft)] mb-2">Langkah</h4>
                    <ol class="space-y-2 list-decimal list-inside text-sm text-[var(--ink)]">
                        @foreach ($recipe['steps'] as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>

            <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6">
                <form method="POST" action="{{ route('rescues.store') }}">
                    @csrf
                    <input type="hidden" name="source" value="masak">
                    <input type="hidden" name="description" value="{{ $recipe['title'] }}">
                    <input type="hidden" name="kg_saved" value="{{ $recipe['estimated_kg_saved'] }}">
                    <x-primary-button class="w-full justify-center">
                        Catat sebagai Aksi di Dashboard
                    </x-primary-button>
                </form>
            </div>

            <a href="{{ route('sisa-checker.create') }}" class="block text-center text-sm text-[var(--ink-soft)] hover:underline">
                &larr; Buat resep lain
            </a>
        </div>
    </div>
</x-app-layout>
