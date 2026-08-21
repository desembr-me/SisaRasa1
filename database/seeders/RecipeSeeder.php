<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = [
            [
                'title' => 'Nasi Goreng Sisa',
                'description' => 'Nasi goreng cepat dari nasi semalam dan sisa sayur di kulkas.',
                'ingredients' => ['nasi putih', 'telur', 'wortel', 'bawang putih', 'kecap manis', 'cabai'],
                'steps' => [
                    'Tumis bawang putih cincang hingga harum.',
                    'Masukkan wortel potong dadu, tumis sebentar.',
                    'Sisihkan tumisan, orak-arik telur di wajan yang sama.',
                    'Masukkan nasi putih dan kecap manis, aduk rata dengan tumisan tadi.',
                    'Tambahkan cabai sesuai selera, masak hingga nasi panas merata.',
                ],
                'cook_time_minutes' => 15,
                'estimated_kg' => 0.4,
            ],
            [
                'title' => 'Omelet Sayur Campur',
                'description' => 'Omelet padat gizi dari telur dan sisa sayuran potong.',
                'ingredients' => ['telur', 'wortel', 'bayam', 'bawang bombay', 'daun bawang'],
                'steps' => [
                    'Kocok telur dengan sedikit garam dan merica.',
                    'Cincang halus wortel, bayam, dan bawang bombay.',
                    'Campurkan semua sayuran ke dalam kocokan telur.',
                    'Tuang ke wajan panas berminyak, masak dengan api kecil hingga matang di kedua sisi.',
                ],
                'cook_time_minutes' => 12,
                'estimated_kg' => 0.3,
            ],
            [
                'title' => 'Tumis Bayam Bawang Putih',
                'description' => 'Tumisan cepat dan sehat untuk bayam yang mulai layu.',
                'ingredients' => ['bayam', 'bawang putih', 'cabai', 'tomat'],
                'steps' => [
                    'Panaskan minyak, tumis bawang putih cincang hingga harum.',
                    'Masukkan cabai dan tomat, tumis sebentar.',
                    'Masukkan bayam, aduk cepat hingga layu.',
                    'Beri garam dan sedikit air, masak 2 menit lalu angkat.',
                ],
                'cook_time_minutes' => 8,
                'estimated_kg' => 0.25,
            ],
            [
                'title' => 'Tempe Orek Kecap',
                'description' => 'Tempe manis gurih yang cocok untuk sisa tempe di kulkas.',
                'ingredients' => ['tempe', 'kecap manis', 'bawang merah', 'cabai', 'bawang putih'],
                'steps' => [
                    'Potong tempe dadu kecil, goreng setengah kering.',
                    'Tumis bawang merah, bawang putih, dan cabai hingga harum.',
                    'Masukkan tempe goreng, aduk rata.',
                    'Tambahkan kecap manis dan sedikit air, masak hingga meresap.',
                ],
                'cook_time_minutes' => 15,
                'estimated_kg' => 0.3,
            ],
            [
                'title' => 'Perkedel Kentang Sisa',
                'description' => 'Camilan gurih dari kentang sisa yang mulai bertunas dikit.',
                'ingredients' => ['kentang', 'telur', 'daun bawang', 'bawang putih'],
                'steps' => [
                    'Kukus dan haluskan kentang.',
                    'Campur dengan daun bawang cincang, bawang putih halus, dan sebagian telur.',
                    'Bentuk bulat pipih, celup ke sisa telur.',
                    'Goreng hingga kuning keemasan.',
                ],
                'cook_time_minutes' => 20,
                'estimated_kg' => 0.35,
            ],
            [
                'title' => 'Sup Sayur Rumahan',
                'description' => 'Sup hangat untuk menghabiskan sayuran campur di kulkas.',
                'ingredients' => ['wortel', 'kentang', 'kol', 'daun bawang', 'bawang putih'],
                'steps' => [
                    'Rebus air dengan bawang putih hingga mendidih.',
                    'Masukkan kentang dan wortel potong dadu, masak hingga setengah empuk.',
                    'Masukkan kol, masak hingga semua sayur empuk.',
                    'Taburi daun bawang, beri garam dan merica secukupnya.',
                ],
                'cook_time_minutes' => 25,
                'estimated_kg' => 0.5,
            ],
            [
                'title' => 'Cap Cay Sisa Sayur',
                'description' => 'Tumisan aneka sayur ala restoran dari sisa sayuran di kulkas.',
                'ingredients' => ['wortel', 'kol', 'sawi', 'buncis', 'bawang putih'],
                'steps' => [
                    'Tumis bawang putih cincang hingga harum.',
                    'Masukkan wortel dan buncis, tumis 2 menit.',
                    'Masukkan kol dan sawi, aduk rata.',
                    'Beri sedikit air, garam, dan merica, masak hingga sayur layu tapi masih renyah.',
                ],
                'cook_time_minutes' => 12,
                'estimated_kg' => 0.45,
            ],
            [
                'title' => 'Tahu Telur Kecap',
                'description' => 'Tahu goreng disiram telur dan kecap, cepat dan mengenyangkan.',
                'ingredients' => ['tahu', 'telur', 'tauge', 'kecap manis'],
                'steps' => [
                    'Potong tahu, goreng hingga kecokelatan.',
                    'Kocok telur, tuang di atas tahu goreng dalam wajan yang sama.',
                    'Masak hingga telur setengah matang, balik sebentar.',
                    'Sajikan dengan tauge dan siraman kecap manis.',
                ],
                'cook_time_minutes' => 15,
                'estimated_kg' => 0.35,
            ],
            [
                'title' => 'Mie Goreng Sisa Sayur',
                'description' => 'Mie goreng simpel dari mie instan/basah dan sisa sayur.',
                'ingredients' => ['mie', 'telur', 'wortel', 'kol', 'bawang putih'],
                'steps' => [
                    'Rebus mie sebentar jika masih mentah, tiriskan.',
                    'Tumis bawang putih, masukkan wortel dan kol.',
                    'Sisihkan sayur, orak-arik telur di wajan yang sama.',
                    'Masukkan mie dan sayur kembali, aduk rata dengan kecap dan bumbu.',
                ],
                'cook_time_minutes' => 15,
                'estimated_kg' => 0.4,
            ],
            [
                'title' => 'Roti Panggang Telur',
                'description' => 'Sarapan cepat dari roti tawar yang mulai mengeras dan telur.',
                'ingredients' => ['roti', 'telur', 'susu'],
                'steps' => [
                    'Kocok telur dengan sedikit susu dan garam.',
                    'Celupkan roti tawar ke campuran telur hingga terserap.',
                    'Panggang di wajan dengan sedikit mentega hingga kecokelatan di kedua sisi.',
                ],
                'cook_time_minutes' => 10,
                'estimated_kg' => 0.2,
            ],
            [
                'title' => 'Sup Ayam Sisa',
                'description' => 'Sup hangat dari sisa ayam dan sayuran di kulkas.',
                'ingredients' => ['ayam', 'wortel', 'kentang', 'daun bawang', 'bawang putih'],
                'steps' => [
                    'Rebus ayam bersama bawang putih hingga empuk, suwir jika perlu.',
                    'Masukkan kentang dan wortel potong dadu, masak hingga empuk.',
                    'Beri garam dan merica secukupnya.',
                    'Taburi daun bawang sebelum disajikan.',
                ],
                'cook_time_minutes' => 30,
                'estimated_kg' => 0.5,
            ],
            [
                'title' => 'Ayam Suwir Bumbu Sisa',
                'description' => 'Ayam suwir pedas gurih dari sisa ayam matang.',
                'ingredients' => ['ayam', 'bawang putih', 'cabai', 'bawang merah'],
                'steps' => [
                    'Suwir ayam matang menjadi serat kecil.',
                    'Haluskan bawang merah, bawang putih, dan cabai, tumis hingga harum.',
                    'Masukkan ayam suwir, aduk rata dengan bumbu.',
                    'Masak hingga bumbu meresap, sesuaikan rasa.',
                ],
                'cook_time_minutes' => 15,
                'estimated_kg' => 0.35,
            ],
            [
                'title' => 'Tumis Terong Balado',
                'description' => 'Terong pedas manis, cocok untuk terong yang mulai lembek.',
                'ingredients' => ['terong', 'cabai', 'bawang merah', 'tomat'],
                'steps' => [
                    'Potong terong memanjang, goreng sebentar.',
                    'Haluskan cabai, bawang merah, dan tomat, tumis hingga matang.',
                    'Masukkan terong goreng, aduk rata dengan bumbu.',
                    'Masak sebentar hingga bumbu meresap.',
                ],
                'cook_time_minutes' => 15,
                'estimated_kg' => 0.3,
            ],
            [
                'title' => 'Sayur Asem Rumahan',
                'description' => 'Sayur asem segar untuk menghabiskan sisa sayuran campur.',
                'ingredients' => ['kacang panjang', 'jagung', 'terong', 'tomat', 'daun bawang'],
                'steps' => [
                    'Rebus air dengan asam jawa dan gula merah hingga mendidih.',
                    'Masukkan jagung, masak beberapa menit.',
                    'Masukkan kacang panjang, terong, dan tomat.',
                    'Masak hingga semua sayur empuk, beri garam secukupnya.',
                ],
                'cook_time_minutes' => 25,
                'estimated_kg' => 0.5,
            ],
            [
                'title' => 'Bakwan Sayur',
                'description' => 'Gorengan renyah untuk menghabiskan sisa sayuran dan tepung.',
                'ingredients' => ['wortel', 'kol', 'tepung', 'daun bawang'],
                'steps' => [
                    'Iris tipis wortel, kol, dan daun bawang.',
                    'Campur dengan tepung, air, dan garam hingga jadi adonan kental.',
                    'Goreng satu sendok sayur per bakwan hingga kecokelatan.',
                ],
                'cook_time_minutes' => 15,
                'estimated_kg' => 0.35,
            ],
            [
                'title' => 'Tumis Buncis Wortel',
                'description' => 'Tumisan simpel dan renyah, favorit anak kos.',
                'ingredients' => ['buncis', 'wortel', 'bawang putih', 'cabai'],
                'steps' => [
                    'Tumis bawang putih dan cabai hingga harum.',
                    'Masukkan wortel, tumis 2 menit.',
                    'Masukkan buncis, tambahkan sedikit air.',
                    'Masak hingga sayur matang tapi masih renyah.',
                ],
                'cook_time_minutes' => 10,
                'estimated_kg' => 0.3,
            ],
            [
                'title' => 'Udang Goreng Tepung',
                'description' => 'Udang crispy sederhana untuk sisa udang di freezer.',
                'ingredients' => ['udang', 'tepung', 'telur', 'bawang putih'],
                'steps' => [
                    'Bersihkan udang, lumuri bawang putih halus dan garam.',
                    'Celupkan ke telur kocok, lalu balur tepung.',
                    'Goreng hingga kecokelatan dan matang merata.',
                ],
                'cook_time_minutes' => 15,
                'estimated_kg' => 0.3,
            ],
            [
                'title' => 'Nasi Bakar Sisa Ayam',
                'description' => 'Nasi gurih dibungkus daun, cara kreatif habiskan nasi dan ayam sisa.',
                'ingredients' => ['nasi putih', 'ayam', 'bawang putih', 'daun kemangi'],
                'steps' => [
                    'Suwir ayam matang, tumis dengan bawang putih halus.',
                    'Campur nasi putih dengan ayam suwir dan daun kemangi.',
                    'Bungkus dengan daun pisang atau aluminium foil.',
                    'Panggang di wajan datar atau oven hingga harum, sekitar 10 menit.',
                ],
                'cook_time_minutes' => 20,
                'estimated_kg' => 0.4,
            ],
        ];

        foreach ($recipes as $recipe) {
            Recipe::create($recipe);
        }
    }
}
