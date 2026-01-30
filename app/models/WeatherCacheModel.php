<?php

declare(strict_types=1);

class WeatherCacheModel
{
    public static function get(string $cacheKey): ?array
    {
        $db = Database::connection();
        $stmt = $db->prepare('SELECT payload, expires_at FROM weather_cache WHERE cache_key = ? LIMIT 1');
        $stmt->execute([$cacheKey]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        if (strtotime($row['expires_at']) < time()) {
            return null;
        }

        return json_decode($row['payload'], true);
    }

    public static function put(string $cacheKey, array $payload, int $ttlSeconds): void
    {
        $db = Database::connection();
        $expiresAt = date('Y-m-d H:i:s', time() + $ttlSeconds);
        $stmt = $db->prepare('INSERT INTO weather_cache (cache_key, payload, expires_at) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE payload = VALUES(payload), expires_at = VALUES(expires_at)');
        $stmt->execute([$cacheKey, json_encode($payload), $expiresAt]);
    }
}
