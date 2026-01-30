<?php require __DIR__ . '/partials/header.php'; ?>
<h1>Navigation Manager</h1>
<form method="post" class="form-grid">
    <input type="hidden" name="id" value="">
    <div>
        <label>Label</label>
        <input type="text" name="label" required>
    </div>
    <div>
        <label>URL</label>
        <input type="text" name="url" required>
    </div>
    <div>
        <label>Location</label>
        <select name="location">
            <option value="header">Header</option>
            <option value="footer">Footer</option>
        </select>
    </div>
    <div>
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="0">
    </div>
    <div class="inline">
        <label><input type="checkbox" name="is_enabled" checked> Enabled</label>
    </div>
    <button type="submit">Save Menu</button>
</form>

<table class="data-table">
    <thead>
        <tr>
            <th>Label</th>
            <th>URL</th>
            <th>Location</th>
            <th>Order</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $menu): ?>
            <tr>
                <td><?= e($menu['label']) ?></td>
                <td><?= e($menu['url']) ?></td>
                <td><?= e($menu['location']) ?></td>
                <td><?= e((string) $menu['sort_order']) ?></td>
                <td><?= $menu['is_enabled'] ? 'Enabled' : 'Disabled' ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="delete_id" value="<?= e((string) $menu['id']) ?>">
                        <button type="submit" class="danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/partials/footer.php'; ?>
