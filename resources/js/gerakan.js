const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// ---------- nav shadow on scroll ----------
const nav = document.getElementById('gNav');
if (nav) {
    window.addEventListener('scroll', () => nav.classList.toggle('scrolled', window.scrollY > 8), { passive: true });
}

// ---------- hero ambient animation: mycelium growth, decay green -> rescued amber, loops ----------
// literal metaphor: organic light growing through "decayed" leftovers, then warming into
// "rescued" energy, then fading — the single ambient animation on this page.
(function mycelium() {
    const svg = document.getElementById('myceliumSvg');
    if (!svg) return;

    const NS = 'http://www.w3.org/2000/svg';
    const paths = [];

    function grow(x, y, angle, length, depth) {
        if (depth <= 0 || length < 10) return;

        const x2 = x + Math.cos(angle) * length;
        const y2 = y + Math.sin(angle) * length;
        const bow = (Math.random() - 0.5) * length * 0.5;
        const midX = (x + x2) / 2 + Math.cos(angle + Math.PI / 2) * bow;
        const midY = (y + y2) / 2 + Math.sin(angle + Math.PI / 2) * bow;
        const len = Math.hypot(x2 - x, y2 - y) * 1.2;

        paths.push({ d: `M ${x.toFixed(1)} ${y.toFixed(1)} Q ${midX.toFixed(1)} ${midY.toFixed(1)} ${x2.toFixed(1)} ${y2.toFixed(1)}`, len, depth, leaf: depth === 1, x2, y2 });

        const branchCount = depth > 3 ? (Math.random() < 0.75 ? 2 : 1) : (Math.random() < 0.5 ? 1 : 0);
        for (let i = 0; i < branchCount; i++) {
            const spread = 0.55 + Math.random() * 0.4;
            const newAngle = angle + (i === 0 ? -1 : 1) * spread * (0.6 + Math.random() * 0.5);
            grow(x2, y2, newAngle, length * (0.66 + Math.random() * 0.16), depth - 1);
        }
        if (Math.random() < 0.55 && depth > 1) {
            grow(x2, y2, angle + (Math.random() - 0.5) * 0.35, length * 0.8, depth - 1);
        }
    }

    const roots = 6;
    for (let i = 0; i < roots; i++) {
        const x = 120 + (760 / (roots - 1)) * i + (Math.random() - 0.5) * 40;
        const angle = -Math.PI / 2 + (Math.random() - 0.5) * 0.5;
        grow(x, 480, angle, 46 + Math.random() * 18, 6);
    }

    const defs = document.createElementNS(NS, 'defs');
    const gradient = document.createElementNS(NS, 'linearGradient');
    gradient.setAttribute('id', 'mycGradient');
    gradient.setAttribute('x1', '0'); gradient.setAttribute('y1', '1');
    gradient.setAttribute('x2', '0'); gradient.setAttribute('y2', '0');
    gradient.innerHTML = '<stop offset="0%" stop-color="#BFE49B" /><stop offset="100%" stop-color="#F4903F" />';
    defs.appendChild(gradient);
    svg.appendChild(defs);

    const group = document.createElementNS(NS, 'g');
    group.setAttribute('class', 'myc-group');
    svg.appendChild(group);

    paths.forEach((p, i) => {
        const el = document.createElementNS(NS, 'path');
        el.setAttribute('d', p.d);
        el.setAttribute('class', 'myc-path');
        if (reduceMotion) {
            el.setAttribute('stroke', 'url(#mycGradient)');
        } else {
            el.style.setProperty('--len', p.len.toFixed(1));
            el.style.setProperty('--d', (Math.random() * 1.1).toFixed(2) + 's');
            el.style.strokeDasharray = String(p.len.toFixed(1));
        }
        el.style.strokeWidth = (0.9 + (7 - p.depth) * 0.18).toFixed(2);
        group.appendChild(el);

        if (p.leaf && Math.random() < 0.5) {
            const dot = document.createElementNS(NS, 'circle');
            dot.setAttribute('cx', p.x2.toFixed(1));
            dot.setAttribute('cy', p.y2.toFixed(1));
            dot.setAttribute('r', '2.4');
            dot.setAttribute('class', 'myc-spore');
            dot.setAttribute('fill', reduceMotion ? 'url(#mycGradient)' : 'currentColor');
            group.appendChild(dot);
        }
    });
})();

// ---------- functional bar fills + count-up, triggered once when scrolled into view ----------
function animateCount(el) {
    const target = parseFloat(el.dataset.countTo);
    if (Number.isNaN(target)) return;
    const decimals = parseInt(el.dataset.countDecimals || '0', 10);
    const format = (n) => n.toLocaleString('id-ID', { minimumFractionDigits: decimals, maximumFractionDigits: decimals });

    if (reduceMotion) { el.textContent = format(target); return; }

    const duration = 1000;
    const start = performance.now();
    const tick = (now) => {
        const p = Math.min(1, (now - start) / duration);
        el.textContent = format(target * (1 - (1 - p) ** 3));
        if (p < 1) requestAnimationFrame(tick); else el.textContent = format(target);
    };
    requestAnimationFrame(tick);
}

const revealTargets = document.querySelectorAll('[data-count-to], [data-fill]');
if (revealTargets.length) {
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            if (el.dataset.countTo) animateCount(el);
            if (el.dataset.fill) el.style.width = reduceMotion ? el.dataset.fill : el.dataset.fill;
            io.unobserve(el);
        });
    }, { threshold: 0.4 });
    revealTargets.forEach((el) => io.observe(el));
}

// ---------- pillar accordion (peta jalan), one open at a time ----------
document.querySelectorAll('.pillar-trigger').forEach((trigger) => {
    trigger.addEventListener('click', () => {
        const item = trigger.closest('.pillar');
        const wasOpen = item.classList.contains('is-open');
        document.querySelectorAll('.pillar.is-open').forEach((p) => {
            p.classList.remove('is-open');
            p.querySelector('.pillar-trigger').setAttribute('aria-expanded', 'false');
        });
        if (!wasOpen) {
            item.classList.add('is-open');
            trigger.setAttribute('aria-expanded', 'true');
        }
    });
});

// ---------- timeline detail toggle ----------
document.querySelectorAll('.tl-toggle').forEach((btn) => {
    btn.addEventListener('click', () => {
        const item = btn.closest('.tl-item');
        const open = item.classList.toggle('is-open');
        btn.textContent = open ? 'Sembunyikan detail' : 'Lihat detail & sumber';
    });
});

// ---------- tanya ai: curated Q&A widget (client-side, not a live model) ----------
(function askAi() {
    const body = document.getElementById('aiBody');
    const form = document.getElementById('aiForm');
    const input = document.getElementById('aiInput');
    const chips = document.querySelectorAll('.ai-chip');
    if (!body || !form || !input) return;

    const dataset = [
        {
            keywords: ['bahaya', 'iklim', 'kenapa', 'metana', 'emisi'],
            q: 'Kenapa sisa makanan bisa berdampak ke krisis iklim?',
            a: 'Saat sisa makanan membusuk di tempat pembuangan tanpa oksigen, ia melepaskan metana — gas rumah kaca yang jauh lebih kuat menahan panas daripada CO2. Menurut kajian Bappenas (2021), sisa & susut pangan Indonesia menyumbang 1.702,9 juta ton CO2e sepanjang 2000–2019, rata-rata 7,29% dari total emisi gas rumah kaca tahunan Indonesia.',
        },
        {
            keywords: ['sekarang', 'hari ini', 'mulai', 'lakukan', 'aksi'],
            q: 'Apa yang bisa aku lakukan mulai hari ini?',
            a: 'Mulai dari dapurmu: catat bahan yang mau basi di Sisa Checker untuk dapat ide masakan, atau klaim surplus makanan dari mitra terdekat. Setiap aksi yang kamu catat masuk ke Dashboard Dampak — kg yang terlihat kecil di rumahmu, terhubung ke angka emisi nasional yang jauh lebih besar.',
        },
        {
            keywords: ['gerakan', 'selamatkan pangan', 'pemerintah', 'program'],
            q: 'Apa itu Gerakan Selamatkan Pangan?',
            a: 'Gerakan Selamatkan Pangan adalah program Badan Pangan Nasional yang dimulai akhir 2022 di Jabodetabekjur, menghubungkan bank pangan dan armada logistik untuk menyalurkan surplus pangan. Program ini meluas ke 12 provinsi pada 2023, dan 15 provinsi pada 2024.',
        },
        {
            keywords: ['2045', 'target', 'masa depan', 'roadmap', 'peta jalan'],
            q: 'Apa target Indonesia soal sisa makanan di 2045?',
            a: 'Tanpa intervensi, Bappenas memproyeksikan food loss and waste per kapita naik ke 344 kg/tahun pada 2045. Dengan Peta Jalan Pengelolaan Susut & Sisa Pangan yang berjalan, target itu ditekan hingga 166 kg/kapita/tahun — penurunan sekitar 55,88%, sejalan dengan visi ketahanan pangan Indonesia Emas 2045.',
        },
        {
            keywords: ['ndc', 'komitmen', 'paris', 'target nasional', 'grk'],
            q: 'Apa hubungannya dengan target iklim NDC Indonesia?',
            a: 'Indonesia menargetkan penurunan emisi gas rumah kaca 29–41% pada 2030 lewat NDC (Nationally Determined Contribution). Sisa makanan yang menyumbang rata-rata 7,29% dari emisi tahunan Indonesia berarti pengurangannya adalah salah satu jalur paling langsung dan bisa dimulai dari rumah tangga — bukan cuma soal industri atau kehutanan.',
        },
    ];

    const fallback = 'Pertanyaan itu di luar cakupan kumpulan FAQ singkat ini. Coba salah satu topik di atas, atau langsung praktik lewat <a href="' + (form.dataset.checkerUrl || '#') + '">Sisa Checker</a>.';

    function addMessage(role, html) {
        const row = document.createElement('div');
        row.className = 'ai-msg' + (role === 'user' ? ' is-user' : '');
        row.innerHTML = `
            <div class="ai-msg-avatar">${role === 'user' ? '🙋' : '🌱'}</div>
            <div class="ai-msg-bubble">${html}</div>
        `;
        body.appendChild(row);
        body.scrollTop = body.scrollHeight;
    }

    function answer(text) {
        const normalized = text.toLowerCase();
        let best = null;
        let bestScore = 0;
        dataset.forEach((entry) => {
            const score = entry.keywords.filter((k) => normalized.includes(k)).length;
            if (score > bestScore) { bestScore = score; best = entry; }
        });
        addMessage('user', text);
        setTimeout(() => addMessage('ai', best ? best.a : fallback), 380);
    }

    chips.forEach((chip) => chip.addEventListener('click', () => answer(chip.textContent.trim())));

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const value = input.value.trim();
        if (!value) return;
        answer(value);
        input.value = '';
    });
})();
