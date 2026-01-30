<?php require __DIR__ . '/partials/header.php'; ?>
<h1>Media Library</h1>
<form method="post" enctype="multipart/form-data" class="form-grid">
    <div>
        <label>Upload Image</label>
        <input type="file" name="media_file" accept="image/*">
    </div>
    <button type="submit">Upload</button>
</form>

<div class="media-grid">
    <?php foreach ($media as $item): ?>
        <div class="media-card">
            <img src="/uploads/<?= e($item['file_name']) ?>" alt="<?= e($item['original_name']) ?>">
            <form method="post">
                <input type="hidden" name="delete_id" value="<?= e((string) $item['id']) ?>">
                <button type="submit" class="danger">Delete</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
<?php require __DIR__ . '/partials/footer.php'; ?>
