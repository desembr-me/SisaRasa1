<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ config('app.name', 'SisaRasa') }} — Dari Sisa, Jadi Berkah</title>
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

<main id="top">

  <!-- ================= HERO ================= -->
  <section class="hero" style="--section-bg:var(--paper)">
    <div class="wrap hero-center">
      <span class="eyebrow">Sebelum basi, selamatkan dulu</span>
      <h1>Dari Sisa,<br><em>Jadi Berkah.</em></h1>
      <p class="lead" style="margin-left:auto;margin-right:auto;">SisaRasa bantu kamu memasak dari bahan yang masih tersisa, menemukan makanan surplus di sekitar sebelum kedaluwarsa, dan melihat dampak nyata dari setiap porsi yang tidak berakhir jadi sampah.</p>
      <div class="hero-ctas">
        <a href="#fitur" class="btn btn-primary">Coba Sisa Checker →</a>
        <a href="#fitur" class="btn btn-ghost">Lihat Peta Surplus</a>
      </div>
    </div>

    <div class="hero-globe">
      <div class="hero-ring"></div>
      <div class="hero-ring ring-inner"></div>
      <div class="stamp-wrap">
        <div class="stamp">
          <div class="stamp-state stamp-basi">
            <svg viewBox="0 0 200 200">
              <circle cx="100" cy="100" r="90" fill="none" stroke="#E24A3A" stroke-width="3" stroke-dasharray="5 5"/>
              <circle cx="100" cy="100" r="74" fill="none" stroke="#E24A3A" stroke-width="1.4"/>
              <text x="100" y="88" text-anchor="middle" font-family="JetBrains Mono, monospace" font-size="15" font-weight="700" fill="#E24A3A" letter-spacing="1">AKAN</text>
              <text x="100" y="112" text-anchor="middle" font-family="JetBrains Mono, monospace" font-size="15" font-weight="700" fill="#E24A3A" letter-spacing="1">BASI</text>
              <path d="M85 130 L100 145 L118 122" stroke="#E24A3A" stroke-width="0" fill="none"/>
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
    </div>

    <div class="wrap hero-stats">
      <span class="stat"><b>23–48 jt ton</b> makanan terbuang / tahun</span>
      <span class="stat">cukup beri makan <b>61–125 jt</b> orang</span>
      <span class="stat"><b>Rp213–551 T</b> kerugian ekonomi / tahun</span>
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
        <div class="receipt reveal">
          <h3>Struk Kerugian Nasional</h3>
          <div class="sub">— makanan sisa, per tahun —</div>

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

          <div class="foot-note">sumber: Kajian Food Loss &amp; Waste — Bappenas, Waste4Change &amp; WRI (2021); KLHK/SIPSN 2023–2025</div>
        </div>

        <div class="problem-notes reveal">
          <div class="note-card">
            <span class="tag">Di rumah</span>
            <p>Bahan sisa di kulkas sering berakhir busuk karena tidak ada ide mau diolah jadi apa sebelum keburu basi.</p>
          </div>
          <div class="note-card">
            <span class="tag">Di resto &amp; toko</span>
            <p>Makanan yang masih layak dibuang begitu saja mendekati jam tutup karena tidak ada saluran cepat untuk menyalurkannya.</p>
          </div>
          <div class="note-card">
            <span class="tag">Di kepala kita</span>
            <p>Kebiasaan boros makanan terus berulang karena dampaknya tidak pernah benar-benar terlihat atau terukur.</p>
          </div>
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

      <div class="feature-grid feature-wheel">
        <div class="wheel-hub" aria-hidden="true">
          <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
            <circle cx="15" cy="15" r="13.5" stroke="#F1F4E7" stroke-width="1.4" stroke-dasharray="2.5 3.2"/>
            <path d="M10 16.5C10 13 12.5 10 15.5 9.5C15.5 12.5 13.5 14.5 10 16.5Z" fill="#F4903F"/>
            <path d="M20 16.5C20 13 17.5 10 14.5 9.5C14.5 12.5 16.5 14.5 20 16.5Z" fill="#DCE6D0"/>
          </svg>
        </div>
        <div class="wheel-spoke spoke-1" aria-hidden="true"></div>
        <div class="wheel-spoke spoke-2" aria-hidden="true"></div>
        <div class="wheel-spoke spoke-3" aria-hidden="true"></div>

        <div class="feature-card node-1 reveal">
          <div class="tape"></div>
          <div class="feature-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M4 8h3l1.5-2h7L17 8h3v11H4V8Z" stroke="#23281E" stroke-width="1.4" stroke-linejoin="round"/><circle cx="12" cy="13.5" r="3.4" stroke="#23281E" stroke-width="1.4"/></svg>
          </div>
          <h3>Sisa Checker</h3>
          <p class="desc">Foto bahan yang masih tersisa di kulkas. AI mengenali bahannya dan menyusun resep yang benar-benar bisa kamu masak hari ini.</p>
          <span class="feature-pill">AI Vision</span>
        </div>

        <div class="feature-card node-2 reveal">
          <div class="tape"></div>
          <div class="feature-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 12 2.5a7 7 0 0 1 7 7C19 14.8 12 21 12 21Z" stroke="#23281E" stroke-width="1.4" stroke-linejoin="round"/><circle cx="12" cy="9.5" r="2.4" stroke="#23281E" stroke-width="1.4"/></svg>
          </div>
          <h3>Peta Surplus</h3>
          <p class="desc">Temukan resto, toko, dan supermarket sekitar dengan makanan surplus mendekati jam tutup — klaim gratis atau diskon besar, real-time.</p>
          <span class="feature-pill">Live Map</span>
        </div>

        <div class="feature-card node-3 reveal">
          <div class="tape"></div>
          <div class="feature-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M4 20V10M12 20V4M20 20v-7" stroke="#23281E" stroke-width="1.4" stroke-linecap="round"/></svg>
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
        <div class="step reveal">
          <div class="step-num">01</div>
          <div class="step-body">
            <h3>Foto atau catat sisa</h3>
            <p>Buka Sisa Checker, foto bahan di kulkas, atau ketik apa yang tersisa.</p>
          </div>
        </div>
        <div class="step reveal">
          <div class="step-num">02</div>
          <div class="step-body">
            <h3>Dapat resep atau surplus terdekat</h3>
            <p>AI menyusun resep, atau kamu buka Peta Surplus untuk lihat makanan yang bisa diklaim di sekitarmu.</p>
          </div>
        </div>
        <div class="step reveal">
          <div class="step-num">03</div>
          <div class="step-body">
            <h3>Masak, klaim, lihat dampaknya</h3>
            <p>Setiap aksi otomatis masuk ke Dashboard Dampak — progresmu bertambah, sampah berkurang.</p>
          </div>
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
      <span class="eyebrow">Mulai dari kulkasmu sendiri</span>
      <h2>Sisa hari ini, bisa jadi berkah malam ini.</h2>
      <a href="{{ auth()->check() ? route('dashboard') : route('register') }}" class="btn btn-primary">Coba Sisa Checker Sekarang</a>
      <p class="sub">Gratis. Tanpa kartu, tanpa ribet.</p>
    </div>
  </section>

</main>

<footer>
  <div class="wrap">
    <div class="footer-top">
      <div class="footer-col footer-brand">
        <a href="#top" class="logo">
          <svg width="28" height="28" viewBox="0 0 30 30" fill="none">
            <circle cx="15" cy="15" r="13.5" stroke="currentColor" stroke-width="1.4" stroke-dasharray="2.5 3.2"/>
            <path d="M10 16.5C10 13 12.5 10 15.5 9.5C15.5 12.5 13.5 14.5 10 16.5Z" fill="#F4903F"/>
            <path d="M20 16.5C20 13 17.5 10 14.5 9.5C14.5 12.5 16.5 14.5 20 16.5Z" fill="#8DBF87"/>
          </svg>
          SisaRasa
        </a>
        <p class="footer-tagline">Dari sisa, jadi berkah — selamatkan makanan sebelum basi.</p>
      </div>
      <div class="footer-col">
        <span class="footer-heading">Navigasi</span>
        <ul class="footer-links">
          <li><a href="#fitur">Fitur</a></li>
          <li><a href="#cara-kerja">Cara Kerja</a></li>
          <li><a href="#dampak">Dampak</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <span class="footer-heading">Mulai</span>
        @guest
          <a href="{{ route('register') }}" class="btn btn-ghost footer-cta">Mulai Sekarang</a>
        @else
          <a href="{{ route('dashboard') }}" class="btn btn-ghost footer-cta">Ke Dashboard</a>
        @endguest
      </div>
    </div>
    <div class="footer-bottom">
      <span>© {{ now()->year }} SisaRasa — dari sisa, jadi berkah.</span>
      <span>dibuat untuk lomba pengembangan solusi food waste</span>
    </div>
  </div>
</footer>

</body>
</html>
