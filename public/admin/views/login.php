<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="/<?= ADMIN_DIR ?>/assets/css/admin.css">
</head>
<body class="login-page">
    <form class="login-card" method="post">
        <h1>Admin Login</h1>
        <?php if ($error): ?>
            <p class="error"><?= e($error) ?></p>
        <?php endif; ?>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
        <p class="hint">Default login is set in the SQL seed.</p>
    </form>
</body>
</html>
