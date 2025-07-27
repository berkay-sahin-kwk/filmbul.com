</div><!-- #content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="footer-content">
            <div class="footer-section">
                <h3>FilmBul</h3>
                <p>Film ve dizi severlerin buluşma noktası. En güncel içerikler, AI destekli öneriler ve daha fazlası için bizi takip edin.</p>
                
                <?php if (get_theme_mod('filmbul_facebook_url') || get_theme_mod('filmbul_twitter_url') || get_theme_mod('filmbul_instagram_url') || get_theme_mod('filmbul_youtube_url') || get_theme_mod('filmbul_linkedin_url')) : ?>
                <div class="social-media">
                    <h4>🌐 Sosyal Medyada Takip Edin</h4>
                    <div class="social-links">
                        <?php if (get_theme_mod('filmbul_facebook_url')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('filmbul_facebook_url')); ?>" 
                               class="social-link facebook" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               aria-label="Facebook sayfamızı ziyaret edin">
                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('filmbul_twitter_url')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('filmbul_twitter_url')); ?>" 
                               class="social-link twitter" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               aria-label="Twitter sayfamızı ziyaret edin">
                                <i class="fab fa-twitter" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('filmbul_instagram_url')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('filmbul_instagram_url')); ?>" 
                               class="social-link instagram" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               aria-label="Instagram sayfamızı ziyaret edin">
                                <i class="fab fa-instagram" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('filmbul_youtube_url')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('filmbul_youtube_url')); ?>" 
                               class="social-link youtube" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               aria-label="YouTube kanalımızı ziyaret edin">
                                <i class="fab fa-youtube" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('filmbul_linkedin_url')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('filmbul_linkedin_url')); ?>" 
                               class="social-link linkedin" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               aria-label="LinkedIn sayfamızı ziyaret edin">
                                <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="footer-section">
                <h3>Hızlı Linkler</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'container'      => false,
                    'fallback_cb'    => 'filmbul_footer_menu_fallback',
                ));
                ?>
            </div>

            <div class="footer-section">
                <h3>Kategoriler</h3>
                <ul>
                    <?php
                    $film_categories = get_terms(array(
                        'taxonomy' => 'film_kategori',
                        'hide_empty' => false,
                        'number' => 5
                    ));
                    
                    if (!empty($film_categories) && !is_wp_error($film_categories)) {
                        foreach ($film_categories as $category) {
                            echo '<li><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="footer-section">
                <h3>SSS</h3>
                <div class="faq-list">
                    <?php
                    $faqs = filmbul_get_faqs();
                    $limited_faqs = array_slice($faqs, 0, 3); // İlk 3 SSS
                    
                    foreach ($limited_faqs as $index => $faq) :
                    ?>
                    <div class="faq-item">
                        <div class="faq-question" 
                             role="button" 
                             tabindex="0" 
                             aria-expanded="false"
                             aria-controls="faq-answer-<?php echo $index; ?>">
                            <span><?php echo esc_html($faq['question']); ?></span>
                            <i class="fas fa-chevron-down" aria-hidden="true"></i>
                        </div>
                        <div class="faq-answer" 
                             id="faq-answer-<?php echo $index; ?>"
                             role="region"
                             aria-labelledby="faq-question-<?php echo $index; ?>">
                            <p><?php echo esc_html($faq['answer']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?php echo esc_url(home_url('/sss/')); ?>" class="view-all-faq">Tüm SSS'leri Görüntüle</a>
            </div>

            <?php if (is_active_sidebar('footer-widgets')) : ?>
            <div class="footer-section">
                <?php dynamic_sidebar('footer-widgets'); ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tüm hakları saklıdır.</p>
            <p>
                <a href="<?php echo esc_url(home_url('/gizlilik-politikasi/')); ?>">Gizlilik Politikası</a> | 
                <a href="<?php echo esc_url(home_url('/kullanim-kosullari/')); ?>">Kullanım Koşulları</a>
            </p>
        </div>
    </footer>

    <?php if (get_theme_mod('filmbul_ai_assistant_enabled', true)) : ?>
    <!-- AI Assistant -->
    <div class="ai-assistant" role="complementary" aria-label="AI Asistan">
        <button class="ai-toggle" 
                aria-label="AI Asistan ile sohbet et"
                aria-expanded="false"
                aria-controls="ai-chat-window">
            <i class="fas fa-robot" aria-hidden="true"></i>
        </button>
        
        <div class="ai-chat-window" 
             id="ai-chat-window"
             role="dialog" 
             aria-labelledby="ai-chat-title"
             aria-hidden="true">
            <div class="ai-chat-header">
                <h3 id="ai-chat-title">AI Film Asistanı</h3>
                <p>Size nasıl yardımcı olabilirim?</p>
            </div>
            
            <div class="ai-chat-messages" 
                 role="log" 
                 aria-live="polite" 
                 aria-label="Sohbet mesajları">
                <!-- Messages will be added here dynamically -->
            </div>
            
            <div class="ai-chat-input">
                <label for="ai-message-input" class="sr-only">Mesajınızı yazın</label>
                <input type="text" 
                       id="ai-message-input"
                       placeholder="Mesajınızı yazın..." 
                       maxlength="500"
                       aria-describedby="ai-input-help">
                <button type="button" 
                        aria-label="Mesaj gönder">
                    <i class="fas fa-paper-plane" aria-hidden="true"></i>
                </button>
                <div id="ai-input-help" class="sr-only">Enter tuşuna basarak mesaj gönderebilirsiniz</div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div><!-- #page -->

<?php
// Footer menu fallback
function filmbul_footer_menu_fallback() {
    echo '<ul class="footer-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Ana Sayfa</a></li>';
    echo '<li><a href="' . esc_url(home_url('/katalog/')) . '">Katalog</a></li>';
    echo '<li><a href="' . esc_url(home_url('/hakkinda/')) . '">Hakkında</a></li>';
    echo '<li><a href="' . esc_url(home_url('/iletisim/')) . '">İletişim</a></li>';
    echo '<li><a href="' . esc_url(home_url('/gizlilik-politikasi/')) . '">Gizlilik</a></li>';
    echo '</ul>';
}
?>

<?php wp_footer(); ?>

<!-- Performance monitoring -->
<script>
// Basic performance monitoring
if ('performance' in window) {
    window.addEventListener('load', function() {
        setTimeout(function() {
            const perfData = performance.getEntriesByType('navigation')[0];
            if (perfData) {
                console.log('Page Load Time:', perfData.loadEventEnd - perfData.loadEventStart, 'ms');
            }
        }, 0);
    });
}

// Error tracking
window.addEventListener('error', function(e) {
    console.error('JavaScript Error:', {
        message: e.message,
        filename: e.filename,
        lineno: e.lineno,
        colno: e.colno,
        error: e.error
    });
});
</script>

</body>
</html>