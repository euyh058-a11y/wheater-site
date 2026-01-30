<?php require __DIR__ . '/partials/header.php'; ?>
<h1>Articles</h1>
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
        <label>Featured Image URL</label>
        <input type="text" name="featured_image">
    </div>
    <div>
        <label>Category ID</label>
        <input type="number" name="category_id">
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
        <label><input type="checkbox" name="is_published" checked> Publish</label>
    </div>
    <div class="inline">
        <label><input type="checkbox" name="show_on_home" checked> Show on Home</label>
    </div>
    <button type="submit">Save Article</button>
</form>

<table class="data-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= e($article['title']) ?></td>
                <td><?= e($article['category_name'] ?? 'Uncategorized') ?></td>
                <td><?= $article['is_published'] ? 'Published' : 'Draft' ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="delete_id" value="<?= e((string) $article['id']) ?>">
                        <button type="submit" class="danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/partials/footer.php'; ?>
