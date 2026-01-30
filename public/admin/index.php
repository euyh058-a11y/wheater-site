<?php

declare(strict_types=1);

session_start();
require_once __DIR__ . '/../../app/bootstrap.php';

$page = $_GET['page'] ?? 'dashboard';

if ($page === 'logout') {
    Auth::logout();
    redirect('/' . ADMIN_DIR . '/?page=login');
}

if (!Auth::check() && $page !== 'login') {
    redirect('/' . ADMIN_DIR . '/?page=login');
}

$settings = SettingsModel::all();

if ($page === 'login') {
    $error = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        if (Auth::attempt($email, $password)) {
            redirect('/' . ADMIN_DIR . '/');
        }
        $error = 'Invalid credentials.';
    }
    require __DIR__ . '/views/login.php';
    exit;
}

switch ($page) {
    case 'settings':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            SettingsModel::update([
                'site_name' => $_POST['site_name'] ?? '',
                'site_tagline' => $_POST['site_tagline'] ?? '',
                'site_logo' => $_POST['site_logo'] ?? '',
                'footer_logo' => $_POST['footer_logo'] ?? '',
                'hero_title' => $_POST['hero_title'] ?? '',
                'hero_subtitle' => $_POST['hero_subtitle'] ?? '',
                'header_enabled' => isset($_POST['header_enabled']) ? '1' : '0',
                'footer_enabled' => isset($_POST['footer_enabled']) ? '1' : '0',
                'footer_text' => $_POST['footer_text'] ?? '',
                'copyright_text' => $_POST['copyright_text'] ?? '',
                'social_facebook' => $_POST['social_facebook'] ?? '',
                'social_twitter' => $_POST['social_twitter'] ?? '',
                'social_instagram' => $_POST['social_instagram'] ?? '',
                'featured_countries' => $_POST['featured_countries'] ?? '',
                'weather_api_key' => $_POST['weather_api_key'] ?? '',
                'weather_api_url' => $_POST['weather_api_url'] ?? '',
                'weather_cache_ttl' => $_POST['weather_cache_ttl'] ?? '900',
            ]);
            redirect('/' . ADMIN_DIR . '/?page=settings');
        }
        require __DIR__ . '/views/settings.php';
        break;
    case 'menus':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['delete_id'])) {
                MenuModel::delete((int) $_POST['delete_id']);
            } else {
                MenuModel::upsert([
                    'id' => $_POST['id'] ?? null,
                    'label' => $_POST['label'] ?? '',
                    'url' => $_POST['url'] ?? '',
                    'location' => $_POST['location'] ?? 'header',
                    'sort_order' => $_POST['sort_order'] ?? 0,
                    'is_enabled' => isset($_POST['is_enabled']) ? 1 : 0,
                ]);
            }
            redirect('/' . ADMIN_DIR . '/?page=menus');
        }
        $menus = MenuModel::all();
        require __DIR__ . '/views/menus.php';
        break;
    case 'pages':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['delete_id'])) {
                PageModel::delete((int) $_POST['delete_id']);
            } else {
                PageModel::create([
                    'title' => $_POST['title'] ?? '',
                    'slug' => $_POST['slug'] ?? '',
                    'body' => $_POST['body'] ?? '',
                    'meta_title' => $_POST['meta_title'] ?? '',
                    'meta_description' => $_POST['meta_description'] ?? '',
                    'show_header' => isset($_POST['show_header']) ? 1 : 0,
                    'show_footer' => isset($_POST['show_footer']) ? 1 : 0,
                ]);
            }
            redirect('/' . ADMIN_DIR . '/?page=pages');
        }
        $pages = PageModel::all();
        require __DIR__ . '/views/pages.php';
        break;
    case 'articles':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['delete_id'])) {
                ArticleModel::delete((int) $_POST['delete_id']);
            } else {
                ArticleModel::create([
                    'title' => $_POST['title'] ?? '',
                    'slug' => $_POST['slug'] ?? '',
                    'body' => $_POST['body'] ?? '',
                    'featured_image' => $_POST['featured_image'] ?? '',
                    'category_id' => $_POST['category_id'] ?? null,
                    'is_published' => isset($_POST['is_published']) ? 1 : 0,
                    'show_on_home' => isset($_POST['show_on_home']) ? 1 : 0,
                    'meta_title' => $_POST['meta_title'] ?? '',
                    'meta_description' => $_POST['meta_description'] ?? '',
                ]);
            }
            redirect('/' . ADMIN_DIR . '/?page=articles');
        }
        $articles = ArticleModel::all();
        require __DIR__ . '/views/articles.php';
        break;
    case 'ads':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            AdsModel::upsert([
                'id' => $_POST['id'] ?? null,
                'location' => $_POST['location'] ?? 'header',
                'code' => $_POST['code'] ?? '',
                'is_enabled' => isset($_POST['is_enabled']) ? 1 : 0,
            ]);
            redirect('/' . ADMIN_DIR . '/?page=ads');
        }
        $ads = AdsModel::all();
        require __DIR__ . '/views/ads.php';
        break;
    case 'media':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['delete_id'])) {
                MediaModel::delete((int) $_POST['delete_id']);
                redirect('/' . ADMIN_DIR . '/?page=media');
            }
            if (!empty($_FILES['media_file']['name'])) {
                $file = $_FILES['media_file'];
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $fileName = uniqid('media_', true) . '.' . $extension;
                $destination = __DIR__ . '/../uploads/' . $fileName;
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    MediaModel::create($fileName, $file['name']);
                }
                redirect('/' . ADMIN_DIR . '/?page=media');
            }
        }
        $media = MediaModel::all();
        require __DIR__ . '/views/media.php';
        break;
    default:
        $stats = [
            'articles' => count(ArticleModel::all()),
            'media' => count(MediaModel::all()),
            'ads' => count(AdsModel::all()),
        ];
        require __DIR__ . '/views/dashboard.php';
        break;
}
