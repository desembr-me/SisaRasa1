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
