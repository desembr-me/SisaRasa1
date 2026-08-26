import { Chart, BarController, BarElement, DoughnutController, ArcElement, CategoryScale, LinearScale, Tooltip } from 'chart.js';

Chart.register(BarController, BarElement, DoughnutController, ArcElement, CategoryScale, LinearScale, Tooltip);

const styles = getComputedStyle(document.documentElement);
const cssVar = (name, fallback) => (styles.getPropertyValue(name).trim() || fallback);

const leaf = cssVar('--leaf', '#3F6B3D');
const leafSoft = cssVar('--leaf-soft', '#DCE6D0');
const ink = cssVar('--ink', '#23281E');
const indigo = cssVar('--color-indigo-500', '#B23A5E');

// 14-day trend bar chart
const trendCanvas = document.getElementById('trendChart');
if (trendCanvas) {
    const trend = JSON.parse(document.getElementById('trendChart-data').textContent);

    new Chart(trendCanvas, {
        type: 'bar',
        data: {
            labels: trend.labels,
            datasets: [{
                data: trend.data,
                backgroundColor: trend.data.map((v) => (v > 0 ? leaf : leafSoft)),
                borderRadius: 5,
                maxBarThickness: 22,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: ink,
                    padding: 8,
                    displayColors: false,
                    callbacks: {
                        label: (ctx) => `${ctx.parsed.y.toLocaleString('id-ID', { maximumFractionDigits: 1 })} kg`,
                    },
                },
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: ink, font: { size: 10 } },
                },
                y: {
                    beginAtZero: true,
                    grid: { color: leafSoft },
                    ticks: { color: ink, font: { size: 10 } },
                },
            },
        },
    });
}

// masak vs klaim source-breakdown donut
const sourceCanvas = document.getElementById('sourceChart');
if (sourceCanvas) {
    const source = JSON.parse(document.getElementById('sourceChart-data').textContent);

    new Chart(sourceCanvas, {
        type: 'doughnut',
        data: {
            labels: ['Masak dari sisa', 'Klaim surplus'],
            datasets: [{
                data: [source.masak, source.klaim],
                backgroundColor: [leaf, indigo],
                borderColor: cssVar('--paper-card', '#FBFAF3'),
                borderWidth: 3,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: ink,
                    padding: 8,
                    displayColors: false,
                    callbacks: {
                        label: (ctx) => `${ctx.label}: ${ctx.parsed.toLocaleString('id-ID', { maximumFractionDigits: 1 })} kg`,
                    },
                },
            },
        },
    });
}

// animated count-up on stat numbers, progressively enhancing the server-rendered value
if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.querySelectorAll('[data-count-to]').forEach((el) => {
        const target = parseFloat(el.dataset.countTo);
        const decimals = parseInt(el.dataset.countDecimals || '0', 10);

        if (Number.isNaN(target)) return;

        const format = (n) => n.toLocaleString('id-ID', { minimumFractionDigits: decimals, maximumFractionDigits: decimals });
        const duration = 900;
        const start = performance.now();

        const tick = (now) => {
            const progress = Math.min(1, (now - start) / duration);
            const eased = 1 - (1 - progress) ** 3;
            el.textContent = format(target * eased);

            if (progress < 1) {
                requestAnimationFrame(tick);
            } else {
                el.textContent = format(target);
            }
        };

        requestAnimationFrame(tick);
    });
}

// release the entrance animation once it finishes: while it's active, its held
// end-state `transform` outranks the :hover lift/tilt rule on the same element
document.querySelectorAll('.dash-fade').forEach((el) => {
    el.addEventListener('animationend', () => el.classList.remove('dash-fade'), { once: true });
});
