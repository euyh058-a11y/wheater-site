<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FMREI Admin Panel</title>
    <link rel="stylesheet" href="/<?= ADMIN_DIR ?>/assets/css/admin.css">
</head>
<body>
<div class="admin-layout">
    <aside class="sidebar">
        <div class="brand">FMREI Admin</div>
        <nav>
            <a href="/<?= ADMIN_DIR ?>/?page=dashboard">Dashboard</a>
            <a href="/<?= ADMIN_DIR ?>/?page=settings">Settings</a>
            <a href="/<?= ADMIN_DIR ?>/?page=pages">Pages</a>
            <a href="/<?= ADMIN_DIR ?>/?page=articles">Articles</a>
            <a href="/<?= ADMIN_DIR ?>/?page=media">Media</a>
            <a href="/<?= ADMIN_DIR ?>/?page=ads">Ads</a>
            <a href="/<?= ADMIN_DIR ?>/?page=menus">Menus</a>
            <a href="/<?= ADMIN_DIR ?>/?page=logout">Logout</a>
        </nav>
    </aside>
    <main class="content">
