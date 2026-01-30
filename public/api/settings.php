<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';

header('Content-Type: application/json');

$settings = SettingsModel::all();
$headerMenu = MenuModel::byLocation('header');
$footerMenu = MenuModel::byLocation('footer');

$payload = [
    'settings' => $settings,
    'headerMenu' => $headerMenu,
    'footerMenu' => $footerMenu,
];

echo json_encode($payload);
