<?php
$settings = $settings ?? [];
$footerMenu = $footerMenu ?? [];
$showFooter = ($settings['footer_enabled'] ?? '1') === '1';
?>
<?php if ($showFooter): ?>
<footer class="site-footer">
    <div class="container footer-inner">
        <div class="footer-brand">
            <img src="<?= e($settings['footer_logo'] ?? asset_url('images/logo.svg')) ?>" alt="Footer logo" class="logo">
            <p id="footerText"><?= e($settings['footer_text'] ?? 'Global weather analytics and live forecasts.') ?></p>
        </div>
        <nav class="footer-nav">
            <ul>
                <?php foreach ($footerMenu as $item): ?>
                    <li><a href="<?= e($item['url']) ?>"><?= e($item['label']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <div class="footer-social">
            <a href="<?= e($settings['social_facebook'] ?? '#') ?>">Facebook</a>
            <a href="<?= e($settings['social_twitter'] ?? '#') ?>">Twitter</a>
            <a href="<?= e($settings['social_instagram'] ?? '#') ?>">Instagram</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p id="copyrightText"><?= e($settings['copyright_text'] ?? '© ' . date('Y') . ' FMREI Weather. All rights reserved.') ?></p>
    </div>
</footer>
<?php endif; ?>
