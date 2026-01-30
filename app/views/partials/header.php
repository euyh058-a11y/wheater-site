<?php
$settings = $settings ?? [];
$headerMenu = $headerMenu ?? [];
$showHeader = ($settings['header_enabled'] ?? '1') === '1';
?>
<?php if ($showHeader): ?>
<header class="site-header">
    <div class="container header-inner">
        <div class="logo-block">
            <img src="<?= e($settings['site_logo'] ?? asset_url('images/logo.svg')) ?>" alt="<?= e($settings['site_name'] ?? 'FMREI Weather') ?>" class="logo">
            <div>
                <h1 id="siteName"><?= e($settings['site_name'] ?? 'FMREI Weather') ?></h1>
                <p id="siteTagline"><?= e($settings['site_tagline'] ?? 'Premium weather intelligence platform') ?></p>
            </div>
        </div>
        <nav class="main-nav">
            <ul>
                <?php foreach ($headerMenu as $item): ?>
                    <li><a href="<?= e($item['url']) ?>"><?= e($item['label']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <div class="header-search">
            <input type="text" id="searchInput" placeholder="Search city or country">
            <button id="searchButton">Search</button>
        </div>
    </div>
</header>
<?php endif; ?>
