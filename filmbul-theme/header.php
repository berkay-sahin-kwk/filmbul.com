<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Preload critical resources -->
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/css/responsive.css" as="style">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/js/main.js" as="script">
    
    <!-- DNS prefetch for external resources -->
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Ana içeriğe geç', 'filmbul'); ?></a>

    <header id="masthead" class="site-header">
        <div class="header-container">
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Ana menü">
                <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="sr-only">Menüyü aç/kapat</span>
                    <span class="menu-icon"></span>
                </button>
                
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'filmbul_default_menu',
                ));
                ?>
                
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <label for="search-field" class="sr-only">Ara</label>
                    <input type="search" 
                           id="search-field" 
                           class="search-field" 
                           placeholder="Film, dizi ara..." 
                           value="<?php echo get_search_query(); ?>" 
                           name="s" 
                           autocomplete="off"
                           aria-describedby="search-description">
                    <button type="submit" class="search-submit" aria-label="Ara">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                    <div id="search-description" class="sr-only">Film ve dizi arama</div>
                </form>
                
                <div class="search-results" role="region" aria-live="polite" aria-label="Arama sonuçları"></div>
            </nav>
        </div>
    </header>

    <?php
    // Default menu fallback
    function filmbul_default_menu() {
        echo '<ul class="nav-menu">';
        echo '<li><a href="' . esc_url(home_url('/')) . '">Ana Sayfa</a></li>';
        echo '<li><a href="' . esc_url(home_url('/katalog/')) . '">Katalog</a></li>';
        echo '<li><a href="' . esc_url(home_url('/kategoriler/')) . '">Kategoriler</a></li>';
        echo '<li><a href="' . esc_url(home_url('/ai-asistan/')) . '">AI Asistan</a></li>';
        echo '<li><a href="' . esc_url(home_url('/hakkinda/')) . '">Hakkında</a></li>';
        echo '<li><a href="' . esc_url(home_url('/iletisim/')) . '">İletişim</a></li>';
        echo '</ul>';
    }
    ?>

    <div id="content" class="site-content">