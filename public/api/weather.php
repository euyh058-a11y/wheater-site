<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';

header('Content-Type: application/json');

$settings = SettingsModel::all();
$apiKey = $settings['weather_api_key'] ?? '83561c5a4069c82e947aae0faf42f2d1';
$apiUrl = $settings['weather_api_url'] ?? 'https://api.weatherapi.com/v1/forecast.json';
$cacheTtl = (int) ($settings['weather_cache_ttl'] ?? 900);

$location = trim($_GET['q'] ?? '');
if ($location === '') {
    http_response_code(422);
    echo json_encode(['error' => 'Location is required.']);
    exit;
}

$cacheKey = md5(strtolower($location));
$cached = WeatherCacheModel::get($cacheKey);
if ($cached) {
    echo json_encode(['cached' => true, 'data' => $cached]);
    exit;
}

$query = http_build_query([
    'key' => $apiKey,
    'q' => $location,
    'days' => 7,
    'aqi' => 'no',
    'alerts' => 'no',
]);

$ch = curl_init($apiUrl . '?' . $query);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10,
]);
$response = curl_exec($ch);
$httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($response === false || $httpCode >= 400) {
    http_response_code(500);
    echo json_encode(['error' => 'Weather service unavailable.', 'details' => $curlError]);
    exit;
}

$data = json_decode($response, true);
if (!$data || isset($data['error'])) {
    http_response_code(502);
    echo json_encode(['error' => $data['error']['message'] ?? 'Invalid weather response.']);
    exit;
}

WeatherCacheModel::put($cacheKey, $data, $cacheTtl);

echo json_encode(['cached' => false, 'data' => $data]);
