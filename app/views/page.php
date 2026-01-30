<?php
$settings = $settings ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page['meta_title'] ?: $page['title']) ?></title>
    <meta name="description" content="<?= e($page['meta_description']) ?>">
    <link rel="stylesheet" href="<?= asset_url('css/styles.css') ?>">
</head>
<body>
<?php if ($showHeader): ?>
    <?php require __DIR__ . '/partials/header.php'; ?>
<?php endif; ?>
<main class="container page-content">
    <h2><?= e($page['title']) ?></h2>
    <div class="page-body"><?= $page['body']; ?></div>
</main>
<?php if ($showFooter): ?>
    <?php require __DIR__ . '/partials/footer.php'; ?>
<?php endif; ?>
</body>
</html>
