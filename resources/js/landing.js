import Lenis from 'lenis';

// smooth inertia scrolling
if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches){
    const lenis = new Lenis({
        duration: 1.05,
        easing: (t) => 1 - Math.pow(1 - t, 3),
        smoothWheel: true,
        wheelMultiplier: 1,
    });
    const raf = (time) => {
        lenis.raf(time);
        requestAnimationFrame(raf);
    };
    requestAnimationFrame(raf);
}

// sticky header shadow
const header = document.getElementById('site-header');
window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 8);
});

// mobile nav toggle
const navToggle = document.getElementById('navToggle');
const navLinks = document.getElementById('navLinks');
navToggle.addEventListener('click', () => {
    const open = navLinks.classList.toggle('open');
    navToggle.setAttribute('aria-expanded', open);
});
navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
    navLinks.classList.remove('open');
    navToggle.setAttribute('aria-expanded', false);
}));

// scroll reveal
const revealEls = document.querySelectorAll('.reveal');
const io = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting){
            setTimeout(() => entry.target.classList.add('in'), i * 60);
            io.unobserve(entry.target);
        }
    });
}, { threshold: 0.15 });
revealEls.forEach(el => io.observe(el));

// impact calculator
const householdsInput = document.getElementById('households');
const householdsVal = document.getElementById('householdsVal');
const resKg = document.getElementById('resKg');
const resCo2 = document.getElementById('resCo2');
const resRp = document.getElementById('resRp');

function fmt(num){
    return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 0 }).format(num);
}

function updateImpact(){
    const households = parseInt(householdsInput.value, 10);
    const kgPerHousehold = 0.5;
    const co2PerKg = 2.5;
    const rpPerKg = 15000;

    const totalKg = households * kgPerHousehold;
    const totalCo2 = totalKg * co2PerKg;
    const totalRp = totalKg * rpPerKg;

    householdsVal.textContent = fmt(households) + ' rumah tangga';
    resKg.textContent = fmt(totalKg) + ' kg';
    resCo2.textContent = fmt(totalCo2) + ' kg CO2e';
    resRp.textContent = 'Rp' + fmt(totalRp);
}

householdsInput.addEventListener('input', updateImpact);
updateImpact();

// receipt tilt-on-touch/hover
const receipt = document.querySelector('.receipt');
if (receipt && !window.matchMedia('(prefers-reduced-motion: reduce)').matches){
    const baseRotate = 'rotate(-1.1deg)';
    const maxTilt = 13;

    if (window.matchMedia('(hover: hover)').matches){
        receipt.addEventListener('mousemove', (e) => {
            const rect = receipt.getBoundingClientRect();
            const px = (e.clientX - rect.left) / rect.width;
            const py = (e.clientY - rect.top) / rect.height;
            const rotateY = (px - 0.5) * maxTilt * 2;
            const rotateX = (0.5 - py) * maxTilt * 2;
            receipt.style.transition = 'box-shadow .4s ease';
            receipt.style.transform = `perspective(700px) ${baseRotate} rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.06)`;
        });
        receipt.addEventListener('mouseleave', () => {
            receipt.style.transition = 'transform .5s cubic-bezier(.2,.8,.2,1), box-shadow .4s ease';
            receipt.style.transform = '';
        });
    } else {
        receipt.addEventListener('touchstart', () => {
            receipt.style.transition = 'transform .3s ease, box-shadow .3s ease';
            receipt.style.transform = 'rotate(0deg) scale(1.06)';
            receipt.classList.add('is-touched');
        }, { passive: true });
        receipt.addEventListener('touchend', () => {
            receipt.style.transition = 'transform .4s ease, box-shadow .4s ease';
            receipt.style.transform = '';
            receipt.classList.remove('is-touched');
        }, { passive: true });
    }
}

// note-card photo flip on tap (touch devices don't have :hover)
if (!window.matchMedia('(hover: hover)').matches){
    document.querySelectorAll('.note-photo-wrap').forEach((wrap) => {
        wrap.addEventListener('click', (e) => {
            e.stopPropagation();
            document.querySelectorAll('.note-photo-wrap.is-flipped').forEach((other) => {
                if (other !== wrap) other.classList.remove('is-flipped');
            });
            wrap.classList.toggle('is-flipped');
        });
    });
}

// gallery photo pile: photos stack on top of each other and slide up and away
// one by one, revealing the next in the stack, as the page scrolls
const pileWrap = document.querySelector('.gallery-pile');
const pileSticky = document.querySelector('.gallery-pile-sticky');
const pilePhotos = document.querySelectorAll('.gallery-photo');
if (pileWrap && pileSticky && pilePhotos.length && !window.matchMedia('(prefers-reduced-motion: reduce)').matches){
    const baselines = [
        { rot: -1, x: 0, y: 0 },
        { rot: 1.8, x: 26, y: 16 },
        { rot: -2.4, x: -30, y: 20 },
        { rot: 2.6, x: 32, y: -16 },
    ];
    let pileTicking = false;
    const updatePile = () => {
        const rect = pileWrap.getBoundingClientRect();
        const scrollable = rect.height - pileSticky.offsetHeight;
        const overall = scrollable > 0 ? Math.max(0, Math.min(1, -rect.top / scrollable)) : 0;
        const n = pilePhotos.length;
        const segments = Math.max(1, n - 1); // the last photo settles in place instead of sliding away
        pilePhotos.forEach((photo, i) => {
            const b = baselines[i] || baselines[baselines.length - 1];
            if (i >= segments){
                photo.style.transform = `translate(-50%, -50%) translate(${b.x}px, ${b.y}px) rotate(${b.rot}deg)`;
                return;
            }
            const segStart = i / segments;
            const segEnd = (i + 1) / segments;
            let local = (overall - segStart) / (segEnd - segStart);
            local = Math.max(0, Math.min(1, local));
            const slideY = local * -160;
            photo.style.transform = `translate(-50%, -50%) translate(${b.x}px, ${b.y}px) translateY(${slideY}%) rotate(${b.rot}deg)`;
        });
        pileTicking = false;
    };
    window.addEventListener('scroll', () => {
        if (!pileTicking){
            requestAnimationFrame(updatePile);
            pileTicking = true;
        }
    }, { passive: true });
    updatePile();
}

// feature cards tilt in 3D toward the cursor, like picking up a card
if (window.matchMedia('(hover: hover)').matches && !window.matchMedia('(prefers-reduced-motion: reduce)').matches){
    document.querySelectorAll('.feature-card').forEach((card) => {
        const maxTilt = 9;
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const px = (e.clientX - rect.left) / rect.width;
            const py = (e.clientY - rect.top) / rect.height;
            const rotateY = (px - 0.5) * maxTilt * 2;
            const rotateX = (0.5 - py) * maxTilt * 2;
            card.style.transition = 'box-shadow .3s ease';
            card.style.transform = `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px) scale(1.02)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transition = 'transform .5s cubic-bezier(.2,.8,.2,1), box-shadow .3s ease';
            card.style.transform = '';
        });
    });
}
