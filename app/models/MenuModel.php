<?php

declare(strict_types=1);

class MenuModel
{
    public static function byLocation(string $location): array
    {
        $db = Database::connection();
        $stmt = $db->prepare('SELECT * FROM menus WHERE location = ? AND is_enabled = 1 ORDER BY sort_order ASC');
        $stmt->execute([$location]);
        return $stmt->fetchAll();
    }

    public static function all(): array
    {
        $db = Database::connection();
        $stmt = $db->query('SELECT * FROM menus ORDER BY location, sort_order');
        return $stmt->fetchAll();
    }

    public static function upsert(array $menu): void
    {
        $db = Database::connection();
        if (!empty($menu['id'])) {
            $stmt = $db->prepare('UPDATE menus SET label = ?, url = ?, location = ?, sort_order = ?, is_enabled = ? WHERE id = ?');
            $stmt->execute([
                $menu['label'],
                $menu['url'],
                $menu['location'],
                (int) $menu['sort_order'],
                (int) $menu['is_enabled'],
                (int) $menu['id'],
            ]);
            return;
        }

        $stmt = $db->prepare('INSERT INTO menus (label, url, location, sort_order, is_enabled) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $menu['label'],
            $menu['url'],
            $menu['location'],
            (int) $menu['sort_order'],
            (int) $menu['is_enabled'],
        ]);
    }

    public static function delete(int $id): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('DELETE FROM menus WHERE id = ?');
        $stmt->execute([$id]);
    }
}
