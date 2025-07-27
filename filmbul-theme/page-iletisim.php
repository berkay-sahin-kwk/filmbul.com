<?php
/**
 * Template Name: İletişim Sayfası
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="page-header">
        <h1 class="page-title">İletişim</h1>
        <p class="page-subtitle">Bizimle iletişime geçin, sorularınızı yanıtlayalım</p>
    </div>

    <div class="contact-content">
        <div class="contact-grid">
            <div class="contact-info">
                <h2>📞 İletişim Bilgileri</h2>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="contact-details">
                        <h3>E-posta</h3>
                        <p><a href="mailto:info@filmbul.com">info@filmbul.com</a></p>
                        <p><a href="mailto:destek@filmbul.com">destek@filmbul.com</a></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone" aria-hidden="true"></i>
                    </div>
                    <div class="contact-details">
                        <h3>Telefon</h3>
                        <p><a href="tel:+902121234567">+90 (212) 123 45 67</a></p>
                        <p class="contact-note">Pazartesi - Cuma: 09:00 - 18:00</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    </div>
                    <div class="contact-details">
                        <h3>Adres</h3>
                        <p>FilmBul Teknoloji A.Ş.<br>
                        Maslak Mahallesi<br>
                        Teknoloji Caddesi No: 123<br>
                        34485 Sarıyer / İstanbul</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-clock" aria-hidden="true"></i>
                    </div>
                    <div class="contact-details">
                        <h3>Çalışma Saatleri</h3>
                        <p>Pazartesi - Cuma: 09:00 - 18:00<br>
                        Cumartesi: 10:00 - 16:00<br>
                        Pazar: Kapalı</p>
                    </div>
                </div>

                <?php if (get_theme_mod('filmbul_facebook_url') || get_theme_mod('filmbul_twitter_url') || get_theme_mod('filmbul_instagram_url') || get_theme_mod('filmbul_youtube_url') || get_theme_mod('filmbul_linkedin_url')) : ?>
                <div class="social-media-contact">
                    <h3>🌐 Sosyal Medyada Takip Edin</h3>
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

            <div class="contact-form-section">
                <h2>✉️ Bize Mesaj Gönderin</h2>
                
                <form class="contact-form" id="contact-form" method="post" action="">
                    <?php wp_nonce_field('filmbul_contact_form', 'contact_nonce'); ?>
                    
                    <div class="form-group">
                        <label for="contact-name">Ad Soyad *</label>
                        <input type="text" 
                               id="contact-name" 
                               name="contact_name" 
                               required 
                               aria-describedby="name-help">
                        <div id="name-help" class="form-help">Lütfen tam adınızı girin</div>
                    </div>

                    <div class="form-group">
                        <label for="contact-email">E-posta *</label>
                        <input type="email" 
                               id="contact-email" 
                               name="contact_email" 
                               required 
                               aria-describedby="email-help">
                        <div id="email-help" class="form-help">Size geri dönüş yapabilmemiz için gerekli</div>
                    </div>

                    <div class="form-group">
                        <label for="contact-phone">Telefon</label>
                        <input type="tel" 
                               id="contact-phone" 
                               name="contact_phone" 
                               aria-describedby="phone-help">
                        <div id="phone-help" class="form-help">Opsiyonel - Hızlı iletişim için</div>
                    </div>

                    <div class="form-group">
                        <label for="contact-subject">Konu *</label>
                        <select id="contact-subject" 
                                name="contact_subject" 
                                required 
                                aria-describedby="subject-help">
                            <option value="">Konu seçin</option>
                            <option value="genel">Genel Bilgi</option>
                            <option value="teknik">Teknik Destek</option>
                            <option value="oneri">Öneri/İstek</option>
                            <option value="sikayet">Şikayet</option>
                            <option value="isbirligi">İşbirliği</option>
                            <option value="diger">Diğer</option>
                        </select>
                        <div id="subject-help" class="form-help">Mesajınızın konusunu seçin</div>
                    </div>

                    <div class="form-group">
                        <label for="contact-message">Mesaj *</label>
                        <textarea id="contact-message" 
                                  name="contact_message" 
                                  rows="6" 
                                  required 
                                  aria-describedby="message-help"
                                  maxlength="1000"></textarea>
                        <div id="message-help" class="form-help">Maksimum 1000 karakter</div>
                        <div class="character-count">
                            <span id="char-count">0</span>/1000
                        </div>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" 
                                   id="contact-privacy" 
                                   name="contact_privacy" 
                                   required>
                            <span class="checkmark"></span>
                            <a href="<?php echo esc_url(home_url('/gizlilik-politikasi/')); ?>" target="_blank">Gizlilik Politikası</a>'nı okudum ve kabul ediyorum *
                        </label>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" 
                                   id="contact-newsletter" 
                                   name="contact_newsletter">
                            <span class="checkmark"></span>
                            E-posta bültenine abone olmak istiyorum
                        </label>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="submit-button">
                            <i class="fas fa-paper-plane" aria-hidden="true"></i>
                            Mesaj Gönder
                        </button>
                        <button type="reset" class="reset-button">
                            <i class="fas fa-undo" aria-hidden="true"></i>
                            Temizle
                        </button>
                    </div>

                    <div class="form-status" id="form-status" role="alert" aria-live="polite"></div>
                </form>
            </div>
        </div>

        <!-- FAQ Section -->
        <section class="contact-faq">
            <h2>❓ Sık Sorulan Sorular</h2>
            <div class="faq-list">
                <?php
                $contact_faqs = array(
                    array(
                        'question' => 'Mesajıma ne kadar sürede yanıt alırım?',
                        'answer' => 'Genellikle 24 saat içinde size geri dönüş yapıyoruz. Acil durumlar için telefon numaramızı arayabilirsiniz.'
                    ),
                    array(
                        'question' => 'Teknik sorunlar için nasıl destek alabilirim?',
                        'answer' => 'Teknik sorunlar için yukarıdaki formda "Teknik Destek" konusunu seçerek detaylı açıklama yapabilirsiniz. Ekran görüntüsü eklerseniz daha hızlı çözüm bulabiliriz.'
                    ),
                    array(
                        'question' => 'Film/dizi önerisi nasıl yapabilirim?',
                        'answer' => 'AI asistanımızı kullanarak anında öneri alabilir veya "Öneri/İstek" konusuyla bize yazabilirsiniz.'
                    ),
                    array(
                        'question' => 'İşbirliği teklifleri için kimle görüşmeliyim?',
                        'answer' => 'İşbirliği tekliflerinizi "İşbirliği" konusuyla gönderebilirsiniz. Uygun teklifler için size geri dönüş yapacağız.'
                    )
                );
                
                foreach ($contact_faqs as $index => $faq) :
                ?>
                <div class="faq-item">
                    <div class="faq-question" 
                         role="button" 
                         tabindex="0" 
                         aria-expanded="false"
                         aria-controls="contact-faq-answer-<?php echo $index; ?>">
                        <span><?php echo esc_html($faq['question']); ?></span>
                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </div>
                    <div class="faq-answer" 
                         id="contact-faq-answer-<?php echo $index; ?>"
                         role="region">
                        <p><?php echo esc_html($faq['answer']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- AI Assistant Promotion -->
        <?php if (get_theme_mod('filmbul_ai_assistant_enabled', true)) : ?>
        <section class="ai-contact-promo">
            <div class="ai-promo-content">
                <div class="ai-promo-icon">
                    <i class="fas fa-robot" aria-hidden="true"></i>
                </div>
                <div class="ai-promo-text">
                    <h3>🤖 Hızlı Yardım İçin AI Asistanı</h3>
                    <p>Basit sorularınız için AI asistanımızla anında sohbet edebilirsiniz. 7/24 aktif!</p>
                    <button class="ai-promo-button" onclick="document.querySelector('.ai-toggle').click()">
                        AI Asistan ile Sohbet Et
                    </button>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </div>
</main>

<style>
/* Contact Page Styles */
.contact-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 3rem;
    margin-bottom: 4rem;
}

.contact-info {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    height: fit-content;
}

.contact-info h2 {
    color: #667eea;
    margin-bottom: 2rem;
    font-size: 1.8rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #eee;
}

.contact-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.contact-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.contact-icon i {
    color: white;
    font-size: 1.2rem;
}

.contact-details h3 {
    color: #333;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.contact-details p {
    color: #666;
    margin-bottom: 0.5rem;
    line-height: 1.6;
}

.contact-details a {
    color: #667eea;
    text-decoration: none;
    transition: color 0.2s ease;
}

.contact-details a:hover {
    color: #764ba2;
}

.contact-note {
    font-size: 0.9rem;
    font-style: italic;
    color: #999 !important;
}

.social-media-contact {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #eee;
}

.social-media-contact h3 {
    color: #333;
    margin-bottom: 1rem;
}

.social-links {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.contact-form-section {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.contact-form-section h2 {
    color: #667eea;
    margin-bottom: 2rem;
    font-size: 1.8rem;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 0.8rem;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.2s ease;
    background: #fafafa;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-help {
    font-size: 0.8rem;
    color: #666;
    margin-top: 0.3rem;
}

.character-count {
    text-align: right;
    font-size: 0.8rem;
    color: #999;
    margin-top: 0.3rem;
}

.checkbox-group {
    flex-direction: row;
    align-items: flex-start;
    gap: 0.5rem;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    cursor: pointer;
    font-size: 0.9rem;
    line-height: 1.4;
}

.checkbox-label input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #e0e0e0;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    flex-shrink: 0;
    margin-top: 2px;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark {
    background: #667eea;
    border-color: #667eea;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark::after {
    content: '✓';
    color: white;
    font-size: 0.8rem;
    font-weight: bold;
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.submit-button,
.reset-button {
    padding: 1rem 2rem;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.submit-button {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    flex: 1;
}

.submit-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.reset-button {
    background: #f0f0f0;
    color: #666;
}

.reset-button:hover {
    background: #e0e0e0;
}

.form-status {
    padding: 1rem;
    border-radius: 8px;
    margin-top: 1rem;
    display: none;
}

.form-status.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    display: block;
}

.form-status.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    display: block;
}

.contact-faq {
    margin-bottom: 4rem;
}

.contact-faq h2 {
    text-align: center;
    color: #333;
    margin-bottom: 2rem;
    font-size: 2rem;
}

.ai-contact-promo {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 2rem;
}

.ai-promo-content {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.ai-promo-icon {
    font-size: 3rem;
    opacity: 0.8;
}

.ai-promo-text {
    flex: 1;
}

.ai-promo-text h3 {
    margin-bottom: 0.5rem;
    font-size: 1.3rem;
}

.ai-promo-text p {
    margin-bottom: 1rem;
    opacity: 0.9;
}

.ai-promo-button {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 2px solid rgba(255,255,255,0.3);
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.ai-promo-button:hover {
    background: rgba(255,255,255,0.3);
    border-color: rgba(255,255,255,0.5);
}

@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .ai-promo-content {
        flex-direction: column;
        text-align: center;
    }
    
    .social-links {
        justify-content: center;
    }
}

/* Loading state */
.form-loading .submit-button {
    opacity: 0.7;
    cursor: not-allowed;
}

.form-loading .submit-button::after {
    content: '';
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 0.5rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const messageTextarea = document.getElementById('contact-message');
    const charCount = document.getElementById('char-count');
    const formStatus = document.getElementById('form-status');
    
    // Character counter
    messageTextarea.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count;
        
        if (count > 900) {
            charCount.style.color = '#dc3545';
        } else if (count > 800) {
            charCount.style.color = '#ffc107';
        } else {
            charCount.style.color = '#666';
        }
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Add loading state
        form.classList.add('form-loading');
        formStatus.style.display = 'none';
        
        // Simulate form submission (replace with actual AJAX call)
        setTimeout(function() {
            form.classList.remove('form-loading');
            
            // Show success message
            formStatus.className = 'form-status success';
            formStatus.textContent = 'Mesajınız başarıyla gönderildi! En kısa sürede size geri dönüş yapacağız.';
            formStatus.style.display = 'block';
            
            // Reset form
            form.reset();
            charCount.textContent = '0';
            
            // Scroll to status message
            formStatus.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
        }, 2000);
    });
    
    // Form validation
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.style.borderColor = '#dc3545';
            } else {
                this.style.borderColor = '#28a745';
            }
        });
        
        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.style.borderColor = '#28a745';
            }
        });
    });
    
    // Email validation
    const emailField = document.getElementById('contact-email');
    emailField.addEventListener('blur', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value && !emailRegex.test(this.value)) {
            this.style.borderColor = '#dc3545';
        } else if (this.value) {
            this.style.borderColor = '#28a745';
        }
    });
});
</script>

<?php
// Handle form submission
if ($_POST && wp_verify_nonce($_POST['contact_nonce'], 'filmbul_contact_form')) {
    $name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['contact_email']);
    $phone = sanitize_text_field($_POST['contact_phone']);
    $subject = sanitize_text_field($_POST['contact_subject']);
    $message = sanitize_textarea_field($_POST['contact_message']);
    $privacy = isset($_POST['contact_privacy']);
    $newsletter = isset($_POST['contact_newsletter']);
    
    if ($name && $email && $subject && $message && $privacy) {
        // Send email (implement your email sending logic here)
        $to = get_option('admin_email');
        $email_subject = 'FilmBul İletişim Formu: ' . $subject;
        $email_message = "Ad Soyad: $name\n";
        $email_message .= "E-posta: $email\n";
        $email_message .= "Telefon: $phone\n";
        $email_message .= "Konu: $subject\n\n";
        $email_message .= "Mesaj:\n$message\n\n";
        $email_message .= "Bülten: " . ($newsletter ? 'Evet' : 'Hayır');
        
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        
        if (wp_mail($to, $email_subject, $email_message, $headers)) {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    const formStatus = document.getElementById("form-status");
                    formStatus.className = "form-status success";
                    formStatus.textContent = "Mesajınız başarıyla gönderildi!";
                    formStatus.style.display = "block";
                });
            </script>';
        }
    }
}

get_footer();
?>