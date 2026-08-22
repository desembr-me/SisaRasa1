<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ config('app.name', 'SisaRasa') }} — Dari Sisa, Jadi Berkah</title>
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
@vite(['resources/css/landing.css', 'resources/js/landing.js'])
</head>
<body>

<header id="site-header">
  <nav>
    <a href="#top" class="logo">
      <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
        <circle cx="15" cy="15" r="13.5" stroke="currentColor" stroke-width="1.4" stroke-dasharray="2.5 3.2"/>
        <path d="M10 16.5C10 13 12.5 10 15.5 9.5C15.5 12.5 13.5 14.5 10 16.5Z" fill="#3F6B3D"/>
        <path d="M20 16.5C20 13 17.5 10 14.5 9.5C14.5 12.5 16.5 14.5 20 16.5Z" fill="#F4903F"/>
      </svg>
      SisaRasa
    </a>
    <ul class="nav-links" id="navLinks">
      <li><a href="#fitur">Fitur</a></li>
      <li><a href="#cara-kerja">Cara Kerja</a></li>
      <li><a href="#dampak">Dampak</a></li>
      @guest
        <li><a href="{{ route('login') }}">Masuk</a></li>
        <li><a href="{{ route('register') }}" class="nav-cta">Mulai Sekarang</a></li>
      @else
        <li><a href="{{ route('dashboard') }}" class="nav-cta">Dashboard</a></li>
      @endguest
    </ul>
    <button class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </nav>
</header>

<main>

  <!-- ================= HERO ================= -->
  <section class="hero-photo" id="top">
    <div class="hero-photo-bg" aria-hidden="true">
      <img src="{{ asset('images/hero-bg.jpg') }}" alt="">
    </div>
    <div class="wrap hero-photo-content">
      <h1>Dari Sisa,<br><em>Jadi Berkah.</em></h1>
      <p class="lead">SisaRasa bantu kamu memasak dari bahan yang masih tersisa, menemukan makanan surplus di sekitar sebelum kedaluwarsa, dan melihat dampak nyata dari setiap porsi yang tidak berakhir jadi sampah.</p>

      <div class="hero-photo-ctas">
        <a href="{{ auth()->check() ? route('sisa-checker.create') : route('register') }}" class="btn btn-photo">Coba Sisa Checker →</a>
      </div>

      <form class="hero-ask" action="{{ auth()->check() ? route('sisa-checker.create') : route('register') }}" method="GET">
        <input type="text" name="bahan" placeholder="Bahan apa yang tersisa di kulkasmu?" aria-label="Bahan yang tersisa di kulkas">
        <button type="submit" aria-label="Cari resep">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 19V5M12 5L5 12M12 5l7 7" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </form>
      <p class="hero-ask-tag">Ketik bahan, temukan resepnya.</p>

      <div class="hero-stats">
        <span class="stat"><b>23–48 jt ton</b> makanan terbuang / tahun</span>
        <span class="stat">cukup beri makan <b>61–125 jt</b> orang</span>
        <span class="stat"><b>Rp213–551 T</b> kerugian ekonomi / tahun</span>
      </div>
    </div>
  </section>

  <!-- ================= MASALAH ================= -->
  <section class="problem perf-bottom" id="masalah" style="--section-bg:var(--paper)">
    <div class="wrap">
      <div class="section-head reveal">
        <span class="eyebrow">Bukan kita nggak peduli</span>
        <h2>Kita cuma nggak pernah lihat struknya.</h2>
        <p>Kalau makanan yang terbuang di Indonesia dikonversi jadi nota belanja tahunan, begini kira-kira bunyinya.</p>
      </div>

      <div class="problem-layout">
        <div class="receipt reveal perf-top perf-bottom">
          <div class="receipt-stars">{{ str_repeat('* ', 30) }}</div>
          <h3>Struk Kerugian Nasional</h3>
          <div class="sub">— makanan sisa, per tahun —</div>
          <div class="receipt-stars">{{ str_repeat('* ', 30) }}</div>

          <div class="receipt-meta">
            <span>SISARASA.ID</span>
            <span>{{ now()->format('d-m-Y') }}</span>
          </div>
          <div class="receipt-divider"></div>

          <div class="receipt-line">
            <span class="label">Porsi sampah nasional</span>
            <span class="leader"></span>
            <span class="value">~40%</span>
          </div>
          <div class="receipt-line">
            <span class="label">Total terbuang</span>
            <span class="leader"></span>
            <span class="value">23–48 jt ton</span>
          </div>
          <div class="receipt-line">
            <span class="label">Setara kebutuhan gizi</span>
            <span class="leader"></span>
            <span class="value">61–125 jt org</span>
          </div>
          <div class="receipt-line">
            <span class="label">Kerugian ekonomi</span>
            <span class="leader"></span>
            <span class="value">Rp213–551 T</span>
          </div>
          <div class="receipt-line">
            <span class="label">Kontribusi emisi GRK</span>
            <span class="leader"></span>
            <span class="value">7,29%</span>
          </div>
          <div class="receipt-line">
            <span class="label">Proyeksi 2045 (tanpa aksi)</span>
            <span class="leader"></span>
            <span class="value">112 jt ton</span>
          </div>

          <div class="receipt-divider"></div>
          <div class="receipt-stars">{{ str_repeat('* ', 30) }}</div>
          <div class="receipt-thanks">Terima kasih sudah peduli</div>
          <div class="receipt-stars">{{ str_repeat('* ', 30) }}</div>

          <div class="receipt-barcode" aria-hidden="true">
            <svg viewBox="0 0 180 42" preserveAspectRatio="none">
              <rect x="6" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="10" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="13" y="4" width="3" height="34" fill="#23281E"/>
              <rect x="18" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="21" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="25" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="28" y="4" width="4" height="34" fill="#23281E"/>
              <rect x="34" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="37" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="41" y="4" width="3" height="34" fill="#23281E"/>
              <rect x="46" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="49" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="53" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="56" y="4" width="3" height="34" fill="#23281E"/>
              <rect x="61" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="65" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="68" y="4" width="4" height="34" fill="#23281E"/>
              <rect x="74" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="77" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="81" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="84" y="4" width="3" height="34" fill="#23281E"/>
              <rect x="89" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="92" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="96" y="4" width="4" height="34" fill="#23281E"/>
              <rect x="102" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="105" y="4" width="3" height="34" fill="#23281E"/>
              <rect x="110" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="114" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="117" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="120" y="4" width="3" height="34" fill="#23281E"/>
              <rect x="125" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="129" y="4" width="4" height="34" fill="#23281E"/>
              <rect x="135" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="138" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="142" y="4" width="3" height="34" fill="#23281E"/>
              <rect x="147" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="150" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="154" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="157" y="4" width="4" height="34" fill="#23281E"/>
              <rect x="163" y="4" width="2" height="34" fill="#23281E"/>
              <rect x="167" y="4" width="1" height="34" fill="#23281E"/>
              <rect x="170" y="4" width="3" height="34" fill="#23281E"/>
            </svg>
          </div>

          <div class="foot-note">sumber: Kajian Food Loss &amp; Waste — Bappenas, Waste4Change &amp; WRI (2021); KLHK/SIPSN 2023–2025</div>
        </div>

        <div class="problem-notes">
          <div class="note-card reveal">
            <div class="note-photo-wrap">
              <div class="tape"></div>
              <div class="note-photo-flip">
                <div class="note-photo-face note-photo-front">
                  <img class="note-photo" src="{{ asset('images/note-rumah.jpg') }}" alt="Dapur rumah tangga dengan bahan makanan menumpuk di meja" loading="lazy" width="172" height="172">
                </div>
                <div class="note-photo-face note-photo-back">
                  <span class="back-label">Sisa Checker</span>
                  <p>Ketik bahan yang tersisa, temukan resep sebelum keburu basi.</p>
                </div>
              </div>
            </div>
            <div>
              <span class="tag">Di rumah</span>
              <p>Bahan sisa di kulkas sering berakhir busuk karena tidak ada ide mau diolah jadi apa sebelum keburu basi.</p>
            </div>
          </div>
          <div class="note-card reveal">
            <div class="note-photo-wrap">
              <div class="tape"></div>
              <div class="note-photo-flip">
                <div class="note-photo-face note-photo-front">
                  <img class="note-photo" src="{{ asset('images/note-resto.jpg') }}" alt="Pedagang menyiapkan makanan di warung" loading="lazy" width="172" height="172">
                </div>
                <div class="note-photo-face note-photo-back">
                  <span class="back-label">Untuk mitra</span>
                  <p>Resto &amp; toko bisa daftar dan bagikan surplus lewat SisaRasa.</p>
                </div>
              </div>
            </div>
            <div>
              <span class="tag">Di resto &amp; toko</span>
              <p>Makanan yang masih layak dibuang begitu saja mendekati jam tutup karena tidak ada saluran cepat untuk menyalurkannya.</p>
            </div>
          </div>
          <div class="note-card reveal">
            <div class="note-photo-wrap">
              <div class="tape"></div>
              <div class="note-photo-flip">
                <div class="note-photo-face note-photo-front">
                  <img class="note-photo" src="{{ asset('images/note-kepala.jpg') }}" alt="Piring sisa makan yang belum dihabiskan" loading="lazy" width="172" height="172">
                </div>
                <div class="note-photo-face note-photo-back">
                  <span class="back-label">Dashboard Dampak</span>
                  <p>Catat tiap aksi biar kebiasaan borosmu kelihatan jelas.</p>
                </div>
              </div>
            </div>
            <div>
              <span class="tag">Di kepala kita</span>
              <p>Kebiasaan boros makanan terus berulang karena dampaknya tidak pernah benar-benar terlihat atau terukur.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= GALERI ================= -->
  <section class="gallery perf-bottom" style="--section-bg:var(--paper-warm)">
    <div class="wrap">
      <div class="section-head reveal">
        <span class="eyebrow">Bukan animasi, ini nyata</span>
        <h2>Dari pasar tradisional sampai kulkas kita sendiri.</h2>
        <p>Tempat yang sama dengan yang kamu datangi tiap minggu — di situlah cerita sisa makanan ini sebenarnya bermula.</p>
      </div>
    </div>
    <div class="gallery-pile">
      <div class="gallery-pile-sticky">
        <div class="gallery-photo">
          <div class="tape"></div>
          <div class="photo-frame">
            <img src="{{ asset('images/galeri-pasar-1.jpg') }}" alt="Pasar tradisional dengan pedagang sayur dan cabai" loading="lazy" width="900" height="600">
          </div>
          <span class="cap"><span class="cap-num">01</span>Pasar Tradisional</span>
        </div>
        <div class="gallery-photo">
          <div class="tape"></div>
          <div class="photo-frame">
            <img src="{{ asset('images/galeri-pasar-2.jpg') }}" alt="Lorong pasar basah dengan buah-buahan segar" loading="lazy" width="900" height="600">
          </div>
          <span class="cap"><span class="cap-num">02</span>Pasar Basah</span>
        </div>
        <div class="gallery-photo">
          <div class="tape"></div>
          <div class="photo-frame">
            <img src="{{ asset('images/galeri-dapur.jpg') }}" alt="Sayur dan buah segar tersusun di rak kulkas" loading="lazy" width="900" height="600">
          </div>
          <span class="cap"><span class="cap-num">03</span>Isi Kulkas</span>
        </div>
        <div class="gallery-photo">
          <div class="tape"></div>
          <div class="photo-frame">
            <img src="{{ asset('images/galeri-bahan.jpg') }}" alt="Tumpukan bahan makanan segar" loading="lazy" width="900" height="675">
          </div>
          <span class="cap"><span class="cap-num">04</span>Bahan Segar</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= FITUR ================= -->
  <section class="features perf-bottom" id="fitur" style="--section-bg:var(--paper-warm)">
    <div class="wrap">
      <div class="section-head reveal">
        <span class="eyebrow">Tiga alat, satu tujuan</span>
        <h2>Yang bisa kamu lakukan di SisaRasa</h2>
        <p>Dari kulkas pribadi sampai dampak yang terlihat di layar — semua terhubung dalam satu alur sederhana.</p>
      </div>

      <div class="feature-grid">
        <div class="feature-card reveal">
          <div class="tape"></div>
          <div class="feature-icon">
            <svg viewBox="0 0 100 100" fill="none">
              <rect x="24" y="10" width="46" height="70" rx="8" fill="#FBFAF3" stroke="#23281E" stroke-width="2"/>
              <line x1="24" y1="34" x2="70" y2="34" stroke="#23281E" stroke-width="1.6"/>
              <rect x="31" y="17" width="4" height="10" rx="2" fill="#23281E"/>
              <rect x="31" y="41" width="4" height="10" rx="2" fill="#23281E"/>
              <circle cx="46" cy="48" r="5" fill="#F4903F"/>
              <circle cx="58" cy="52" r="5" fill="#3F6B3D"/>
              <circle cx="48" cy="62" r="5" fill="#E24A3A"/>
              <g class="icon-magnifier">
                <circle cx="72" cy="72" r="14" fill="#FBFAF3" stroke="#23281E" stroke-width="2.4"/>
                <line x1="82" y1="82" x2="90" y2="90" stroke="#23281E" stroke-width="3" stroke-linecap="round"/>
              </g>
            </svg>
          </div>
          <h3>Sisa Checker</h3>
          <p class="desc">Ketik bahan yang masih tersisa di kulkas, dan sistem carikan resep yang cocok dari koleksi resep sisa dapur yang benar-benar bisa kamu masak hari ini.</p>
          <span class="feature-pill">Pencocokan Resep</span>
        </div>

        <div class="feature-card reveal">
          <div class="tape"></div>
          <div class="feature-icon">
            <svg viewBox="0 0 100 100" fill="none">
              <circle class="icon-radar" cx="50" cy="55" r="40" fill="none" stroke="#C7BF9C" stroke-width="1.4" stroke-dasharray="3 4"/>
              <g class="icon-pin">
                <path d="M50 20C36 20 26 30 26 44C26 62 50 86 50 86C50 86 74 62 74 44C74 30 64 20 50 20Z" fill="#F4903F" stroke="#23281E" stroke-width="2" stroke-linejoin="round"/>
                <rect x="40" y="36" width="20" height="16" rx="2" fill="#FBFAF3" stroke="#23281E" stroke-width="1.6"/>
                <path d="M44 36 L44 32 Q44 28 50 28 Q56 28 56 32 L56 36" stroke="#23281E" stroke-width="1.6" fill="none"/>
              </g>
            </svg>
          </div>
          <h3>Peta Surplus</h3>
          <p class="desc">Temukan resto, toko, dan supermarket sekitar dengan makanan surplus mendekati jam tutup — klaim gratis atau diskon besar, real-time.</p>
          <span class="feature-pill">Live Map</span>
        </div>

        <div class="feature-card reveal">
          <div class="tape"></div>
          <div class="feature-icon">
            <svg viewBox="0 0 100 100" fill="none">
              <line x1="18" y1="82" x2="86" y2="82" stroke="#23281E" stroke-width="2" stroke-linecap="round"/>
              <rect class="icon-bar icon-bar-1" x="26" y="58" width="14" height="24" rx="3" fill="#DCE6D0" stroke="#3F6B3D" stroke-width="1.6"/>
              <rect class="icon-bar icon-bar-2" x="48" y="42" width="14" height="40" rx="3" fill="#F4903F" stroke="#23281E" stroke-width="1.6" opacity="0.85"/>
              <rect class="icon-bar icon-bar-3" x="70" y="26" width="14" height="56" rx="3" fill="#3F6B3D" stroke="#23281E" stroke-width="1.6"/>
              <path d="M77 26C77 26 68 22 70 14C78 14 82 22 77 26Z" fill="#DCE6D0" stroke="#3F6B3D" stroke-width="1.4" stroke-linejoin="round"/>
            </svg>
          </div>
          <h3>Dashboard Dampak</h3>
          <p class="desc">Setiap porsi yang kamu selamatkan dihitung otomatis: kg makanan, emisi karbon dicegah, dan uang yang hemat. Bandingkan dengan RT atau kantor lain.</p>
          <span class="feature-pill">Leaderboard</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= CARA KERJA ================= -->
  <section class="how" id="cara-kerja" style="--section-bg:var(--paper)">
    <div class="wrap">
      <div class="section-head reveal">
        <span class="eyebrow">Tiga langkah</span>
        <h2>Cara kerjanya</h2>
      </div>
      <div class="how-steps">
        <svg class="how-arrow how-arrow-1" viewBox="0 0 64 36" fill="none" aria-hidden="true">
          <path d="M3 12 Q 32 -6 55 16" stroke-width="1.6" stroke-linecap="round" stroke-dasharray="3 5"/>
          <path d="M47 9 L57 16 L46 21" stroke-width="1.6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <svg class="how-arrow how-arrow-2" viewBox="0 0 64 36" fill="none" aria-hidden="true">
          <path d="M3 16 Q 32 -6 55 12" stroke-width="1.6" stroke-linecap="round" stroke-dasharray="3 5"/>
          <path d="M45 6 L57 12 L48 20" stroke-width="1.6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="step reveal">
          <div class="step-clip"></div>
          <div class="step-num">01</div>
          <h3>Catat bahan sisa</h3>
          <p>Buka Sisa Checker, lalu ketik bahan apa saja yang tersisa di kulkas.</p>
        </div>
        <div class="step reveal">
          <div class="step-clip"></div>
          <div class="step-num">02</div>
          <h3>Dapat resep atau surplus terdekat</h3>
          <p>Sistem carikan resep yang cocok, atau kamu buka Peta Surplus untuk lihat makanan yang bisa diklaim di sekitarmu.</p>
        </div>
        <div class="step reveal">
          <div class="step-clip"></div>
          <div class="step-num">03</div>
          <h3>Masak, klaim, lihat dampaknya</h3>
          <p>Setiap aksi otomatis masuk ke Dashboard Dampak — progresmu bertambah, sampah berkurang.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= MODEL DAMPAK ================= -->
  <section class="impact" id="dampak" style="--section-bg:var(--paper-warm)">
    <div class="wrap">
      <div class="impact-box reveal">
        <div>
          <span class="eyebrow" style="color:#B7DDAE">Model dampak</span>
          <h2>Coba hitung sendiri potensinya.</h2>
          <p>Geser jumlah rumah tangga yang pakai SisaRasa seminggu sekali, dan lihat estimasi dampaknya secara nasional.</p>
          <div class="impact-slider">
            <label for="households">Jumlah rumah tangga aktif</label>
            <input type="range" id="households" min="1000" max="500000" step="1000" value="50000">
            <div class="val" id="householdsVal">50.000 rumah tangga</div>
          </div>
        </div>
        <div class="impact-results">
          <div class="impact-result">
            <span class="label">Makanan terselamatkan / minggu</span>
            <span class="num" id="resKg">—</span>
          </div>
          <div class="impact-result">
            <span class="label">Emisi karbon dicegah / minggu</span>
            <span class="num" id="resCo2">—</span>
          </div>
          <div class="impact-result">
            <span class="label">Nilai ekonomi terselamatkan / minggu</span>
            <span class="num" id="resRp">—</span>
          </div>
        </div>
      </div>
      <p class="impact-caption reveal" style="max-width:640px;margin-top:14px;">*Estimasi ilustratif: asumsi ±0,5 kg makanan terselamatkan per rumah tangga per pemakaian, ±2,5 kg CO2e per kg makanan, dan ±Rp15.000 nilai ekonomi per kg — bukan angka riset resmi, hanya untuk menggambarkan skala potensi dampak.</p>
    </div>
  </section>

  <!-- ================= CTA AKHIR ================= -->
  <section class="cta-band" id="mulai" style="--section-bg:var(--paper)">
    <div class="wrap">
      <div class="stamp-wrap">
        <div class="stamp">
          <div class="stamp-state stamp-basi">
            <svg viewBox="0 0 200 200">
              <circle cx="100" cy="100" r="90" fill="none" stroke="#E24A3A" stroke-width="3" stroke-dasharray="5 5"/>
              <circle cx="100" cy="100" r="74" fill="none" stroke="#E24A3A" stroke-width="1.4"/>
              <text x="100" y="88" text-anchor="middle" font-family="JetBrains Mono, monospace" font-size="15" font-weight="700" fill="#E24A3A" letter-spacing="1">AKAN</text>
              <text x="100" y="112" text-anchor="middle" font-family="JetBrains Mono, monospace" font-size="15" font-weight="700" fill="#E24A3A" letter-spacing="1">BASI</text>
            </svg>
          </div>
          <div class="stamp-state stamp-selamat">
            <svg viewBox="0 0 200 200">
              <circle cx="100" cy="100" r="90" fill="none" stroke="#3F6B3D" stroke-width="3" stroke-dasharray="5 5"/>
              <circle cx="100" cy="100" r="74" fill="none" stroke="#3F6B3D" stroke-width="1.4"/>
              <text x="100" y="82" text-anchor="middle" font-family="JetBrains Mono, monospace" font-size="13" font-weight="700" fill="#3F6B3D" letter-spacing="1">TERSELAMATKAN</text>
              <path d="M75 103 L92 120 L128 84" stroke="#3F6B3D" stroke-width="7" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>
      <span class="eyebrow">Mulai dari kulkasmu sendiri</span>
      <h2>Sisa hari ini, bisa jadi berkah malam ini.</h2>
      <a href="{{ auth()->check() ? route('sisa-checker.create') : route('register') }}" class="btn btn-primary">Coba Sisa Checker Sekarang</a>
    </div>
  </section>

</main>

<footer>
  <div class="wrap">
    <div class="footer-top">
      <a href="#top" class="logo">
        <svg width="28" height="28" viewBox="0 0 30 30" fill="none">
          <circle cx="15" cy="15" r="13.5" stroke="currentColor" stroke-width="1.4" stroke-dasharray="2.5 3.2"/>
          <path d="M10 16.5C10 13 12.5 10 15.5 9.5C15.5 12.5 13.5 14.5 10 16.5Z" fill="#F4903F"/>
          <path d="M20 16.5C20 13 17.5 10 14.5 9.5C14.5 12.5 16.5 14.5 20 16.5Z" fill="#8DBF87"/>
        </svg>
        SisaRasa
      </a>
      <ul class="footer-links">
        <li><a href="#fitur">Fitur</a></li>
        <li><a href="#cara-kerja">Cara Kerja</a></li>
        <li><a href="#dampak">Dampak</a></li>
        @guest
          <li><a href="{{ route('register') }}">Mulai Sekarang</a></li>
        @else
          <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        @endguest
      </ul>
    </div>
    <div class="footer-bottom">
      <span>© {{ now()->year }} SisaRasa — dari sisa, jadi berkah.</span>
    </div>
  </div>
</footer>

</body>
</html>
