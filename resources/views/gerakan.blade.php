<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ config('app.name', 'SisaRasa') }} — Gerakan Bumi</title>
<meta name="description" content="Menghubungkan aksi kecil di dapur rumah tangga dengan krisis iklim: data resmi, peta jalan enam pilar, dan sejarah kebijakan sisa makanan Indonesia.">
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;1,9..144,500;1,9..144,600&family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
@vite(['resources/css/gerakan.css', 'resources/js/gerakan.js'])
</head>
<body>

<nav class="g-nav" id="gNav">
    <div class="wrap">
        <a href="{{ route('gerakan') }}" class="g-logo">
            <svg width="24" height="24" viewBox="0 0 30 30" fill="none">
                <circle cx="15" cy="15" r="13.5" stroke="currentColor" stroke-width="1.4" stroke-dasharray="2.5 3.2"/>
                <path d="M10 16.5C10 13 12.5 10 15.5 9.5C15.5 12.5 13.5 14.5 10 16.5Z" fill="#BFE49B"/>
                <path d="M20 16.5C20 13 17.5 10 14.5 9.5C14.5 12.5 16.5 14.5 20 16.5Z" fill="#F4903F"/>
            </svg>
            Gerakan Bumi
        </a>
        <a href="/" class="g-back">&larr; SisaRasa.app</a>
    </div>
</nav>

<!-- ============ HERO ============ -->
<section class="hero" id="top">
    <div class="hero-canvas-wrap" aria-hidden="true">
        <svg id="myceliumSvg" viewBox="0 0 900 500" preserveAspectRatio="xMidYMax meet"></svg>
    </div>

    <div class="wrap">
        <div class="hero-content">
            <span class="eyebrow">Sisa makanan &rarr; krisis iklim</span>
            <h1>Yang membusuk di dapurmu, <span class="italic-accent grad-text">ikut memanaskan bumi.</span></h1>
            <p class="lead">
                SisaRasa bukan sekadar aplikasi antisisa makanan. Ini titik temu antara aksi sekecil menyimpan sisa sayur
                dan angka emisi nasional yang menentukan arah krisis iklim Indonesia.
            </p>
            <div class="hero-actions">
                <a href="{{ route('sisa-checker.create') }}" class="g-btn g-btn-primary">Mulai selamatkan sisa</a>
                <a href="#data" class="g-btn g-btn-ghost">Lihat datanya</a>
            </div>
            <div class="hero-meta">
                <span><strong>23–48 juta ton</strong> sisa &amp; susut pangan / tahun &mdash; Bappenas</span>
                <span><strong>7,29%</strong> emisi GRK tahunan Indonesia &mdash; Bappenas</span>
                <span><strong>40,76%</strong> dari sampah nasional adalah sisa makanan &mdash; SIPSN, KLHK</span>
            </div>
        </div>
    </div>

    <div class="scroll-cue"><span class="line"></span>scroll</div>
</section>

<!-- ============ MENGUKUR KEMAJUAN ============ -->
<section class="g-section" id="data">
    <div class="wrap">
        <div class="g-section-head">
            <span class="eyebrow">Mengukur kemajuan</span>
            <h2>Angka yang menghubungkan dapurmu dengan atmosfer bumi</h2>
            <p>Setiap klaim di halaman ini bersumber dari lembaga resmi &mdash; Bappenas, KLHK, dan Badan Pangan
                Nasional &mdash; supaya jelas: ini bukan masalah kecil yang bisa diabaikan.</p>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-num grad-text">23<span class="stat-unit">&ndash;48 juta ton</span></div>
                <div class="stat-label">Sisa &amp; susut pangan Indonesia per tahun, rata-rata 2000&ndash;2019</div>
                <div class="stat-src">Sumber: Bappenas, Kajian Food Loss and Waste Indonesia (2021)</div>
            </div>
            <div class="stat-card">
                <div class="stat-num grad-text">115<span class="stat-unit">&ndash;184 kg</span></div>
                <div class="stat-label">Sisa &amp; susut pangan per kapita, per tahun</div>
                <div class="stat-src">Sumber: Bappenas, Kajian Food Loss and Waste Indonesia (2021)</div>
            </div>
            <div class="stat-card">
                <div class="stat-num grad-text">Rp213<span class="stat-unit">&ndash;551 T</span></div>
                <div class="stat-label">Kerugian ekonomi per tahun &mdash; setara 4&ndash;5% PDB Indonesia</div>
                <div class="stat-src">Sumber: Bappenas, Kajian Food Loss and Waste Indonesia (2021)</div>
            </div>
            <div class="stat-card">
                <div class="stat-num grad-text">&frac12; populasi</div>
                <div class="stat-label">Kebutuhan konsumsi yang bisa terpenuhi dari pangan yang terbuang</div>
                <div class="stat-src">Sumber: Bappenas, dikutip Katadata (Okt 2024)</div>
            </div>
        </div>

        <div class="climate-panel">
            <div class="climate-panel-main">
                <span class="eyebrow">Fokus bumi</span>
                <div class="climate-big grad-text">7,29%</div>
                <p>
                    Itulah rata-rata porsi tahunan sisa &amp; susut pangan terhadap total emisi gas rumah kaca Indonesia
                    &mdash; setara <strong style="color:var(--ink)">1.702,9 juta ton CO2e</strong> sepanjang 2000&ndash;2019.
                    Saat membusuk tanpa oksigen di tempat pembuangan, sisa makanan melepaskan metana &mdash; gas rumah
                    kaca yang jauh lebih kuat menahan panas dibanding CO2.
                </p>
                <p class="stat-src" style="margin-top:18px">Sumber: Bappenas, Kajian Food Loss and Waste Indonesia (2021)</p>
            </div>
            <div class="climate-panel-side">
                <h4>Konteks target iklim nasional</h4>
                <div class="ndc-bar-row">
                    <div class="ndc-bar-label"><span>Target penurunan emisi nasional (NDC), 2030</span><span class="mono">29&ndash;41%</span></div>
                    <div class="ndc-bar-track"><div class="ndc-bar-fill" data-fill="41%"></div></div>
                </div>
                <div class="ndc-bar-row">
                    <div class="ndc-bar-label"><span>Porsi emisi dari sisa &amp; susut pangan</span><span class="mono">7,29%</span></div>
                    <div class="ndc-bar-track"><div class="ndc-bar-fill" data-fill="18%"></div></div>
                </div>
                <p style="font-size:.82rem;color:var(--ink-faint);margin:18px 0 0">
                    Berbeda dari sektor kehutanan atau energi, jalur ini bisa mulai ditekan langsung dari piring
                    makan &mdash; tanpa menunggu proyek infrastruktur besar.
                </p>
            </div>
        </div>

        <div class="composition-block">
            <h4>Komposisi sampah nasional, 2025</h4>
            <p>Dari 25,14 juta ton timbulan sampah yang dilaporkan 244 kabupaten/kota ke SIPSN &mdash; sisa makanan tetap komponen terbesar.</p>

            <div class="comp-row is-food">
                <span class="comp-name">Sisa makanan</span>
                <div class="comp-track"><div class="comp-fill" data-fill="40.76%"></div></div>
                <span class="comp-value">40,76%</span>
            </div>
            <div class="comp-row">
                <span class="comp-name">Plastik</span>
                <div class="comp-track"><div class="comp-fill" data-fill="20.49%"></div></div>
                <span class="comp-value">20,49%</span>
            </div>
            <div class="comp-row">
                <span class="comp-name">Kayu &amp; ranting</span>
                <div class="comp-track"><div class="comp-fill" data-fill="13.29%"></div></div>
                <span class="comp-value">13,29%</span>
            </div>
            <div class="comp-row">
                <span class="comp-name">Jenis lainnya</span>
                <div class="comp-track"><div class="comp-fill" data-fill="25.46%"></div></div>
                <span class="comp-value">25,46%</span>
            </div>

            <p class="composition-src">
                Sumber: Sistem Informasi Pengelolaan Sampah Nasional (SIPSN), KLHK (2025). Sebagai pembanding global:
                menurut UNEP Food Waste Index Report 2024, Indonesia berada di peringkat ke-8 dunia dengan 14,73 juta
                ton sampah makanan/tahun, atau 2,33% dari total global.
            </p>
        </div>
    </div>
</section>

<!-- ============ PETA JALAN: 6 PILAR AKSI ============ -->
<section class="g-section" id="roadmap">
    <div class="wrap">
        <div class="g-section-head">
            <span class="eyebrow">Peta jalan</span>
            <h2>Enam pilar, dari meja rapat kebijakan sampai meja makan</h2>
            <p>Setiap pilar butuh pelaku yang berbeda &mdash; tapi mengarah ke satu tujuan yang sama.</p>
        </div>
        <p class="pillar-note">
            Lima pilar pertama diadaptasi dari 5 Arah Kebijakan Strategis dalam Peta Jalan Pengelolaan Susut &amp;
            Sisa Pangan, Bappenas (2021). Pilar keenam adalah lapisan aksi personal &amp; digital &mdash; tempat
            SisaRasa berperan, bukan bagian resmi dari peta jalan pemerintah.
        </p>

        <div class="pillar-list">
            @php
                $pillars = [
                    [
                        'title' => 'Perubahan Perilaku',
                        'tag' => 'Individu & Komunitas',
                        'body' => 'Mengubah kebiasaan belanja, menyimpan, dan mengonsumsi makanan lewat edukasi dan kampanye publik — karena sebagian besar sisa makanan Indonesia justru berasal dari rumah tangga, bukan industri.',
                        'src' => 'Bappenas, Kajian Food Loss and Waste Indonesia (2021)',
                    ],
                    [
                        'title' => 'Penguatan Sistem Pendukung Rantai Pangan',
                        'tag' => 'Rantai Pasok',
                        'body' => 'Memperbaiki rantai dingin, logistik, dan penyimpanan pascapanen agar pangan tidak rusak sebelum sempat dikonsumsi — titik rawan food loss terbesar di sektor pertanian dan distribusi.',
                        'src' => 'Bappenas, Kajian Food Loss and Waste Indonesia (2021)',
                    ],
                    [
                        'title' => 'Penguatan Regulasi & Optimalisasi Pendanaan',
                        'tag' => 'Kebijakan',
                        'body' => 'Regulasi soal label tanggal kedaluwarsa, insentif untuk donasi pangan, dan pendanaan program pengurangan sisa makanan di tingkat nasional maupun daerah.',
                        'src' => 'Bappenas, Kajian Food Loss and Waste Indonesia (2021)',
                    ],
                    [
                        'title' => 'Pemanfaatan Sisa Pangan',
                        'tag' => 'Ekonomi Sirkular',
                        'body' => 'Mengubah sisa yang tak lagi bisa dikonsumsi menjadi kompos, pakan ternak, atau biogas — memutus rantai sisa makanan dari tempat pembuangan akhir.',
                        'src' => 'Bappenas, Kajian Food Loss and Waste Indonesia (2021)',
                    ],
                    [
                        'title' => 'Pengembangan Riset & Data',
                        'tag' => 'Riset',
                        'body' => 'Memperluas cakupan pemantauan (seperti SIPSN) dan riset lanjutan, supaya kebijakan ke depan makin presisi mengukur skala dan sumber sisa makanan Indonesia.',
                        'src' => 'Bappenas, Kajian Food Loss and Waste Indonesia (2021)',
                    ],
                    [
                        'title' => 'Aksi Personal & Digital',
                        'tag' => 'SisaRasa',
                        'body' => 'Sisa Checker mengubah "perubahan perilaku" jadi langkah konkret di dapur; klaim surplus di marketplace mitra mengoperasikan "pemanfaatan sisa pangan" di level individu; Dashboard Dampak membuat kg yang diselamatkan bisa diukur — bukti kecil dari besarnya potensi aksi personal.',
                        'src' => 'Lapisan tambahan SisaRasa, bukan bagian resmi Peta Jalan Bappenas',
                    ],
                ];
            @endphp

            @foreach ($pillars as $i => $pillar)
                <div class="pillar">
                    <button class="pillar-trigger" aria-expanded="false">
                        <span class="pillar-num mono">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="pillar-title">{{ $pillar['title'] }}</span>
                        <span class="pillar-tag">{{ $pillar['tag'] }}</span>
                        <span class="pillar-plus" aria-hidden="true"></span>
                    </button>
                    <div class="pillar-panel">
                        <div class="pillar-panel-inner">
                            <div class="pillar-panel-body">
                                <p>{{ $pillar['body'] }}</p>
                                <p class="pillar-src">Sumber: {{ $pillar['src'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ TIMELINE SEJARAH KEBIJAKAN ============ -->
<section class="g-section" id="timeline">
    <div class="wrap">
        <div class="g-section-head">
            <span class="eyebrow">Jejak kebijakan</span>
            <h2>Dari undang-undang sampah sampai target 2045</h2>
            <p>Kebijakan soal sampah dan pangan Indonesia bergerak pelan tapi terus mengarah ke satu titik: sisa
                makanan sebagai isu iklim, bukan cuma isu kebersihan.</p>
        </div>

        @php
            $timeline = [
                ['year' => '2008', 'color' => '#86C976', 'title' => 'UU No. 18/2008 tentang Pengelolaan Sampah', 'summary' => 'Paradigma baru: sampah dipandang sebagai sumber daya bernilai ekonomi, bukan sekadar sesuatu yang dibuang.', 'detail' => 'Undang-undang ini menjadi dasar hukum pertama pengelolaan sampah nasional dan membuka jalan bagi kebijakan turunan seperti Jakstranas.', 'src' => 'UU No. 18 Tahun 2008 tentang Pengelolaan Sampah'],
                ['year' => '2016', 'color' => '#9ECB6E', 'title' => 'Indonesia Ratifikasi Perjanjian Paris', 'summary' => 'Lewat UU No. 16/2016, Indonesia mengikat diri pada komitmen iklim global.', 'detail' => 'Titik ini yang kelak menghubungkan isu sampah domestik dengan target penurunan emisi gas rumah kaca nasional (NDC).', 'src' => 'UU No. 16 Tahun 2016; KLHK'],
                ['year' => '2017', 'color' => '#B6CC66', 'title' => 'Jakstranas — Perpres No. 97/2017', 'summary' => 'Target nasional: kurangi sampah 30% dan tangani 70% sisanya secara layak pada 2025.', 'detail' => 'Kebijakan dan Strategi Nasional Pengelolaan Sampah Rumah Tangga ini menjadi langkah lanjutan dari UU No. 18/2008.', 'src' => 'Perpres No. 97 Tahun 2017'],
                ['year' => '2021', 'color' => '#CDC65E', 'title' => 'Bappenas Terbitkan Kajian Food Loss and Waste Indonesia', 'summary' => 'Studi komprehensif pertama yang mengukur skala sisa & susut pangan nasional — termasuk hubungannya dengan emisi karbon.', 'detail' => 'Sebagian besar angka di halaman ini bersumber dari kajian ini: 23–48 juta ton FLW/tahun, kerugian Rp213–551 triliun, dan 1.702,9 juta ton CO2e emisi selama 2000–2019.', 'src' => 'Bappenas, Kajian Food Loss and Waste Indonesia (2021)'],
                ['year' => '2022', 'color' => '#DBC751', 'title' => 'Badan Pangan Nasional Mulai Gerakan Selamatkan Pangan', 'summary' => 'Pilot program di Jabodetabekjur, menghubungkan bank pangan dan armada logistik dengan surplus pangan.', 'detail' => 'Program ini menjadi cikal bakal jaringan penyelamatan pangan yang terus diperluas pada tahun-tahun berikutnya.', 'src' => 'Badan Pangan Nasional (NFA)'],
                ['year' => '2023', 'color' => '#E8AC49', 'title' => 'Gerakan Meluas ke 12 Provinsi', 'summary' => 'Lewat dana dekonsentrasi, cakupan program meluas ke wilayah urban dengan komunitas bank pangan aktif.', 'detail' => 'Di tahun yang sama, timbulan sampah nasional tercatat 26,20 juta ton menurut SIPSN.', 'src' => 'Badan Pangan Nasional; SIPSN, KLHK'],
                ['year' => '2024', 'color' => '#F49640', 'title' => 'Gerakan Meluas ke 15 Provinsi', 'summary' => 'Sisa makanan tercatat 38,94% dari 27,28 juta ton timbulan sampah nasional — komponen terbesar dalam komposisi sampah Indonesia.', 'detail' => 'Perluasan program menegaskan bahwa penyelamatan pangan sudah jadi agenda lintas daerah, bukan proyek percontohan semata.', 'src' => 'Badan Pangan Nasional; SIPSN, KLHK'],
                ['year' => '2025', 'color' => '#F4903F', 'title' => 'Sisa Makanan Naik ke 40,76% Komposisi Sampah Nasional', 'summary' => 'Dari 244 kabupaten/kota yang melapor ke SIPSN, sisa makanan makin mendominasi timbulan sampah nasional (25,14 juta ton).', 'detail' => 'Di tahun yang sama, Bappenas meluncurkan Peta Jalan Ekonomi Sirkular 2025–2045 yang turut mencakup agenda pengurangan sisa pangan.', 'src' => 'SIPSN, KLHK (2025); Bappenas'],
                ['year' => '2045', 'color' => '#D9701F', 'title' => 'Target: FLW Turun ke 166 kg/Kapita/Tahun', 'summary' => 'Tanpa intervensi, proyeksi 2045 mencapai 344 kg/kapita/tahun. Dengan Peta Jalan yang berjalan, target ditekan hingga 166 kg/kapita/tahun.', 'detail' => 'Penurunan sekitar 55,88% ini dirancang untuk mendukung visi ketahanan pangan Indonesia Emas 2045.', 'src' => 'Bappenas, Peta Jalan Pengelolaan Susut & Sisa Pangan'],
            ];
        @endphp

        <div class="timeline">
            @foreach ($timeline as $item)
                <div class="tl-item">
                    <span class="tl-dot" style="--dot-color: {{ $item['color'] }}"></span>
                    <div class="tl-year mono" style="--dot-color: {{ $item['color'] }}">{{ $item['year'] }}</div>
                    <h3 class="tl-title">{{ $item['title'] }}</h3>
                    <p class="tl-summary">{{ $item['summary'] }}</p>
                    <button class="tl-toggle">Lihat detail &amp; sumber</button>
                    <div class="tl-detail">
                        <div class="tl-detail-inner">
                            <div class="tl-detail-body">
                                <p>{{ $item['detail'] }}</p>
                                <span class="tl-src">Sumber: {{ $item['src'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ CERITA KOMUNITAS ============ -->
<section class="g-section" id="cerita">
    <div class="wrap">
        <div class="g-section-head">
            <span class="eyebrow">Cerita komunitas</span>
            <h2>Aksi kecil, dari tiga sudut dapur yang berbeda</h2>
            <p>Tiga pola pemakaian yang paling umum ditemui pada aplikasi seperti SisaRasa.</p>
        </div>
        <p class="story-note">Skenario ilustratif berdasarkan pola penggunaan yang umum &mdash; bukan kutipan pengguna terverifikasi.</p>

        <div class="story-grid">
            <div class="story-card">
                <div class="story-avatar">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--decay)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 13c0-5 4-9 14-9 0 10-4 14-9 14-3 0-5-2-5-5Z" />
                        <path d="M6 18 17 7" />
                    </svg>
                </div>
                <p class="story-quote">"Dulu isi kulkas saya banyak yang berakhir di tempat sampah. Sekarang sebelum belanja, saya cek dulu sisa yang ada lewat Sisa Checker."</p>
                <div class="story-who">Ibu rumah tangga &mdash; <strong>Jakarta Selatan</strong></div>
                <div class="story-stat">&asymp; 4,2 kg sisa terselamatkan / bulan (ilustrasi)</div>
            </div>
            <div class="story-card">
                <div class="story-avatar">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--rescued)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 11h16v3a5 5 0 0 1-5 5h-6a5 5 0 0 1-5-5v-3Z" />
                        <path d="M2 11h20" />
                        <path d="M9 11V8M15 11V8" />
                    </svg>
                </div>
                <p class="story-quote">"Warung kami sering punya sisa sayur di penghujung hari. Sekarang sisa itu bisa diklaim tetangga sekitar lewat marketplace mitra, bukan langsung dibuang."</p>
                <div class="story-who">Pemilik warung &mdash; <strong>Bandung</strong></div>
                <div class="story-stat">&asymp; 15 porsi surplus terselamatkan / minggu (ilustrasi)</div>
            </div>
            <div class="story-card">
                <div class="story-avatar">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--decay-deep)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9 6 4h12l3 5" />
                        <path d="M3 9v9a1 1 0 0 0 1 1h4v-6h8v6h4a1 1 0 0 0 1-1V9" />
                        <path d="M3 9h18" />
                    </svg>
                </div>
                <p class="story-quote">"Sayur yang enggak laku di sore hari biasanya cuma jadi kompos. Lewat SisaRasa, ada yang datang klaim sebelum busuk."</p>
                <div class="story-who">Pedagang pasar tradisional &mdash; <strong>Yogyakarta</strong></div>
                <div class="story-stat">&asymp; 8 kg hasil dagangan terselamatkan / hari pasar (ilustrasi)</div>
            </div>
        </div>
    </div>
</section>

<!-- ============ TANYA AI ============ -->
<section class="g-section" id="tanya-ai">
    <div class="wrap">
        <div class="g-section-head">
            <span class="eyebrow">Tanya cepat</span>
            <h2>Masih ada pertanyaan? Mulai dari sini.</h2>
            <p>Kumpulan jawaban singkat seputar sisa makanan dan krisis iklim &mdash; ketik pertanyaanmu atau pilih salah satu topik.</p>
        </div>

        <div class="ai-widget">
            <div class="ai-widget-head">
                <span class="ai-dot"></span>
                <div>
                    <strong>Asisten Sisa &amp; Iklim</strong>
                    <span>Jawaban terkurasi, bukan model AI generatif terbuka</span>
                </div>
            </div>
            <div class="ai-body" id="aiBody">
                <div class="ai-msg">
                    <div class="ai-msg-avatar">🌱</div>
                    <div class="ai-msg-bubble">Halo! Pilih salah satu topik di bawah, atau ketik pertanyaanmu sendiri.</div>
                </div>
            </div>
            <div class="ai-chips">
                <button type="button" class="ai-chip">Kenapa sisa makanan bisa berdampak ke krisis iklim?</button>
                <button type="button" class="ai-chip">Apa yang bisa aku lakukan mulai hari ini?</button>
                <button type="button" class="ai-chip">Apa itu Gerakan Selamatkan Pangan?</button>
                <button type="button" class="ai-chip">Apa target Indonesia soal sisa makanan di 2045?</button>
            </div>
            <form class="ai-form" id="aiForm" data-checker-url="{{ route('sisa-checker.create') }}">
                <input type="text" id="aiInput" placeholder="Ketik pertanyaanmu..." autocomplete="off">
                <button type="submit">Kirim</button>
            </form>
        </div>
    </div>
</section>

<!-- ============ CTA PENUTUP ============ -->
<section class="g-section" id="cta" style="border-top:none">
    <div class="wrap">
        <div class="cta-final">
            <span class="eyebrow" style="justify-content:center">Aksi kecil, dampak bumi</span>
            <h2>Sisa hari ini di dapurmu, <span class="italic-accent grad-text">bagian dari angka besar esok.</span></h2>
            <p>Tidak perlu menunggu kebijakan sempurna. Setiap kg yang kamu selamatkan tercatat, dan terhubung ke gambaran yang jauh lebih besar.</p>
            <div>
                @guest
                    <a href="{{ route('register') }}" class="g-btn g-btn-primary">Mulai Sekarang</a>
                    <a href="{{ route('sisa-checker.create') }}" class="g-btn g-btn-ghost">Coba Sisa Checker</a>
                @else
                    <a href="{{ route('sisa-checker.create') }}" class="g-btn g-btn-primary">Mulai selamatkan sisa</a>
                    <a href="{{ route('dashboard') }}" class="g-btn g-btn-ghost">Lihat Dashboard Dampak</a>
                @endguest
            </div>
        </div>
    </div>
</section>

<footer class="g-footer">
    <div class="wrap">
        <span class="g-footer-note">© {{ now()->year }} SisaRasa — aksi kecil, dampak bumi.</span>
        <ul class="g-footer-links">
            <li><a href="/">Beranda</a></li>
            <li><a href="#data">Data</a></li>
            <li><a href="#roadmap">Peta Jalan</a></li>
            <li><a href="#timeline">Kebijakan</a></li>
        </ul>
    </div>
</footer>

</body>
</html>
