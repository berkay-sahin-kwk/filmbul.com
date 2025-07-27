<?php
/**
 * FilmBul Theme Functions
 * Version: 3.0
 */

// Theme setup
function filmbul_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'filmbul'),
        'footer' => __('Footer Menu', 'filmbul'),
    ));
    
    // Add image sizes
    add_image_size('film-thumbnail', 300, 450, true);
    add_image_size('blog-thumbnail', 400, 250, true);
}
add_action('after_setup_theme', 'filmbul_theme_setup');

// Enqueue scripts and styles
function filmbul_scripts() {
    wp_enqueue_style('filmbul-style', get_stylesheet_uri(), array(), '3.0');
    wp_enqueue_style('filmbul-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array('filmbul-style'), '3.0');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    wp_enqueue_script('filmbul-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '3.0', true);
    wp_enqueue_script('filmbul-theme', get_template_directory_uri() . '/assets/js/theme-test.js', array('jquery'), '3.0', true);
    
    // Localize script for AJAX
    wp_localize_script('filmbul-main', 'filmbul_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('filmbul_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'filmbul_scripts');

// Register widget areas
function filmbul_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'filmbul'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.', 'filmbul'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'filmbul'),
        'id' => 'footer-widgets',
        'description' => __('Footer widget area', 'filmbul'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'filmbul_widgets_init');

// Custom post types
function filmbul_custom_post_types() {
    // Film post type
    register_post_type('film', array(
        'labels' => array(
            'name' => 'Filmler',
            'singular_name' => 'Film',
            'add_new' => 'Yeni Film Ekle',
            'add_new_item' => 'Yeni Film Ekle',
            'edit_item' => 'Film Düzenle',
            'new_item' => 'Yeni Film',
            'view_item' => 'Film Görüntüle',
            'search_items' => 'Film Ara',
            'not_found' => 'Film bulunamadı',
            'not_found_in_trash' => 'Çöp kutusunda film bulunamadı'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-video-alt3',
        'rewrite' => array('slug' => 'film'),
    ));
    
    // Dizi post type
    register_post_type('dizi', array(
        'labels' => array(
            'name' => 'Diziler',
            'singular_name' => 'Dizi',
            'add_new' => 'Yeni Dizi Ekle',
            'add_new_item' => 'Yeni Dizi Ekle',
            'edit_item' => 'Dizi Düzenle',
            'new_item' => 'Yeni Dizi',
            'view_item' => 'Dizi Görüntüle',
            'search_items' => 'Dizi Ara',
            'not_found' => 'Dizi bulunamadı',
            'not_found_in_trash' => 'Çöp kutusunda dizi bulunamadı'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-playlist-video',
        'rewrite' => array('slug' => 'dizi'),
    ));
}
add_action('init', 'filmbul_custom_post_types');

// Custom taxonomies
function filmbul_custom_taxonomies() {
    // Film kategorileri
    register_taxonomy('film_kategori', 'film', array(
        'labels' => array(
            'name' => 'Film Kategorileri',
            'singular_name' => 'Film Kategorisi',
            'search_items' => 'Kategori Ara',
            'all_items' => 'Tüm Kategoriler',
            'parent_item' => 'Üst Kategori',
            'parent_item_colon' => 'Üst Kategori:',
            'edit_item' => 'Kategori Düzenle',
            'update_item' => 'Kategori Güncelle',
            'add_new_item' => 'Yeni Kategori Ekle',
            'new_item_name' => 'Yeni Kategori Adı',
            'menu_name' => 'Kategoriler',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'film-kategori'),
    ));
    
    // Dizi kategorileri
    register_taxonomy('dizi_kategori', 'dizi', array(
        'labels' => array(
            'name' => 'Dizi Kategorileri',
            'singular_name' => 'Dizi Kategorisi',
            'search_items' => 'Kategori Ara',
            'all_items' => 'Tüm Kategoriler',
            'parent_item' => 'Üst Kategori',
            'parent_item_colon' => 'Üst Kategori:',
            'edit_item' => 'Kategori Düzenle',
            'update_item' => 'Kategori Güncelle',
            'add_new_item' => 'Yeni Kategori Ekle',
            'new_item_name' => 'Yeni Kategori Adı',
            'menu_name' => 'Kategoriler',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'dizi-kategori'),
    ));
}
add_action('init', 'filmbul_custom_taxonomies');

// Add default categories
function filmbul_add_default_categories() {
    $film_categories = array('Aksiyon', 'Komedi', 'Drama', 'Korku', 'Romantik', 'Bilim Kurgu', 'Gerilim', 'Animasyon');
    $dizi_categories = array('Aksiyon', 'Komedi', 'Drama', 'Korku', 'Romantik', 'Bilim Kurgu', 'Gerilim', 'Belgesel');
    
    foreach ($film_categories as $category) {
        if (!term_exists($category, 'film_kategori')) {
            wp_insert_term($category, 'film_kategori');
        }
    }
    
    foreach ($dizi_categories as $category) {
        if (!term_exists($category, 'dizi_kategori')) {
            wp_insert_term($category, 'dizi_kategori');
        }
    }
}
add_action('init', 'filmbul_add_default_categories');

// Custom meta boxes
function filmbul_add_meta_boxes() {
    add_meta_box(
        'film_details',
        'Film Detayları',
        'filmbul_film_details_callback',
        'film',
        'normal',
        'high'
    );
    
    add_meta_box(
        'dizi_details',
        'Dizi Detayları',
        'filmbul_dizi_details_callback',
        'dizi',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'filmbul_add_meta_boxes');

function filmbul_film_details_callback($post) {
    wp_nonce_field('filmbul_save_meta_box_data', 'filmbul_meta_box_nonce');
    
    $imdb_rating = get_post_meta($post->ID, '_imdb_rating', true);
    $release_year = get_post_meta($post->ID, '_release_year', true);
    $duration = get_post_meta($post->ID, '_duration', true);
    $director = get_post_meta($post->ID, '_director', true);
    $cast = get_post_meta($post->ID, '_cast', true);
    $trailer_url = get_post_meta($post->ID, '_trailer_url', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="imdb_rating">IMDB Puanı:</label></th>';
    echo '<td><input type="number" step="0.1" min="0" max="10" id="imdb_rating" name="imdb_rating" value="' . esc_attr($imdb_rating) . '" /></td></tr>';
    
    echo '<tr><th><label for="release_year">Çıkış Yılı:</label></th>';
    echo '<td><input type="number" min="1900" max="2030" id="release_year" name="release_year" value="' . esc_attr($release_year) . '" /></td></tr>';
    
    echo '<tr><th><label for="duration">Süre (dakika):</label></th>';
    echo '<td><input type="number" min="1" id="duration" name="duration" value="' . esc_attr($duration) . '" /></td></tr>';
    
    echo '<tr><th><label for="director">Yönetmen:</label></th>';
    echo '<td><input type="text" id="director" name="director" value="' . esc_attr($director) . '" /></td></tr>';
    
    echo '<tr><th><label for="cast">Oyuncular:</label></th>';
    echo '<td><textarea id="cast" name="cast" rows="3" cols="50">' . esc_textarea($cast) . '</textarea></td></tr>';
    
    echo '<tr><th><label for="trailer_url">Fragman URL:</label></th>';
    echo '<td><input type="url" id="trailer_url" name="trailer_url" value="' . esc_attr($trailer_url) . '" /></td></tr>';
    echo '</table>';
}

function filmbul_dizi_details_callback($post) {
    wp_nonce_field('filmbul_save_meta_box_data', 'filmbul_meta_box_nonce');
    
    $imdb_rating = get_post_meta($post->ID, '_imdb_rating', true);
    $start_year = get_post_meta($post->ID, '_start_year', true);
    $end_year = get_post_meta($post->ID, '_end_year', true);
    $seasons = get_post_meta($post->ID, '_seasons', true);
    $episodes = get_post_meta($post->ID, '_episodes', true);
    $creator = get_post_meta($post->ID, '_creator', true);
    $cast = get_post_meta($post->ID, '_cast', true);
    $trailer_url = get_post_meta($post->ID, '_trailer_url', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="imdb_rating">IMDB Puanı:</label></th>';
    echo '<td><input type="number" step="0.1" min="0" max="10" id="imdb_rating" name="imdb_rating" value="' . esc_attr($imdb_rating) . '" /></td></tr>';
    
    echo '<tr><th><label for="start_year">Başlangıç Yılı:</label></th>';
    echo '<td><input type="number" min="1900" max="2030" id="start_year" name="start_year" value="' . esc_attr($start_year) . '" /></td></tr>';
    
    echo '<tr><th><label for="end_year">Bitiş Yılı:</label></th>';
    echo '<td><input type="number" min="1900" max="2030" id="end_year" name="end_year" value="' . esc_attr($end_year) . '" placeholder="Devam ediyorsa boş bırakın" /></td></tr>';
    
    echo '<tr><th><label for="seasons">Sezon Sayısı:</label></th>';
    echo '<td><input type="number" min="1" id="seasons" name="seasons" value="' . esc_attr($seasons) . '" /></td></tr>';
    
    echo '<tr><th><label for="episodes">Toplam Bölüm:</label></th>';
    echo '<td><input type="number" min="1" id="episodes" name="episodes" value="' . esc_attr($episodes) . '" /></td></tr>';
    
    echo '<tr><th><label for="creator">Yaratıcı:</label></th>';
    echo '<td><input type="text" id="creator" name="creator" value="' . esc_attr($creator) . '" /></td></tr>';
    
    echo '<tr><th><label for="cast">Oyuncular:</label></th>';
    echo '<td><textarea id="cast" name="cast" rows="3" cols="50">' . esc_textarea($cast) . '</textarea></td></tr>';
    
    echo '<tr><th><label for="trailer_url">Fragman URL:</label></th>';
    echo '<td><input type="url" id="trailer_url" name="trailer_url" value="' . esc_attr($trailer_url) . '" /></td></tr>';
    echo '</table>';
}

// Save meta box data
function filmbul_save_meta_box_data($post_id) {
    if (!isset($_POST['filmbul_meta_box_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['filmbul_meta_box_nonce'], 'filmbul_save_meta_box_data')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array('imdb_rating', 'release_year', 'duration', 'director', 'cast', 'trailer_url', 
                   'start_year', 'end_year', 'seasons', 'episodes', 'creator');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'filmbul_save_meta_box_data');

// Theme customizer
function filmbul_customize_register($wp_customize) {
    // Social Media Section
    $wp_customize->add_section('filmbul_social_media', array(
        'title' => __('Sosyal Medya', 'filmbul'),
        'priority' => 30,
    ));
    
    $social_networks = array(
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'youtube' => 'YouTube',
        'linkedin' => 'LinkedIn'
    );
    
    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting('filmbul_' . $network . '_url', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('filmbul_' . $network . '_url', array(
            'label' => $label . ' URL',
            'section' => 'filmbul_social_media',
            'type' => 'url',
        ));
    }
    
    // AI Assistant Section
    $wp_customize->add_section('filmbul_ai_assistant', array(
        'title' => __('AI Asistan', 'filmbul'),
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('filmbul_ai_assistant_enabled', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('filmbul_ai_assistant_enabled', array(
        'label' => __('AI Asistan Etkin', 'filmbul'),
        'section' => 'filmbul_ai_assistant',
        'type' => 'checkbox',
    ));
    
    $wp_customize->add_setting('filmbul_ai_assistant_api_key', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('filmbul_ai_assistant_api_key', array(
        'label' => __('AI API Anahtarı', 'filmbul'),
        'section' => 'filmbul_ai_assistant',
        'type' => 'text',
    ));
}
add_action('customize_register', 'filmbul_customize_register');

// AJAX handlers
function filmbul_search_content() {
    check_ajax_referer('filmbul_nonce', 'nonce');
    
    $search_term = sanitize_text_field($_POST['search_term']);
    $content_type = sanitize_text_field($_POST['content_type']);
    
    $args = array(
        'post_type' => $content_type === 'all' ? array('film', 'dizi') : array($content_type),
        's' => $search_term,
        'posts_per_page' => 12,
        'post_status' => 'publish'
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'catalog-item');
        }
    } else {
        echo '<p class="no-results">Aradığınız kriterlere uygun içerik bulunamadı.</p>';
    }
    
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_filmbul_search_content', 'filmbul_search_content');
add_action('wp_ajax_nopriv_filmbul_search_content', 'filmbul_search_content');

// AI Assistant AJAX handler
function filmbul_ai_assistant_chat() {
    check_ajax_referer('filmbul_nonce', 'nonce');
    
    $message = sanitize_text_field($_POST['message']);
    $api_key = get_theme_mod('filmbul_ai_assistant_api_key', '');
    
    if (empty($api_key)) {
        wp_send_json_error('AI API anahtarı yapılandırılmamış.');
        return;
    }
    
    // Basit bir AI yanıt simülasyonu
    $responses = array(
        'merhaba' => 'Merhaba! Size nasıl yardımcı olabilirim? Film ve dizi önerileri için buradayım.',
        'film öner' => 'Size harika filmler önerebilirim! Hangi türde film arıyorsunuz? Aksiyon, komedi, drama?',
        'dizi öner' => 'Popüler dizilerimizden önerebilirim. Hangi tür dizi izlemeyi seviyorsunuz?',
        'aksiyon' => 'Aksiyon seviyorsanız şu filmleri önerebilirim: John Wick serisi, Mad Max: Fury Road, The Dark Knight.',
        'komedi' => 'Komedi için şunları önerebilirim: The Grand Budapest Hotel, Superbad, Anchorman.',
        'default' => 'İlginç bir soru! Film ve diziler hakkında daha spesifik sorular sorabilirsiniz.'
    );
    
    $message_lower = strtolower($message);
    $response = $responses['default'];
    
    foreach ($responses as $key => $value) {
        if ($key !== 'default' && strpos($message_lower, $key) !== false) {
            $response = $value;
            break;
        }
    }
    
    wp_send_json_success($response);
}
add_action('wp_ajax_filmbul_ai_assistant_chat', 'filmbul_ai_assistant_chat');
add_action('wp_ajax_nopriv_filmbul_ai_assistant_chat', 'filmbul_ai_assistant_chat');

// FAQ functionality
function filmbul_get_faqs() {
    $faqs = array(
        array(
            'question' => 'FilmBul nedir?',
            'answer' => 'FilmBul, film ve dizi severlerin buluşma noktasıdır. En güncel film ve dizi önerilerini, incelemelerini ve haberlerini bulabileceğiniz bir platformdur.'
        ),
        array(
            'question' => 'Nasıl film önerisi alabilirim?',
            'answer' => 'AI asistanımızı kullanarak kişiselleştirilmiş film önerileri alabilirsiniz. Ayrıca kategorilere göz atarak beğeninize uygun içerikleri keşfedebilirsiniz.'
        ),
        array(
            'question' => 'İçerikler ne sıklıkla güncellenir?',
            'answer' => 'İçeriklerimiz günlük olarak güncellenir. Yeni çıkan filmler, diziler ve haberler düzenli olarak sitemize eklenir.'
        ),
        array(
            'question' => 'Mobil uygulamanız var mı?',
            'answer' => 'Şu anda mobil uygulamamız bulunmamaktadır, ancak web sitemiz mobil cihazlarda mükemmel çalışacak şekilde optimize edilmiştir.'
        ),
        array(
            'question' => 'Nasıl iletişime geçebilirim?',
            'answer' => 'İletişim sayfamızdan bize ulaşabilir, sosyal medya hesaplarımızı takip edebilir veya AI asistanımızla sohbet edebilirsiniz.'
        )
    );
    
    return $faqs;
}

// Include additional files
require_once get_template_directory() . '/includes/admin-settings.php';
require_once get_template_directory() . '/includes/api-integration.php';
require_once get_template_directory() . '/includes/chatbot-integration.php';

// Remove blog section from home page
function filmbul_remove_blog_section() {
    // This will be handled in the template files
}

// Add custom body classes
function filmbul_body_classes($classes) {
    if (is_page_template('page-ai-assistant.php')) {
        $classes[] = 'ai-assistant-page';
    }
    
    if (get_theme_mod('filmbul_ai_assistant_enabled', true)) {
        $classes[] = 'ai-assistant-enabled';
    }
    
    return $classes;
}
add_filter('body_class', 'filmbul_body_classes');

// Fix page templates
function filmbul_fix_page_templates() {
    // Ensure page templates work correctly
    if (is_page()) {
        global $post;
        $template = get_post_meta($post->ID, '_wp_page_template', true);
        
        if ($template && $template !== 'default') {
            $template_file = get_template_directory() . '/' . $template;
            if (file_exists($template_file)) {
                include $template_file;
                exit;
            }
        }
    }
}
add_action('template_redirect', 'filmbul_fix_page_templates');
?>