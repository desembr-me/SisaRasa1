<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[var(--ink)] leading-tight">
            Sisa Checker
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <p class="text-sm text-[var(--ink-soft)]">
                Ketik bahan yang masih tersisa di kulkas, dan kami carikan resep yang cocok dari koleksi resep sisa dapur.
            </p>

            <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6">
                <form method="POST" action="{{ route('sisa-checker.identify') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="ingredients_text" value="Ketik bahan (pisahkan dengan koma)" />
                        <x-text-input id="ingredients_text" name="ingredients_text" type="text" class="mt-1 block w-full"
                            :value="old('ingredients_text', request('bahan'))" placeholder="mis. wortel, telur, nasi putih" required autofocus />
                        <x-input-error :messages="$errors->get('ingredients_text')" class="mt-2" />
                    </div>

                    <x-primary-button class="w-full justify-center">
                        Cari Resep
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
