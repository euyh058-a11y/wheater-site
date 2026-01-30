<?php require __DIR__ . '/partials/header.php'; ?>
<h1>Website Settings</h1>
<form method="post" class="form-grid">
    <div>
        <label>Site Name</label>
        <input type="text" name="site_name" value="<?= e($settings['site_name'] ?? '') ?>">
    </div>
    <div>
        <label>Site Tagline</label>
        <input type="text" name="site_tagline" value="<?= e($settings['site_tagline'] ?? '') ?>">
    </div>
    <div>
        <label>Site Logo URL</label>
        <input type="text" name="site_logo" value="<?= e($settings['site_logo'] ?? '') ?>">
    </div>
    <div>
        <label>Footer Logo URL</label>
        <input type="text" name="footer_logo" value="<?= e($settings['footer_logo'] ?? '') ?>">
    </div>
    <div>
        <label>Hero Title</label>
        <input type="text" name="hero_title" value="<?= e($settings['hero_title'] ?? '') ?>">
    </div>
    <div>
        <label>Hero Subtitle</label>
        <input type="text" name="hero_subtitle" value="<?= e($settings['hero_subtitle'] ?? '') ?>">
    </div>
    <div>
        <label>Featured Countries (comma separated)</label>
        <input type="text" name="featured_countries" value="<?= e($settings['featured_countries'] ?? '') ?>">
    </div>
    <div>
        <label>Weather API URL</label>
        <input type="text" name="weather_api_url" value="<?= e($settings['weather_api_url'] ?? 'https://api.weatherapi.com/v1/forecast.json') ?>">
    </div>
    <div>
        <label>Weather API Key</label>
        <input type="text" name="weather_api_key" value="<?= e($settings['weather_api_key'] ?? '') ?>">
    </div>
    <div>
        <label>Cache TTL (seconds)</label>
        <input type="number" name="weather_cache_ttl" value="<?= e($settings['weather_cache_ttl'] ?? '900') ?>">
    </div>
    <div>
        <label>Footer Text</label>
        <textarea name="footer_text" rows="3"><?= e($settings['footer_text'] ?? '') ?></textarea>
    </div>
    <div>
        <label>Copyright Text</label>
        <input type="text" name="copyright_text" value="<?= e($settings['copyright_text'] ?? '') ?>">
    </div>
    <div>
        <label>Facebook URL</label>
        <input type="text" name="social_facebook" value="<?= e($settings['social_facebook'] ?? '') ?>">
    </div>
    <div>
        <label>Twitter URL</label>
        <input type="text" name="social_twitter" value="<?= e($settings['social_twitter'] ?? '') ?>">
    </div>
    <div>
        <label>Instagram URL</label>
        <input type="text" name="social_instagram" value="<?= e($settings['social_instagram'] ?? '') ?>">
    </div>
    <div class="inline">
        <label><input type="checkbox" name="header_enabled" <?= ($settings['header_enabled'] ?? '1') === '1' ? 'checked' : '' ?>> Show Header</label>
    </div>
    <div class="inline">
        <label><input type="checkbox" name="footer_enabled" <?= ($settings['footer_enabled'] ?? '1') === '1' ? 'checked' : '' ?>> Show Footer</label>
    </div>
    <button type="submit">Save Settings</button>
</form>
<?php require __DIR__ . '/partials/footer.php'; ?>
