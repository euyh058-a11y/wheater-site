<?php

declare(strict_types=1);

class MediaModel
{
    public static function all(): array
    {
        $db = Database::connection();
        $stmt = $db->query('SELECT * FROM media ORDER BY uploaded_at DESC');
        return $stmt->fetchAll();
    }

    public static function create(string $fileName, string $originalName): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO media (file_name, original_name) VALUES (?, ?)');
        $stmt->execute([$fileName, $originalName]);
    }

    public static function delete(int $id): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('DELETE FROM media WHERE id = ?');
        $stmt->execute([$id]);
    }
}
