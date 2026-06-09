/**
 * DevBrothers Admin Panel JavaScript
 *
 * @package DevBrothers_Admin_Panel
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // === Smooth anchor scroll ===
        $('.devbrothers-anchor-link').on('click', function(e) {
            e.preventDefault();

            var targetId = $(this).attr('href');
            var $target = $(targetId);

            if ($target.length) {
                $('.devbrothers-anchor-link').removeClass('active');
                $(this).addClass('active');

                $('html, body').animate({
                    scrollTop: $target.offset().top - 20
                }, 500);
            }
        });

        // === Highlight active anchor on scroll ===
        var $window  = $(window);
        var $anchors  = $('.devbrothers-anchor-link');
        var $sections = $('.devbrothers-settings-category');

        if ($sections.length && $anchors.length) {
            $window.on('scroll', function() {
                var scrollPosition = $window.scrollTop() + 100;

                $sections.each(function() {
                    var $section     = $(this);
                    var sectionTop    = $section.offset().top;
                    var sectionBottom = sectionTop + $section.outerHeight();
                    var sectionId     = $section.attr('id');

                    if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                        $anchors.removeClass('active');
                        $('a[href="#' + sectionId + '"]').addClass('active');
                    }
                });
            });
        }

        // === Card entrance animation (CSS transitions) ===
        (function animateCards() {
            var $cards = $('.devbrothers-plugin-card, .devbrothers-stat-card');

            $cards.each(function(index) {
                var el = this;
                el.style.opacity   = '0';
                el.style.transform = 'translateY(20px)';

                setTimeout(function() {
                    el.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    el.style.opacity    = '1';
                    el.style.transform  = 'translateY(0)';
                }, index * 50 + 10);
            });
        })();

        // === Delete confirmation ===
        $('.devbrothers-delete-button').on('click', function(e) {
            var confirmText = $(this).data('confirm') || 'Are you sure you want to perform this action?';
            if (!confirm(confirmText)) {
                e.preventDefault();
            }
        });

    });

})(jQuery);
