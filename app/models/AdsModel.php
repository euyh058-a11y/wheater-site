<?php

declare(strict_types=1);

class AdsModel
{
    public static function all(): array
    {
        $db = Database::connection();
        $stmt = $db->query('SELECT * FROM ads ORDER BY location');
        return $stmt->fetchAll();
    }

    public static function upsert(array $data): void
    {
        $db = Database::connection();
        if (!empty($data['id'])) {
            $stmt = $db->prepare('UPDATE ads SET location = ?, code = ?, is_enabled = ? WHERE id = ?');
            $stmt->execute([
                $data['location'],
                $data['code'],
                (int) $data['is_enabled'],
                (int) $data['id'],
            ]);
            return;
        }

        $stmt = $db->prepare('INSERT INTO ads (location, code, is_enabled) VALUES (?, ?, ?)');
        $stmt->execute([
            $data['location'],
            $data['code'],
            (int) $data['is_enabled'],
        ]);
    }

    public static function byLocation(string $location): ?array
    {
        $db = Database::connection();
        $stmt = $db->prepare('SELECT * FROM ads WHERE location = ? AND is_enabled = 1 LIMIT 1');
        $stmt->execute([$location]);
        $ad = $stmt->fetch();
        return $ad ?: null;
    }
}
