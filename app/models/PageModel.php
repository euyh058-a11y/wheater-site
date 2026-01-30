<?php

declare(strict_types=1);

class PageModel
{
    public static function all(): array
    {
        $db = Database::connection();
        $stmt = $db->query('SELECT * FROM pages ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public static function findBySlug(string $slug): ?array
    {
        $db = Database::connection();
        $stmt = $db->prepare('SELECT * FROM pages WHERE slug = ? LIMIT 1');
        $stmt->execute([$slug]);
        $page = $stmt->fetch();
        return $page ?: null;
    }

    public static function create(array $data): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO pages (title, slug, body, meta_title, meta_description, show_header, show_footer) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['body'],
            $data['meta_title'],
            $data['meta_description'],
            (int) $data['show_header'],
            (int) $data['show_footer'],
        ]);
    }

    public static function delete(int $id): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('DELETE FROM pages WHERE id = ?');
        $stmt->execute([$id]);
    }
}
