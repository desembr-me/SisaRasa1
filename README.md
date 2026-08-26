# SisaRasa

**Dari sisa, jadi berkah.**

SisaRasa adalah aplikasi web yang membantu rumah tangga menyelamatkan makanan sebelum terbuang sia-sia. Dibuat sebagai proyek untuk lomba pengembangan solusi *food waste* di Indonesia.

Latar belakangnya sederhana: menurut kajian Bappenas, Waste4Change & WRI (2021) serta data KLHK/SIPSN, Indonesia membuang 23–48 juta ton makanan setiap tahun — sekitar 40% dari total sampah nasional — dengan kerugian ekonomi hingga Rp551 triliun. SisaRasa mencoba menerjemahkan masalah berskala nasional itu menjadi tiga aksi kecil yang bisa dilakukan siapa saja hari ini.

## Tujuan

1. **Mengurangi sisa makanan di rumah** — bantu orang menghabiskan bahan yang sudah ada di kulkas sebelum basi, alih-alih membeli/membuang lagi.
2. **Menyalurkan makanan surplus** — hubungkan resto/toko yang punya makanan berlebih menjelang tutup dengan orang yang bisa memanfaatkannya, sebelum jadi sampah.
3. **Membuat dampaknya terlihat** — setiap aksi kecil (masak dari sisa, klaim surplus) dicatat dan dihitung: berapa kg makanan, emisi karbon, dan nilai ekonomi yang terselamatkan. Dampak yang tidak terlihat sulit dirasakan; SisaRasa mencoba membuatnya konkret.

## Fitur

### Sudah berfungsi

| Fitur | Deskripsi |
|---|---|
| **Sisa Checker** | Ketik bahan yang tersisa di kulkas (dipisah koma), konfirmasi/ubah daftarnya, lalu sistem mencocokkannya dengan koleksi resep lokal (bukan AI — pencocokan berbasis kecocokan bahan, lihat catatan di bawah) dan menyusun resep lengkap. |
| **Dashboard Dampak** | Setiap resep yang dimasak atau surplus yang diklaim bisa dicatat sebagai "aksi". Dashboard menghitung total kg makanan terselamatkan, estimasi emisi CO2 dicegah, dan nilai ekonomi yang hemat, plus riwayat aktivitas. |
| **Registrasi & pengelolaan Mitra** | Resto/toko bisa mendaftar sebagai mitra (`/mitra/register`) dengan profil toko (nama, alamat, koordinat), lalu mengelola listing makanan surplus mereka sendiri (buat, ubah, hapus) di `/mitra`. |
| **Klaim listing** | Pengguna yang login bisa mengklaim listing milik mitra; klaim otomatis tercatat sebagai aksi di Dashboard Dampak mereka. |
| **Panel Admin** | Pengguna dengan role `admin` (lihat akun demo di bawah) bisa melihat statistik seluruh platform dan mengelola daftar pengguna (cari, lihat detail, ubah role, hapus) di `/admin`. |
| **Kalkulator Model Dampak** | Di landing page — slider untuk mengestimasi potensi dampak nasional jika sejumlah rumah tangga memakai SisaRasa (murni ilustratif, dilabeli jelas sebagai estimasi bukan riset resmi). |
| **Cerita** | Tiga tulisan penjelas yang merangkum kebijakan resmi soal sisa pangan Indonesia (UU 18/2008, peta jalan Bappenas 2024, dll), bisa diakses lewat `/cerita/{slug}`. |

### Dalam pengembangan / belum lengkap

- **Peta Surplus** — halaman publik untuk *melihat* dan mengklaim listing di peta (rencananya pakai Leaflet + OpenStreetMap, sudah terpasang sebagai dependency) belum dibangun. Model, controller, dan route (`/peta-surplus`) sudah ada, tapi *view*-nya belum — mengunjungi rute ini akan error sampai halamannya dibuat. Saat ini mitra bisa membuat listing lewat `/mitra`, tapi belum ada tempat bagi pengguna biasa untuk menemukannya.
- **Cerita** belum ditautkan dari navigasi utama landing page (halaman & routing-nya berfungsi, hanya belum ada link masuk dari beranda).

## Catatan penting: kenapa Sisa Checker tidak pakai AI

Awalnya Sisa Checker dirancang memakai AI (OpenAI GPT-4o-mini) untuk mengenali bahan dari foto dan menyusun resep. Fitur ini sempat dibangun penuh, tapi akun OpenAI yang dipakai tidak punya kuota/billing aktif sehingga selalu gagal. Daripada membiarkan fitur inti tidak bisa dites, Sisa Checker diubah menjadi **pencocokan resep**: pengguna mengetik bahan (bukan foto), sistem menerjemahkan bahan tersebut ke Inggris (`IngredientTranslator`) lalu mencarikan resep secara *live* dari [TheMealDB](https://www.themealdb.com/api.php) (API gratis, tanpa perlu daftar/API key), dan memilih resep dengan jumlah bahan yang paling cocok — lengkap dengan foto makanannya. Konsekuensinya: butuh koneksi internet saat dipakai, dan resep/instruksinya berbahasa Inggris karena TheMealDB belum punya masakan Indonesia. Tabel `recipes` beserta `RecipeSeeder` (18 resep lokal) masih ada di kode sebagai peninggalan versi sebelumnya, tapi sudah tidak dipakai (tidak lagi dipanggil dari `DatabaseSeeder`).

## Tech stack

- **Backend**: Laravel 12 (PHP 8.3+), autentikasi dari Laravel Breeze (Blade + Alpine.js)
- **Database**: SQLite (`database/database.sqlite`) — bisa diganti ke MySQL/PostgreSQL lewat `.env`
- **Frontend**: Blade templates, Tailwind CSS v4 (via `@tailwindcss/vite`), Alpine.js untuk interaktivitas ringan
- **Landing page**: HTML/CSS custom terpisah dari sisa aplikasi (`resources/css/landing.css`, `resources/js/landing.js`) — bukan Tailwind, didesain manual (font Fraunces + Plus Jakarta Sans + JetBrains Mono, palet hijau daun/mangga)
- **Build tool**: Vite

## Struktur database

```
users
├─ id, name, email, password, role (user | admin | mitra), timestamps
└─ relasi: hasMany rescues, hasOne store

rescues                          -- aksi yang tercatat di Dashboard Dampak
├─ id, user_id, source (masak | klaim), description, kg_saved, timestamps
└─ belongsTo user

recipes                          -- koleksi resep lokal untuk Sisa Checker
└─ id, title, description, ingredients (json), steps (json),
   cook_time_minutes, estimated_kg, timestamps

stores                           -- profil toko/resto milik satu user (role: mitra)
├─ id, user_id (unik), name, description, address, latitude, longitude, timestamps
├─ belongsTo user
└─ hasMany listings

listings                         -- item makanan surplus yang diposting mitra
├─ id, store_id, title, description, quantity,
│  price_type (gratis | diskon), original_price, discounted_price,
│  estimated_kg, expires_at, timestamps
├─ belongsTo store
└─ hasMany claims

claims                           -- pengguna mengklaim satu listing
├─ id, listing_id, user_id, quantity, timestamps
└─ belongsTo listing, user

articles                         -- konten "Cerita"
└─ id, title, slug, excerpt, body, published_at, timestamps
```

Tabel `password_reset_tokens`, `sessions`, `cache`, `jobs` adalah tabel standar bawaan Laravel/Breeze.

## Menjalankan proyek ini

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

# buat file database SQLite kalau belum ada
touch database/database.sqlite

php artisan migrate --seed   # menjalankan seeder: role (user/admin/mitra), articles

npm run build                 # atau `npm run dev` untuk mode development

php artisan serve
```

Kalau ingin memakai Sisa Checker versi AI di masa depan, isi `OPENAI_API_KEY` dan `OPENAI_MODEL` di `.env` — namun perlu diimplementasikan ulang karena integrasi OpenAI sudah dilepas dari kode saat ini (lihat catatan di atas).

### Akun demo

Setelah `php artisan migrate --seed`, tersedia tiga akun (dibuat oleh `RoleSeeder`, satu per role):

| Email | Password | Role |
|---|---|---|
| `admin@sisarasa.com` | `password` | admin — akses `/admin` |
| `test@example.com` | `password` | user biasa |
| `mitra@sisarasa.com` | `password` | mitra — akses `/mitra`, sudah punya toko ("Warung Berkah") tapi belum ada listing |

Mitra baru juga tetap bisa daftar sendiri lewat `/mitra/register`.

## Deploy ke shared hosting / VPS (mis. HestiaCP)

Dua file penting **sengaja tidak ikut ke GitHub** (praktik umum, bukan bug): `.env` (rahasia per-server) dan `database/database.sqlite` (data lokal), plus `public/build/` (hasil compile Vite) yang di-gitignore. Ketiganya harus dibuat/diisi ulang di server — kalau terlewat, gejalanya bisa berupa halaman error di **semua** URL (bukan cuma soal database), karena Laravel butuh `public/build/manifest.json` untuk memuat CSS/JS.

**1. Build assets dulu di komputer lokal**, karena banyak shared hosting tidak menyediakan Node.js di SSH-nya:
```bash
npm run build
```
Ini menghasilkan folder `public/build/`. Folder ini harus ikut di-upload ke server (lewat `git add -f public/build` di branch deploy terpisah, atau upload manual via SFTP/File Manager) — jangan andalkan `npm run build` bisa jalan di server kalau belum yakin Node tersedia di sana.

**2. Upload/pull kode ke server**, lalu di server (lewat SSH atau Web Terminal HestiaCP):
```bash
composer install --no-dev --optimize-autoloader   # kalau composer tersedia di server;
                                                     # kalau tidak, upload folder vendor/ dari lokal juga

cp .env.example .env
php artisan key:generate
```

**3. Isi `.env` sesuai server** — minimal ubah ini:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domainkamu.com
```

**4. Database** — di shared hosting berbasis HestiaCP, database MySQL lewat panel biasanya lebih stabil daripada SQLite (tidak tergantung izin tulis folder & ekstensi `pdo_sqlite`). Buat database baru di menu **Databases** HestiaCP, lalu isi `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_dari_hestiacp
DB_USERNAME=user_dari_hestiacp
DB_PASSWORD=password_dari_hestiacp
```
Kalau tetap ingin pakai SQLite, cukup `touch database/database.sqlite` dan pastikan folder `database/` bisa ditulis oleh user PHP-FPM domain tersebut.

**5. Jalankan migrasi + seeder, lalu cek folder yang wajib writable:**
```bash
php artisan migrate --seed --force
chmod -R 775 storage bootstrap/cache
```

**6. Arahkan document root domain ke folder `public/`** (bukan ke root project) lewat pengaturan Web domain di HestiaCP — supaya `.env`, `app/`, dan file lain di luar `public/` tidak bisa diakses langsung lewat browser.

**Kalau masih error setelah semua ini**, set sementara `APP_DEBUG=true` di `.env` server untuk melihat pesan error aslinya (Laravel dengan `APP_DEBUG=false` cuma menampilkan halaman "500 | Server Error" generik tanpa detail) — lalu jangan lupa kembalikan ke `false` setelah masalahnya ketemu, karena `APP_DEBUG=true` di production membocorkan detail internal aplikasi.

## Struktur folder yang relevan

```
app/Http/Controllers/           -- DashboardController, SisaCheckerController, ClaimController,
                                    Admin/AdminDashboardController, Mitra/*, ArticleController, dst.
app/Models/                     -- User, Rescue, Recipe (tidak dipakai lagi), Store, Listing, Claim, Article
app/Services/RecipeMatcherService.php  -- cari & cocokkan resep dari TheMealDB untuk Sisa Checker
app/Services/IngredientTranslator.php  -- kamus bahan Indonesia -> Inggris untuk pencarian di TheMealDB
database/seeders/                -- RoleSeeder (akun demo per role), ArticleSeeder (RecipeSeeder sudah tidak dipanggil)
resources/views/landing.blade.php      -- landing page (didesain manual, terpisah dari Breeze)
resources/views/dashboard.blade.php    -- Dashboard Dampak pengguna
resources/views/admin/                 -- panel admin
resources/views/mitra/                 -- registrasi & pengelolaan listing mitra
resources/views/sisa-checker/          -- alur 3 langkah Sisa Checker
resources/css/landing.css              -- gaya khusus landing page
resources/css/app.css                  -- gaya untuk halaman ber-autentikasi (Tailwind + token warna kustom)
```

## Lisensi

Dibuat untuk lomba pengembangan solusi *food waste*. Dibangun di atas [Laravel](https://laravel.com), yang dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).
