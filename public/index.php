<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

$settings = SettingsModel::all();
$headerMenu = MenuModel::byLocation('header');
$footerMenu = MenuModel::byLocation('footer');
$articles = array_filter(ArticleModel::allPublished(), fn ($article) => (int) $article['show_on_home'] === 1);
$media = MediaModel::all();

$ads = [];
foreach (AdsModel::all() as $ad) {
    $ads[$ad['location']] = $ad;
}

$slug = $_GET['page'] ?? null;
if ($slug) {
    $page = PageModel::findBySlug($slug);
    if ($page) {
        $showHeader = (int) $page['show_header'] === 1;
        $showFooter = (int) $page['show_footer'] === 1;
        require __DIR__ . '/../app/views/page.php';
        exit;
    }
}

require __DIR__ . '/../app/views/home.php';
