<?php

declare(strict_types=1);

class ArticleModel
{
    public static function allPublished(): array
    {
        $db = Database::connection();
        $stmt = $db->query('SELECT a.*, c.name AS category_name FROM articles a LEFT JOIN categories c ON a.category_id = c.id WHERE a.is_published = 1 ORDER BY a.created_at DESC');
        return $stmt->fetchAll();
    }

    public static function all(): array
    {
        $db = Database::connection();
        $stmt = $db->query('SELECT a.*, c.name AS category_name FROM articles a LEFT JOIN categories c ON a.category_id = c.id ORDER BY a.created_at DESC');
        return $stmt->fetchAll();
    }

    public static function create(array $data): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO articles (title, slug, body, featured_image, category_id, is_published, show_on_home, meta_title, meta_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['body'],
            $data['featured_image'],
            $data['category_id'],
            (int) $data['is_published'],
            (int) $data['show_on_home'],
            $data['meta_title'],
            $data['meta_description'],
        ]);
    }

    public static function delete(int $id): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('DELETE FROM articles WHERE id = ?');
        $stmt->execute([$id]);
    }
}
