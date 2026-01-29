/**
 * MLZS Theme - Header, menu, Lucide icons, optional Hero Swiper
 */
(function() {
    'use strict';

    function initLucide() {
        if (typeof lucide !== 'undefined' && lucide.createIcons) {
            lucide.createIcons();
        }
    }

    function initHeaderScroll() {
        var header = document.getElementById('main-header');
        var logo = document.getElementById('brand-logo');
        if (!header || !logo) return;

        window.addEventListener('scroll', function() {
            var logoImg = logo.querySelector('img');
            if (window.scrollY > 50) {
                header.classList.remove('text-white', 'h-24', 'border-white/10');
                header.classList.add('bg-white/95', 'backdrop-blur-[10px]', 'shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)]', 'h-16', 'text-black', 'border-transparent');
                if (logoImg) {
                    logoImg.classList.remove('h-10', 'sm:h-12', 'md:h-14', 'lg:h-16');
                    logoImg.classList.add('h-10');
                    logoImg.classList.remove('brightness-0', 'invert');
                }
            } else {
                header.classList.add('text-white', 'h-24', 'border-white/10');
                header.classList.remove('bg-white/95', 'backdrop-blur-[10px]', 'shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)]', 'h-16', 'text-black', 'border-transparent');
                if (logoImg) {
                    logoImg.classList.add('h-10', 'sm:h-12', 'md:h-14', 'lg:h-16');
                    logoImg.classList.add('brightness-0', 'invert');
                }
            }
        });
    }

    function initMenuToggle() {
        var menuOverlay = document.getElementById('full-menu');
        window.toggleMenu = function() {
            if (menuOverlay) {
                var isOpen = !menuOverlay.classList.contains('-translate-y-full');
                if (isOpen) {
                    menuOverlay.classList.add('-translate-y-full');
                } else {
                    menuOverlay.classList.remove('-translate-y-full');
                }
            }
        };
    }

    document.addEventListener('DOMContentLoaded', function() {
        initLucide();
        initHeaderScroll();
        initMenuToggle();
    });
})();
