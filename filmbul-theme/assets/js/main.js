/**
 * FilmBul Theme Main JavaScript
 * Version: 3.0
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        initializeTheme();
        initializeAIAssistant();
        initializeFAQ();
        initializeSearch();
        initializeAnimations();
        initializeSocialMedia();
        initializeAccessibility();
    });

    // Theme Initialization
    function initializeTheme() {
        // Header scroll effect
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.site-header').addClass('scrolled');
            } else {
                $('.site-header').removeClass('scrolled');
            }
        });

        // Smooth scrolling for anchor links
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
            }
        });

        // Mobile menu toggle
        $('.mobile-menu-toggle').on('click', function() {
            $('.nav-menu').toggleClass('active');
            $(this).toggleClass('active');
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.main-navigation').length) {
                $('.nav-menu').removeClass('active');
                $('.mobile-menu-toggle').removeClass('active');
            }
        });

        // Lazy loading for images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    // AI Assistant
    function initializeAIAssistant() {
        const $aiToggle = $('.ai-toggle');
        const $aiWindow = $('.ai-chat-window');
        const $aiInput = $('.ai-chat-input input');
        const $aiSend = $('.ai-chat-input button');
        const $aiMessages = $('.ai-chat-messages');

        // Toggle AI window
        $aiToggle.on('click', function() {
            $aiWindow.toggleClass('active');
            if ($aiWindow.hasClass('active')) {
                $aiInput.focus();
                // Add welcome message if first time
                if ($aiMessages.children().length === 0) {
                    addAIMessage('Merhaba! Size nasıl yardımcı olabilirim? Film ve dizi önerileri için buradayım. 🎬');
                }
            }
        });

        // Send message
        function sendMessage() {
            const message = $aiInput.val().trim();
            if (message) {
                addUserMessage(message);
                $aiInput.val('');
                
                // Show typing indicator
                const $typing = $('<div class="ai-message typing">Yazıyor... <div class="loading"></div></div>');
                $aiMessages.append($typing);
                scrollToBottom();

                // Send to AI
                $.ajax({
                    url: filmbul_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'filmbul_ai_assistant_chat',
                        message: message,
                        nonce: filmbul_ajax.nonce
                    },
                    success: function(response) {
                        $typing.remove();
                        if (response.success) {
                            addAIMessage(response.data);
                        } else {
                            addAIMessage('Üzgünüm, şu anda bir sorun yaşıyorum. Lütfen daha sonra tekrar deneyin.');
                        }
                    },
                    error: function() {
                        $typing.remove();
                        addAIMessage('Bağlantı hatası. Lütfen internet bağlantınızı kontrol edin.');
                    }
                });
            }
        }

        $aiSend.on('click', sendMessage);
        $aiInput.on('keypress', function(e) {
            if (e.which === 13) {
                sendMessage();
            }
        });

        function addUserMessage(message) {
            const $message = $('<div class="user-message"></div>').text(message);
            $aiMessages.append($message);
            scrollToBottom();
        }

        function addAIMessage(message) {
            const $message = $('<div class="ai-message"></div>').html(message);
            $aiMessages.append($message);
            scrollToBottom();
        }

        function scrollToBottom() {
            $aiMessages.scrollTop($aiMessages[0].scrollHeight);
        }

        // Close AI window when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.ai-assistant').length) {
                $aiWindow.removeClass('active');
            }
        });

        // Keyboard shortcuts
        $(document).on('keydown', function(e) {
            // Alt + A to toggle AI assistant
            if (e.altKey && e.which === 65) {
                e.preventDefault();
                $aiToggle.click();
            }
            // Escape to close AI window
            if (e.which === 27 && $aiWindow.hasClass('active')) {
                $aiWindow.removeClass('active');
            }
        });
    }

    // FAQ Functionality
    function initializeFAQ() {
        $('.faq-question').on('click', function() {
            const $item = $(this).parent();
            const $answer = $item.find('.faq-answer');
            
            // Close other FAQ items
            $('.faq-item').not($item).removeClass('active');
            
            // Toggle current item
            $item.toggleClass('active');
            
            // Animate answer
            if ($item.hasClass('active')) {
                $answer.slideDown(300);
            } else {
                $answer.slideUp(300);
            }
        });

        // Keyboard navigation for FAQ
        $('.faq-question').on('keydown', function(e) {
            if (e.which === 13 || e.which === 32) {
                e.preventDefault();
                $(this).click();
            }
        });
    }

    // Search Functionality
    function initializeSearch() {
        const $searchForm = $('.search-form');
        const $searchInput = $searchForm.find('input');
        const $searchResults = $('.search-results');
        let searchTimeout;

        // Live search
        $searchInput.on('input', function() {
            const query = $(this).val().trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length >= 3) {
                searchTimeout = setTimeout(function() {
                    performSearch(query);
                }, 500);
            } else {
                $searchResults.empty().hide();
            }
        });

        // Search form submission
        $searchForm.on('submit', function(e) {
            e.preventDefault();
            const query = $searchInput.val().trim();
            if (query) {
                performSearch(query);
            }
        });

        function performSearch(query) {
            $searchResults.html('<div class="loading-search">Aranıyor...</div>').show();

            $.ajax({
                url: filmbul_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'filmbul_search_content',
                    search_term: query,
                    content_type: 'all',
                    nonce: filmbul_ajax.nonce
                },
                success: function(response) {
                    $searchResults.html(response);
                    initializeAnimations(); // Re-initialize animations for new content
                },
                error: function() {
                    $searchResults.html('<div class="search-error">Arama sırasında bir hata oluştu.</div>');
                }
            });
        }

        // Close search results when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-form, .search-results').length) {
                $searchResults.hide();
            }
        });
    }

    // Animations
    function initializeAnimations() {
        // Intersection Observer for animations
        if ('IntersectionObserver' in window) {
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                        animationObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observe elements for animation
            document.querySelectorAll('.content-card, .category-card, .faq-item').forEach(el => {
                animationObserver.observe(el);
            });
        }

        // Hover effects
        $('.content-card').hover(
            function() {
                $(this).addClass('hover-lift');
            },
            function() {
                $(this).removeClass('hover-lift');
            }
        );

        // Parallax effect for hero section
        $(window).scroll(function() {
            const scrolled = $(this).scrollTop();
            const parallax = $('.hero-section');
            const speed = scrolled * 0.5;
            
            parallax.css('transform', 'translateY(' + speed + 'px)');
        });

        // Stagger animation for grid items
        $('.content-grid .content-card').each(function(index) {
            $(this).css('animation-delay', (index * 0.1) + 's');
        });
    }

    // Social Media
    function initializeSocialMedia() {
        // Social media links with proper icons
        const socialIcons = {
            facebook: 'fab fa-facebook-f',
            twitter: 'fab fa-twitter',
            instagram: 'fab fa-instagram',
            youtube: 'fab fa-youtube',
            linkedin: 'fab fa-linkedin-in'
        };

        $('.social-link').each(function() {
            const platform = $(this).data('platform');
            if (socialIcons[platform]) {
                $(this).html('<i class="' + socialIcons[platform] + '" aria-hidden="true"></i>');
                $(this).attr('aria-label', platform.charAt(0).toUpperCase() + platform.slice(1) + ' sayfamızı ziyaret edin');
            }
        });

        // Social sharing
        $('.share-button').on('click', function(e) {
            e.preventDefault();
            const url = $(this).data('url') || window.location.href;
            const title = $(this).data('title') || document.title;
            const platform = $(this).data('platform');
            
            let shareUrl = '';
            
            switch(platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;
                    break;
                case 'linkedin':
                    shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
                    break;
            }
            
            if (shareUrl) {
                window.open(shareUrl, 'share', 'width=600,height=400');
            }
        });
    }

    // Accessibility
    function initializeAccessibility() {
        // Skip to content link
        $('body').prepend('<a href="#main-content" class="skip-link sr-only">Ana içeriğe geç</a>');
        
        $('.skip-link').on('focus', function() {
            $(this).removeClass('sr-only');
        }).on('blur', function() {
            $(this).addClass('sr-only');
        });

        // ARIA labels for interactive elements
        $('.search-form button').attr('aria-label', 'Ara');
        $('.ai-toggle').attr('aria-label', 'AI Asistan');
        $('.mobile-menu-toggle').attr('aria-label', 'Menüyü aç/kapat');

        // Focus management for modals
        $('.ai-chat-window').on('keydown', function(e) {
            if (e.which === 9) { // Tab key
                const focusableElements = $(this).find('input, button, [tabindex]:not([tabindex="-1"])');
                const firstElement = focusableElements.first();
                const lastElement = focusableElements.last();
                
                if (e.shiftKey && document.activeElement === firstElement[0]) {
                    e.preventDefault();
                    lastElement.focus();
                } else if (!e.shiftKey && document.activeElement === lastElement[0]) {
                    e.preventDefault();
                    firstElement.focus();
                }
            }
        });

        // Announce dynamic content changes
        function announceToScreenReader(message) {
            const announcement = $('<div class="sr-only" aria-live="polite"></div>').text(message);
            $('body').append(announcement);
            setTimeout(() => announcement.remove(), 1000);
        }

        // Use this function when content changes dynamically
        $(document).on('contentChanged', function(e, message) {
            announceToScreenReader(message);
        });
    }

    // Utility Functions
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    // Performance optimizations
    const debouncedResize = debounce(function() {
        // Handle resize events
        $(document).trigger('windowResized');
    }, 250);

    const throttledScroll = throttle(function() {
        // Handle scroll events
        $(document).trigger('windowScrolled');
    }, 16);

    $(window).on('resize', debouncedResize);
    $(window).on('scroll', throttledScroll);

    // Error handling
    window.addEventListener('error', function(e) {
        console.error('JavaScript Error:', e.error);
        // You could send this to an error tracking service
    });

    // Service Worker registration (if available)
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js')
                .then(function(registration) {
                    console.log('SW registered: ', registration);
                })
                .catch(function(registrationError) {
                    console.log('SW registration failed: ', registrationError);
                });
        });
    }

})(jQuery);

// Vanilla JavaScript for critical functionality
document.addEventListener('DOMContentLoaded', function() {
    // Critical CSS loading
    const criticalCSS = document.getElementById('critical-css');
    if (criticalCSS) {
        criticalCSS.onload = function() {
            this.media = 'all';
        };
    }

    // Preload important resources
    const preloadLinks = [
        { href: '/assets/css/responsive.css', as: 'style' },
        { href: '/assets/js/theme-test.js', as: 'script' }
    ];

    preloadLinks.forEach(link => {
        const preloadLink = document.createElement('link');
        preloadLink.rel = 'preload';
        preloadLink.href = link.href;
        preloadLink.as = link.as;
        document.head.appendChild(preloadLink);
    });
});