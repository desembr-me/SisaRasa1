<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[var(--ink)] leading-tight">Ubah Listing</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[var(--paper-card)] border border-[var(--line)] rounded-lg p-6">
                <form method="POST" action="{{ route('mitra.listings.update', $listing) }}" class="space-y-4" x-data="{ priceType: '{{ old('price_type', $listing->price_type) }}' }">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="title" value="Nama item" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $listing->title)" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi (opsional)" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $listing->description)" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="quantity" value="Jumlah porsi" />
                        <x-text-input id="quantity" name="quantity" type="number" min="1" max="1000" class="mt-1 block w-full" :value="old('quantity', $listing->quantity)" required />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label value="Tipe harga" />
                        <div class="flex gap-4 mt-1">
                            <label class="inline-flex items-center gap-2 text-sm text-[var(--ink-soft)]">
                                <input type="radio" name="price_type" value="gratis" x-model="priceType" class="text-indigo-600 focus:ring-indigo-500"> Gratis
                            </label>
                            <label class="inline-flex items-center gap-2 text-sm text-[var(--ink-soft)]">
                                <input type="radio" name="price_type" value="diskon" x-model="priceType" class="text-indigo-600 focus:ring-indigo-500"> Diskon
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('price_type')" class="mt-2" />
                    </div>

                    <div x-show="priceType === 'diskon'" class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="original_price" value="Harga normal (Rp)" />
                            <x-text-input id="original_price" name="original_price" type="number" min="0" class="mt-1 block w-full" :value="old('original_price', $listing->original_price)" />
                        </div>
                        <div>
                            <x-input-label for="discounted_price" value="Harga diskon (Rp)" />
                            <x-text-input id="discounted_price" name="discounted_price" type="number" min="0" class="mt-1 block w-full" :value="old('discounted_price', $listing->discounted_price)" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="estimated_kg" value="Estimasi kg per porsi" />
                        <x-text-input id="estimated_kg" name="estimated_kg" type="number" step="0.1" min="0.1" max="100" class="mt-1 block w-full" :value="old('estimated_kg', $listing->estimated_kg)" required />
                        <x-input-error :messages="$errors->get('estimated_kg')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="expires_at" value="Berlaku sampai" />
                        <x-text-input id="expires_at" name="expires_at" type="datetime-local" class="mt-1 block w-full" :value="old('expires_at', $listing->expires_at->format('Y-m-d\TH:i'))" required />
                        <x-input-error :messages="$errors->get('expires_at')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <x-primary-button>Simpan Perubahan</x-primary-button>
                        <a href="{{ route('mitra.listings.index') }}" class="text-sm text-[var(--ink-soft)] hover:text-[var(--ink)]">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
