<?php
$settings = $settings ?? [];
$articles = $articles ?? [];
$featuredCountries = $settings['featured_countries'] ?? 'United States, United Kingdom, Pakistan, Saudi Arabia, United Arab Emirates';
$featuredList = array_map('trim', explode(',', $featuredCountries));
$headerAd = $ads['header'] ?? null;
$footerAd = $ads['footer'] ?? null;
$sidebarAd = $ads['sidebar'] ?? null;
$inContentAd = $ads['in_content'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($settings['site_name'] ?? 'FMREI Weather') ?></title>
    <link rel="stylesheet" href="<?= asset_url('css/styles.css') ?>">
</head>
<body>
<?php require __DIR__ . '/partials/header.php'; ?>

<?php if ($headerAd): ?>
    <section class="ad-slot ad-header"><?= $headerAd['code']; ?></section>
<?php endif; ?>

<main class="container">
    <section class="hero">
        <div class="hero-content">
            <h2 id="heroTitle"><?= e($settings['hero_title'] ?? 'Live Weather Intelligence') ?></h2>
            <p id="heroSubtitle"><?= e($settings['hero_subtitle'] ?? 'Search any city worldwide to get real-time weather, hourly and daily forecasts.') ?></p>
            <div class="hero-search">
                <input type="text" id="heroSearch" placeholder="Enter city or country">
                <button id="heroSearchButton">Check Weather</button>
            </div>
        </div>
        <div class="hero-card" id="heroCard">
            <div class="hero-card-header">
                <h3 id="weatherLocation">Search for a location</h3>
                <span id="weatherStatus">--</span>
            </div>
            <div class="hero-card-body">
                <div class="temp" id="weatherTemp">--°C</div>
                <div class="details">
                    <p>Humidity: <span id="weatherHumidity">--%</span></p>
                    <p>Wind: <span id="weatherWind">-- km/h</span></p>
                    <p>Pressure: <span id="weatherPressure">-- mb</span></p>
                </div>
            </div>
            <div class="hero-card-footer">
                <p>Sunrise: <span id="weatherSunrise">--</span></p>
                <p>Sunset: <span id="weatherSunset">--</span></p>
            </div>
        </div>
    </section>

    <section class="grid-section">
        <div class="section-header">
            <h3>Live Weather Cards</h3>
            <p>Auto-updated forecasts from trusted sources.</p>
        </div>
        <div class="cards" id="liveCards">
            <div class="card">
                <h4>Hourly Forecast</h4>
                <ul id="hourlyForecast"></ul>
            </div>
            <div class="card">
                <h4>Daily Forecast</h4>
                <ul id="dailyForecast"></ul>
            </div>
            <div class="card">
                <h4>Air & Climate</h4>
                <ul>
                    <li>Visibility: <span id="weatherVisibility">-- km</span></li>
                    <li>UV Index: <span id="weatherUv">--</span></li>
                    <li>Feels Like: <span id="weatherFeels">--°C</span></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="grid-section">
        <div class="section-header">
            <h3>Featured Countries</h3>
            <p>Fast access to popular locations.</p>
        </div>
        <div class="featured-countries">
            <?php foreach ($featuredList as $country): ?>
                <button class="country-pill" data-location="<?= e($country) ?>"><?= e($country) ?></button>
            <?php endforeach; ?>
        </div>
    </section>

    <?php if ($inContentAd): ?>
        <section class="ad-slot ad-inline"><?= $inContentAd['code']; ?></section>
    <?php endif; ?>

    <section class="grid-section">
        <div class="section-header">
            <h3>Weather Insights & Articles</h3>
            <p>Expert editorial curated by our team.</p>
        </div>
        <div class="articles">
            <?php foreach ($articles as $article): ?>
                <article class="article-card">
                    <img src="<?= e($article['featured_image'] ?: asset_url('images/article-placeholder.svg')) ?>" alt="<?= e($article['title']) ?>">
                    <div>
                        <span class="category"><?= e($article['category_name'] ?? 'Insights') ?></span>
                        <h4><?= e($article['title']) ?></h4>
                        <p><?= e(mb_substr(strip_tags($article['body']), 0, 140)) ?>...</p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="grid-section media-section">
        <div class="section-header">
            <h3>Media Gallery</h3>
            <p>Curated imagery from around the world.</p>
        </div>
        <div class="media-grid" id="mediaGrid">
            <?php foreach ($media as $item): ?>
                <figure>
                    <img src="<?= upload_url($item['file_name']) ?>" alt="<?= e($item['original_name']) ?>">
                </figure>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php if ($footerAd): ?>
    <section class="ad-slot ad-footer"><?= $footerAd['code']; ?></section>
<?php endif; ?>

<?php require __DIR__ . '/partials/footer.php'; ?>
<script src="<?= asset_url('js/app.js') ?>"></script>
</body>
</html>
