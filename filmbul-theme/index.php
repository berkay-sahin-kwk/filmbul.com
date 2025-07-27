<?php
/**
 * The main template file
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>🎬 FilmBul'a Hoş Geldiniz</h1>
            <p>En güncel film ve dizi önerileri, AI destekli kişisel öneriler ve daha fazlası için doğru yerdesiniz!</p>
            <a href="<?php echo esc_url(home_url('/katalog/')); ?>" class="cta-button">
                Kataloğu Keşfet
            </a>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
        <h2>🎭 Kategoriler</h2>
        <div class="categories-grid">
            <?php
            $film_categories = get_terms(array(
                'taxonomy' => 'film_kategori',
                'hide_empty' => false,
                'number' => 8
            ));
            
            $category_icons = array(
                'Aksiyon' => 'fas fa-fist-raised',
                'Komedi' => 'fas fa-laugh',
                'Drama' => 'fas fa-theater-masks',
                'Korku' => 'fas fa-ghost',
                'Romantik' => 'fas fa-heart',
                'Bilim Kurgu' => 'fas fa-rocket',
                'Gerilim' => 'fas fa-eye',
                'Animasyon' => 'fas fa-palette'
            );
            
            if (!empty($film_categories) && !is_wp_error($film_categories)) :
                foreach ($film_categories as $category) :
                    $icon = isset($category_icons[$category->name]) ? $category_icons[$category->name] : 'fas fa-film';
            ?>
            <a href="<?php echo esc_url(get_term_link($category)); ?>" 
               class="category-card hover-scale"
               data-tooltip="<?php echo esc_attr($category->description ?: $category->name . ' kategorisindeki içerikleri görüntüle'); ?>">
                <i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
                <h3><?php echo esc_html($category->name); ?></h3>
                <span class="category-count"><?php echo $category->count; ?> içerik</span>
            </a>
            <?php 
                endforeach;
            else :
            ?>
            <p>Henüz kategori eklenmemiş.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Featured Content -->
    <section class="featured-content">
        <h2>⭐ Öne Çıkan İçerikler</h2>
        <div class="content-grid">
            <?php
            // Get featured films
            $featured_films = new WP_Query(array(
                'post_type' => array('film', 'dizi'),
                'posts_per_page' => 6,
                'meta_query' => array(
                    array(
                        'key' => '_featured',
                        'value' => '1',
                        'compare' => '='
                    )
                )
            ));
            
            if (!$featured_films->have_posts()) {
                // Fallback to recent posts if no featured content
                $featured_films = new WP_Query(array(
                    'post_type' => array('film', 'dizi'),
                    'posts_per_page' => 6,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
            }
            
            if ($featured_films->have_posts()) :
                while ($featured_films->have_posts()) : $featured_films->the_post();
                    get_template_part('template-parts/content', 'catalog-item');
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <div class="no-content">
                <p>Henüz içerik eklenmemiş. Yakında harika filmler ve dizilerle burada olacağız!</p>
                <a href="<?php echo admin_url('post-new.php?post_type=film'); ?>" class="cta-button">
                    İlk Filmi Ekle
                </a>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- AI Assistant Promotion -->
    <?php if (get_theme_mod('filmbul_ai_assistant_enabled', true)) : ?>
    <section class="ai-promotion">
        <div class="ai-promo-content">
            <div class="ai-promo-text">
                <h2>🤖 AI Film Asistanı</h2>
                <p>Kişiselleştirilmiş film ve dizi önerileri almak için AI asistanımızla sohbet edin. Size en uygun içerikleri bulmanıza yardımcı olalım!</p>
                <button class="cta-button ai-promo-button" onclick="document.querySelector('.ai-toggle').click()">
                    AI Asistan ile Sohbet Et
                </button>
            </div>
            <div class="ai-promo-visual">
                <i class="fas fa-robot" aria-hidden="true"></i>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Latest News/Blog -->
    <?php
    $blog_posts = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post_status' => 'publish'
    ));
    
    if ($blog_posts->have_posts()) :
    ?>
    <section class="latest-news">
        <h2>📰 Son Haberler</h2>
        <div class="content-grid">
            <?php
            while ($blog_posts->have_posts()) : $blog_posts->the_post();
                get_template_part('template-parts/content', 'blog-item');
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
        <div class="section-footer">
            <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="view-all-link">
                Tüm Haberleri Görüntüle <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </section>
    <?php endif; ?>

    <!-- Statistics -->
    <section class="site-stats">
        <h2>📊 İstatistikler</h2>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">
                    <?php
                    $film_count = wp_count_posts('film');
                    echo $film_count->publish;
                    ?>
                </div>
                <div class="stat-label">Film</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">
                    <?php
                    $dizi_count = wp_count_posts('dizi');
                    echo $dizi_count->publish;
                    ?>
                </div>
                <div class="stat-label">Dizi</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">
                    <?php
                    $category_count = wp_count_terms('film_kategori');
                    echo $category_count;
                    ?>
                </div>
                <div class="stat-label">Kategori</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">
                    <?php
                    $user_count = count_users();
                    echo $user_count['total_users'];
                    ?>
                </div>
                <div class="stat-label">Kullanıcı</div>
            </div>
        </div>
    </section>

</main>

<style>
/* Additional styles for index page */
.ai-promotion {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 2rem;
    border-radius: 15px;
    margin: 3rem 0;
}

.ai-promo-content {
    display: flex;
    align-items: center;
    gap: 2rem;
    max-width: 1000px;
    margin: 0 auto;
}

.ai-promo-text {
    flex: 1;
}

.ai-promo-text h2 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.ai-promo-text p {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.ai-promo-visual {
    flex: 0 0 200px;
    text-align: center;
}

.ai-promo-visual i {
    font-size: 8rem;
    opacity: 0.3;
    animation: pulse 2s infinite;
}

.ai-promo-button {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 2px solid rgba(255,255,255,0.3);
}

.ai-promo-button:hover {
    background: rgba(255,255,255,0.3);
    border-color: rgba(255,255,255,0.5);
}

.site-stats {
    text-align: center;
    margin: 3rem 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.stat-item {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 3rem;
    font-weight: bold;
    color: #667eea;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1.1rem;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.no-content {
    text-align: center;
    padding: 3rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.section-footer {
    text-align: center;
    margin-top: 2rem;
}

.view-all-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
}

.view-all-link:hover {
    color: #764ba2;
    transform: translateX(5px);
}

.category-count {
    font-size: 0.9rem;
    opacity: 0.8;
}

@media (max-width: 768px) {
    .ai-promo-content {
        flex-direction: column;
        text-align: center;
    }
    
    .ai-promo-visual {
        flex: none;
    }
    
    .ai-promo-visual i {
        font-size: 4rem;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

<?php
get_footer();
?>