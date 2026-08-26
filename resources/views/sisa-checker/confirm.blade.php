<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[var(--ink)] leading-tight">
            Konfirmasi Bahan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <p class="text-sm text-[var(--ink-soft)]">
                Ini bahan yang kamu ketik. Ubah, hapus, atau tambah dulu sebelum kami carikan resep yang cocok.
            </p>

            <x-input-error :messages="$errors->get('ingredients')" />

            <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6"
                x-data="{ items: {{ Illuminate\Support\Js::from($ingredients) }}, submitting: false }">
                <form method="POST" action="{{ route('sisa-checker.recipe') }}" class="space-y-4"
                    @submit="submitting = true">
                    @csrf

                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex gap-2">
                            <input type="text" :name="'ingredients[' + index + ']'" x-model="items[index]" required
                                class="block w-full bg-[var(--paper-card)] text-[var(--ink)] border-[var(--line)] focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                            <button type="button" @click="items.splice(index, 1)"
                                class="shrink-0 px-3 rounded-md border border-[var(--line)] text-[var(--ink-soft)] hover:text-red-600 hover:border-red-300">
                                &times;
                            </button>
                        </div>
                    </template>

                    <button type="button" @click="items.push('')"
                        class="text-sm font-semibold text-[var(--leaf)] hover:underline">
                        + Tambah bahan
                    </button>

                    <div class="pt-2">
                        <x-primary-button class="w-full justify-center disabled:opacity-60 disabled:cursor-not-allowed" x-bind:disabled="submitting">
                            <span x-show="!submitting">Buat Resep</span>
                            <span x-show="submitting">Mencari &amp; menerjemahkan resep&hellip;</span>
                        </x-primary-button>
                        <p class="mt-2 text-xs text-center text-[var(--ink-soft)]" x-show="submitting">
                            Mengambil resep dari internet, ini bisa makan waktu sampai sekitar 30 detik.
                        </p>
                    </div>
                </form>
            </div>

            <a href="{{ route('sisa-checker.create') }}" class="block text-center text-sm text-[var(--ink-soft)] hover:underline">
                &larr; Ulangi dari awal
            </a>
        </div>
    </div>
</x-app-layout>
