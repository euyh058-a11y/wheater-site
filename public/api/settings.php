<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';

header('Content-Type: application/json');

$settings = SettingsModel::all();
$publicKeys = [
    'site_name',
    'site_tagline',
    'site_logo',
    'footer_logo',
    'hero_title',
    'hero_subtitle',
    'header_enabled',
    'footer_enabled',
    'footer_text',
    'social_facebook',
    'social_twitter',
    'social_instagram',
    'copyright_text',
    'featured_countries',
];
$publicSettings = array_intersect_key($settings, array_flip($publicKeys));
$headerMenu = MenuModel::byLocation('header');
$footerMenu = MenuModel::byLocation('footer');

$payload = [
    'settings' => $publicSettings,
    'headerMenu' => $headerMenu,
    'footerMenu' => $footerMenu,
];

echo json_encode($payload);
