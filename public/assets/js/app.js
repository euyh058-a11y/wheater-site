const state = {
    lastQuery: null,
};

const elements = {
    searchInput: document.getElementById('searchInput'),
    searchButton: document.getElementById('searchButton'),
    heroSearch: document.getElementById('heroSearch'),
    heroSearchButton: document.getElementById('heroSearchButton'),
    weatherLocation: document.getElementById('weatherLocation'),
    weatherStatus: document.getElementById('weatherStatus'),
    weatherTemp: document.getElementById('weatherTemp'),
    weatherHumidity: document.getElementById('weatherHumidity'),
    weatherWind: document.getElementById('weatherWind'),
    weatherPressure: document.getElementById('weatherPressure'),
    weatherSunrise: document.getElementById('weatherSunrise'),
    weatherSunset: document.getElementById('weatherSunset'),
    weatherVisibility: document.getElementById('weatherVisibility'),
    weatherUv: document.getElementById('weatherUv'),
    weatherFeels: document.getElementById('weatherFeels'),
    hourlyForecast: document.getElementById('hourlyForecast'),
    dailyForecast: document.getElementById('dailyForecast'),
    siteName: document.getElementById('siteName'),
    siteTagline: document.getElementById('siteTagline'),
    heroTitle: document.getElementById('heroTitle'),
    heroSubtitle: document.getElementById('heroSubtitle'),
    footerText: document.getElementById('footerText'),
    copyrightText: document.getElementById('copyrightText'),
    mainNav: document.querySelector('.main-nav ul'),
    footerNav: document.querySelector('.footer-nav ul'),
};

function formatTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}

function updateForecastList(listElement, items) {
    listElement.innerHTML = '';
    items.forEach((item) => {
        const li = document.createElement('li');
        li.textContent = item;
        listElement.appendChild(li);
    });
}

function normalizeWeatherData(data) {
    const current = data.current;
    const location = data.location;
    const forecast = data.forecast?.forecastday?.[0];
    const hourly = forecast?.hour?.slice(0, 6) || [];
    const daily = data.forecast?.forecastday || [];

    return {
        location: `${location.name}, ${location.country}`,
        status: current.condition.text,
        temp: current.temp_c,
        humidity: current.humidity,
        wind: current.wind_kph,
        pressure: current.pressure_mb,
        sunrise: forecast?.astro?.sunrise || '--',
        sunset: forecast?.astro?.sunset || '--',
        visibility: current.vis_km,
        uv: current.uv,
        feels: current.feelslike_c,
        hourly: hourly.map((hour) => `${formatTime(hour.time)} - ${hour.temp_c}°C`),
        daily: daily.map((day) => `${day.date} - ${day.day.avgtemp_c}°C`),
    };
}

function renderWeather(payload) {
    elements.weatherLocation.textContent = payload.location;
    elements.weatherStatus.textContent = payload.status;
    elements.weatherTemp.textContent = `${payload.temp}°C`;
    elements.weatherHumidity.textContent = `${payload.humidity}%`;
    elements.weatherWind.textContent = `${payload.wind} km/h`;
    elements.weatherPressure.textContent = `${payload.pressure} mb`;
    elements.weatherSunrise.textContent = payload.sunrise;
    elements.weatherSunset.textContent = payload.sunset;
    elements.weatherVisibility.textContent = `${payload.visibility} km`;
    elements.weatherUv.textContent = payload.uv;
    elements.weatherFeels.textContent = `${payload.feels}°C`;
    updateForecastList(elements.hourlyForecast, payload.hourly);
    updateForecastList(elements.dailyForecast, payload.daily);
}

function renderMenus(menuElement, items) {
    if (!menuElement) return;
    menuElement.innerHTML = '';
    items.forEach((item) => {
        const li = document.createElement('li');
        const link = document.createElement('a');
        link.href = item.url;
        link.textContent = item.label;
        li.appendChild(link);
        menuElement.appendChild(li);
    });
}

async function fetchSettings() {
    const response = await fetch('/api/settings.php');
    if (!response.ok) return;
    const data = await response.json();
    const settings = data.settings || {};

    if (elements.siteName) elements.siteName.textContent = settings.site_name || elements.siteName.textContent;
    if (elements.siteTagline) elements.siteTagline.textContent = settings.site_tagline || elements.siteTagline.textContent;
    if (elements.heroTitle) elements.heroTitle.textContent = settings.hero_title || elements.heroTitle.textContent;
    if (elements.heroSubtitle) elements.heroSubtitle.textContent = settings.hero_subtitle || elements.heroSubtitle.textContent;
    if (elements.footerText) elements.footerText.textContent = settings.footer_text || elements.footerText.textContent;
    if (elements.copyrightText) elements.copyrightText.textContent = settings.copyright_text || elements.copyrightText.textContent;

    renderMenus(elements.mainNav, data.headerMenu || []);
    renderMenus(elements.footerNav, data.footerMenu || []);
}

async function fetchWeather(query) {
    if (!query) return;
    state.lastQuery = query;
    const response = await fetch(`/api/weather.php?q=${encodeURIComponent(query)}`);
    const json = await response.json();
    if (json.error) {
        alert(json.error);
        return;
    }
    const normalized = normalizeWeatherData(json.data);
    renderWeather(normalized);
}

function handleSearch() {
    const query = elements.heroSearch?.value || elements.searchInput?.value;
    if (query) {
        fetchWeather(query);
    }
}

if (elements.searchButton) {
    elements.searchButton.addEventListener('click', handleSearch);
}
if (elements.heroSearchButton) {
    elements.heroSearchButton.addEventListener('click', handleSearch);
}

document.querySelectorAll('.country-pill').forEach((button) => {
    button.addEventListener('click', () => {
        fetchWeather(button.dataset.location);
    });
});

const savedLocation = localStorage.getItem('fmrei_last_location');
if (savedLocation) {
    fetchWeather(savedLocation);
}

setInterval(() => {
    if (state.lastQuery) {
        localStorage.setItem('fmrei_last_location', state.lastQuery);
        fetchWeather(state.lastQuery);
    }
}, 60000);

setInterval(() => {
    fetchSettings();
}, 45000);

fetchSettings();
