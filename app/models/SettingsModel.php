<?php

declare(strict_types=1);

class SettingsModel
{
    public static function all(): array
    {
        $db = Database::connection();
        $stmt = $db->query('SELECT setting_key, setting_value FROM settings');
        $settings = [];
        foreach ($stmt->fetchAll() as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }

    public static function update(array $values): void
    {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)');
        foreach ($values as $key => $value) {
            $stmt->execute([$key, $value]);
        }
    }
}
