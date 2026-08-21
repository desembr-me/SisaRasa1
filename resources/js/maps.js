import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import markerIcon2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl: markerIcon2x,
    iconUrl: markerIcon,
    shadowUrl: markerShadow,
});

const DEFAULT_CENTER = [-6.2088, 106.8456]; // Jakarta
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

function escapeHtml(value) {
    const div = document.createElement('div');
    div.textContent = value ?? '';
    return div.innerHTML;
}

// ---------- Peta Surplus: browse map with claim buttons ----------
const surplusMapEl = document.getElementById('surplus-map');
if (surplusMapEl) {
    const stores = JSON.parse(surplusMapEl.dataset.stores || '[]');
    const center = stores.length
        ? [stores[0].latitude, stores[0].longitude]
        : DEFAULT_CENTER;

    const map = L.map(surplusMapEl).setView(center, stores.length ? 12 : 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19,
    }).addTo(map);

    stores.forEach((store) => {
        const listingsHtml = store.listings.map((listing) => `
            <div style="padding:8px 0;border-top:1px solid #C7BF9C;">
                <div style="font-weight:700;font-size:13px;">${escapeHtml(listing.title)}</div>
                ${listing.description ? `<div style="font-size:12px;color:#565C43;">${escapeHtml(listing.description)}</div>` : ''}
                <div style="font-size:12px;margin-top:4px;">
                    <span style="font-weight:700;color:#3F6B3D;">${escapeHtml(listing.price_label)}</span>
                    &middot; sisa ${listing.remaining}
                    &middot; sampai ${escapeHtml(listing.expires_at)}
                </div>
                <form method="POST" action="${listing.claim_url}" style="margin-top:6px;">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <button type="submit" style="font-size:12px;font-weight:700;background:#23281E;color:#F1F4E7;padding:5px 12px;border-radius:999px;border:none;cursor:pointer;">
                        Klaim
                    </button>
                </form>
            </div>
        `).join('');

        L.marker([store.latitude, store.longitude])
            .addTo(map)
            .bindPopup(`
                <div style="min-width:220px;font-family:inherit;">
                    <div style="font-weight:700;font-size:14px;">${escapeHtml(store.name)}</div>
                    <div style="font-size:12px;color:#565C43;">${escapeHtml(store.address)}</div>
                    ${listingsHtml}
                </div>
            `);
    });
}

// ---------- Mitra: pick store location on a map ----------
const pickerEl = document.getElementById('location-picker');
if (pickerEl) {
    const latInput = document.getElementById('latitude-input');
    const lngInput = document.getElementById('longitude-input');

    const initial = (latInput.value && lngInput.value)
        ? [parseFloat(latInput.value), parseFloat(lngInput.value)]
        : DEFAULT_CENTER;

    const map = L.map(pickerEl).setView(initial, 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19,
    }).addTo(map);

    let marker = (latInput.value && lngInput.value) ? L.marker(initial).addTo(map) : null;

    map.on('click', (e) => {
        latInput.value = e.latlng.lat.toFixed(7);
        lngInput.value = e.latlng.lng.toFixed(7);

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });
}
