CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(190) NOT NULL UNIQUE,
    setting_value TEXT NOT NULL
);

CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(190) NOT NULL,
    slug VARCHAR(190) NOT NULL UNIQUE,
    body LONGTEXT,
    meta_title VARCHAR(190),
    meta_description TEXT,
    show_header TINYINT(1) DEFAULT 1,
    show_footer TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(190) NOT NULL,
    slug VARCHAR(190) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(190) NOT NULL,
    slug VARCHAR(190) NOT NULL UNIQUE,
    body LONGTEXT,
    featured_image VARCHAR(255),
    category_id INT NULL,
    is_published TINYINT(1) DEFAULT 1,
    show_on_home TINYINT(1) DEFAULT 1,
    meta_title VARCHAR(190),
    meta_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    original_name VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location VARCHAR(100) NOT NULL,
    code LONGTEXT,
    is_enabled TINYINT(1) DEFAULT 0
);

CREATE TABLE menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(190) NOT NULL,
    url VARCHAR(255) NOT NULL,
    location VARCHAR(100) NOT NULL,
    sort_order INT DEFAULT 0,
    is_enabled TINYINT(1) DEFAULT 1
);

CREATE TABLE weather_cache (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cache_key VARCHAR(64) NOT NULL UNIQUE,
    payload LONGTEXT NOT NULL,
    expires_at DATETIME NOT NULL
);

INSERT INTO admin_users (name, email, password_hash) VALUES
('Admin', 'admin@fmrei.space', '$2y$12$/Ytf9fznpBJG0QJfklfuCOcoCecWTSllchgr9zufyzxUpJGBgfe02');

INSERT INTO settings (setting_key, setting_value) VALUES
('site_name', 'FMREI Weather'),
('site_tagline', 'Premium weather intelligence platform'),
('site_logo', ''),
('footer_logo', ''),
('hero_title', 'Live Weather Intelligence'),
('hero_subtitle', 'Search any city worldwide to get real-time weather, hourly and daily forecasts.'),
('header_enabled', '1'),
('footer_enabled', '1'),
('footer_text', 'Global weather analytics and live forecasts.'),
('social_facebook', ''),
('social_twitter', ''),
('social_instagram', ''),
('copyright_text', '© 2024 FMREI Weather. All rights reserved.'),
('featured_countries', 'United States, United Kingdom, Pakistan, Saudi Arabia, United Arab Emirates'),
('weather_api_url', 'https://api.weatherapi.com/v1/forecast.json'),
('weather_api_key', '83561c5a4069c82e947aae0faf42f2d1'),
('weather_cache_ttl', '900');

INSERT INTO menus (label, url, location, sort_order, is_enabled) VALUES
('Home', '/', 'header', 1, 1),
('About', '/?page=about', 'header', 2, 1),
('Contact', '/?page=contact', 'header', 3, 1),
('Privacy', '/?page=privacy', 'footer', 1, 1),
('Terms', '/?page=terms', 'footer', 2, 1);

INSERT INTO categories (name, slug) VALUES
('Forecasting', 'forecasting'),
('Climate', 'climate');

INSERT INTO articles (title, slug, body, featured_image, category_id, is_published, show_on_home, meta_title, meta_description) VALUES
('Understanding the Monsoon Patterns', 'monsoon-patterns', 'Stay ahead with detailed insights on monsoon developments across regions.', '', 1, 1, 1, 'Monsoon Patterns', 'Detailed insights on monsoon developments.'),
('Preparing for Heatwaves', 'heatwave-preparedness', 'Expert guidance on staying safe during peak summer heatwaves.', '', 2, 1, 1, 'Heatwave Preparedness', 'Guidance on staying safe during heatwaves.');
