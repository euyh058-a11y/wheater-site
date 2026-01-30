<?php require __DIR__ . '/partials/header.php'; ?>
<h1>Ads Manager</h1>
<form method="post" class="form-grid">
    <div>
        <label>Location</label>
        <select name="location">
            <option value="header">Header</option>
            <option value="footer">Footer</option>
            <option value="sidebar">Sidebar</option>
            <option value="in_content">In Content</option>
        </select>
    </div>
    <div class="full">
        <label>Ad Code</label>
        <textarea name="code" rows="4"></textarea>
    </div>
    <div class="inline">
        <label><input type="checkbox" name="is_enabled" checked> Enabled</label>
    </div>
    <button type="submit">Save Ad</button>
</form>

<table class="data-table">
    <thead>
        <tr>
            <th>Location</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ads as $ad): ?>
            <tr>
                <td><?= e($ad['location']) ?></td>
                <td><?= $ad['is_enabled'] ? 'Enabled' : 'Disabled' ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= e((string) $ad['id']) ?>">
                        <input type="hidden" name="location" value="<?= e($ad['location']) ?>">
                        <input type="hidden" name="code" value="<?= e($ad['code']) ?>">
                        <input type="hidden" name="is_enabled" value="<?= e((string) $ad['is_enabled']) ?>">
                        <button type="submit">Duplicate</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/partials/footer.php'; ?>
