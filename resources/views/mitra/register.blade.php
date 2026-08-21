<x-guest-layout>
    <div class="mb-4 text-sm text-[var(--ink-soft)]">
        Daftarkan tokomu sebagai mitra SisaRasa untuk menyalurkan makanan surplus ke sekitar sebelum terbuang.
    </div>

    <form method="POST" action="{{ route('mitra.register.store') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" value="Nama kontak" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi password" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
        </div>

        <hr class="border-[var(--line)]">

        <div>
            <x-input-label for="store_name" value="Nama toko/resto" />
            <x-text-input id="store_name" name="store_name" type="text" class="mt-1 block w-full" :value="old('store_name')" required />
            <x-input-error :messages="$errors->get('store_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="store_description" value="Deskripsi singkat (opsional)" />
            <x-text-input id="store_description" name="store_description" type="text" class="mt-1 block w-full" :value="old('store_description')" />
            <x-input-error :messages="$errors->get('store_description')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="address" value="Alamat" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" required />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="latitude" value="Latitude" />
                <x-text-input id="latitude" name="latitude" type="text" class="mt-1 block w-full" :value="old('latitude')" placeholder="-6.2088" required />
                <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="longitude" value="Longitude" />
                <x-text-input id="longitude" name="longitude" type="text" class="mt-1 block w-full" :value="old('longitude')" placeholder="106.8456" required />
                <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
            </div>
        </div>
        <p class="text-xs text-[var(--ink-soft)]">Cari lokasimu di Google Maps, klik kanan pada titiknya, lalu salin koordinat yang muncul.</p>

        <x-primary-button class="w-full justify-center">
            Daftar sebagai Mitra
        </x-primary-button>

        <p class="text-center text-sm text-[var(--ink-soft)]">
            Sudah punya akun? <a href="{{ route('login') }}" class="underline hover:text-[var(--ink)]">Masuk</a>
        </p>
    </form>
</x-guest-layout>
