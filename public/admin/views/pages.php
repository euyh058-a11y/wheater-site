<?php require __DIR__ . '/partials/header.php'; ?>
<h1>Pages Manager</h1>
<form method="post" class="form-grid">
    <div>
        <label>Title</label>
        <input type="text" name="title" required>
    </div>
    <div>
        <label>Slug</label>
        <input type="text" name="slug" required>
    </div>
    <div>
        <label>Meta Title</label>
        <input type="text" name="meta_title">
    </div>
    <div>
        <label>Meta Description</label>
        <textarea name="meta_description" rows="2"></textarea>
    </div>
    <div class="full">
        <label>Body</label>
        <textarea name="body" rows="6"></textarea>
    </div>
    <div class="inline">
        <label><input type="checkbox" name="show_header" checked> Show Header</label>
    </div>
    <div class="inline">
        <label><input type="checkbox" name="show_footer" checked> Show Footer</label>
    </div>
    <button type="submit">Save Page</button>
</form>

<table class="data-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pages as $page): ?>
            <tr>
                <td><?= e($page['title']) ?></td>
                <td><?= e($page['slug']) ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="delete_id" value="<?= e((string) $page['id']) ?>">
                        <button type="submit" class="danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/partials/footer.php'; ?>
