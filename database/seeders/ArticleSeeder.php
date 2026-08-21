<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Mengenal Peta Jalan Susut dan Sisa Pangan Bappenas 2024',
                'excerpt' => 'Pada 3 Juli 2024, Bappenas meluncurkan peta jalan nasional pertama yang secara khusus menyasar susut dan sisa pangan — dengan target bertahap sampai 2045.',
                'body' => <<<'MD'
Pada 3 Juli 2024, Kementerian PPN/Bappenas meluncurkan **Peta Jalan Pengelolaan Susut dan Sisa Pangan dalam Mendukung Pencapaian Ketahanan Pangan Menuju Indonesia Emas 2045**, disusun bersama GAIN (Global Alliance for Improved Nutrition), JP2GI, dan LCI (Life Cycle Indonesia), dengan baseline data tahun 2021.

Ini penting karena sebelumnya, isu sisa pangan selalu jadi bagian kecil dari kebijakan pengelolaan sampah yang lebih umum (sejak UU No. 18/2008). Peta jalan ini yang pertama kali menaruh susut dan sisa pangan sebagai agenda tersendiri, dengan target pengurangan bertahap:

- 2025–2029: 34,45%
- 2030–2034: 45,03%
- 2035–2039: 51,88%
- 2040–2045: 55,88%

**Catatan jujur:** beberapa publikasi resmi lain dari Badan Pangan Nasional (NFA) menyebut angka target akhir 75% pada 2045. Kemungkinan ini berasal dari basis perhitungan atau dokumen revisi yang berbeda. Kami menampilkan angka bertahap dari dokumen peta jalan sebagai angka utama, dengan catatan ini supaya tidak menyesatkan.

Di titik inilah SisaRasa memposisikan diri: bukan pengganti kebijakan nasional, tapi alat bagi rumah tangga dan mitra usaha untuk ikut berkontribusi pada target ini secara terukur — lewat Sisa Checker, Peta Surplus, dan Dashboard Dampak.
MD,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Dari UU Sampah 2008 ke Gerakan Selamatkan Pangan 2022',
                'excerpt' => 'Perjalanan kebijakan Indonesia soal sampah dan sisa pangan tidak dimulai dari satu titik — ini rangkaian kebijakan selama lebih dari satu dekade.',
                'body' => <<<'MD'
Sebelum ada peta jalan khusus sisa pangan, ada rangkaian kebijakan yang membangun fondasinya:

**6 Mei 2008** — UU No. 18/2008 tentang Pengelolaan Sampah disahkan. Ini paradigma baru: sampah mulai dipandang sebagai sumber daya bernilai ekonomi, bukan sekadar sesuatu yang dibuang. TPA dengan sistem *open dumping* mulai dilarang sejak 2013. Tapi undang-undang ini masih bicara sampah secara umum, belum spesifik ke sisa pangan.

**2015** — PBB menyepakati Sustainable Development Goals (SDGs). Target 12.3 secara eksplisit menargetkan separuh sisa pangan per kapita dunia berkurang pada 2030 — inilah titik sisa pangan mulai masuk agenda global.

**2021** — Bappenas mempublikasikan kajian *food loss & waste* Indonesia periode 2000–2019: 23–48 juta ton per tahun, dengan kerugian ekonomi hingga Rp551 triliun atau 4–5% PDB.

**2022** — Badan Pangan Nasional meluncurkan Gerakan Selamatkan Pangan (GSP) di 15 provinsi — upaya pertama yang secara langsung menyasar penyelamatan makanan berlebih, bukan cuma pengelolaan sampahnya.

Rangkaian inilah yang akhirnya bermuara ke peta jalan 2024 yang lebih terukur dan menjadi konteks dari apa yang SisaRasa coba bangun hari ini.
MD,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Kenapa SisaRasa Ada',
                'excerpt' => 'Data nasional soal sisa pangan itu besar dan abstrak. SisaRasa mencoba menerjemahkannya jadi aksi yang bisa dilakukan satu rumah tangga hari ini.',
                'body' => <<<'MD'
Angka-angka soal sisa pangan Indonesia — 23–48 juta ton per tahun, kerugian ratusan triliun rupiah, target pengurangan bertahap sampai 2045 — semuanya nyata, tapi sulit dirasakan di level rumah tangga. Tidak ada yang bangun pagi lalu berpikir "hari ini saya berkontribusi ke 0,0001% dari target nasional."

SisaRasa dibangun dari pertanyaan yang lebih kecil dan lebih konkret: *bahan apa yang ada di kulkasmu sekarang, dan bisa jadi apa sebelum basi?*

Tiga hal yang kami coba sediakan:

1. **Sisa Checker** — ketik bahan sisa, dapat resep yang benar-benar bisa dimasak hari ini.
2. **Peta Surplus** *(dalam pengembangan)* — temukan makanan surplus dari resto/toko sekitar sebelum terbuang.
3. **Dashboard Dampak** — setiap aksi kecil dihitung: kg makanan, emisi karbon, nilai ekonomi yang terselamatkan.

Kami tidak mengklaim SisaRasa akan mencapai target nasional sendirian. Tapi kalau peta jalan 2024 butuh jutaan rumah tangga bergerak bertahap sampai 2045, SisaRasa ingin jadi salah satu alat paling sederhana untuk memulai gerakan itu — dari dapur, bukan dari rapat kebijakan.
MD,
                'published_at' => now()->subDay(),
            ],
        ];

        foreach ($articles as $article) {
            Article::create([
                ...$article,
                'slug' => Str::slug($article['title']),
            ]);
        }
    }
}
