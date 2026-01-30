<?php require __DIR__ . '/partials/header.php'; ?>
<h1>Dashboard</h1>
<div class="stat-grid">
    <div class="stat-card">
        <h3>Total Articles</h3>
        <p><?= e((string) $stats['articles']) ?></p>
    </div>
    <div class="stat-card">
        <h3>Total Media Files</h3>
        <p><?= e((string) $stats['media']) ?></p>
    </div>
    <div class="stat-card">
        <h3>Ads Active</h3>
        <p><?= e((string) $stats['ads']) ?></p>
    </div>
</div>
<section class="quick-settings">
    <h2>Quick Settings</h2>
    <p>Update your site identity, weather API, and layout toggles from Settings.</p>
    <a class="button" href="/<?= ADMIN_DIR ?>/?page=settings">Open Settings</a>
</section>
<?php require __DIR__ . '/partials/footer.php'; ?>
