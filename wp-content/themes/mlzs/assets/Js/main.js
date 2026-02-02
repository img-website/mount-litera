/**
 * MLZS Theme - Header, menu, Lucide, Hero Swiper, Approach Swiper, Academics tabs
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
                    closeAllSubmenus(menuOverlay);
                } else {
                    menuOverlay.classList.remove('-translate-y-full');
                }
            }
        };
    }

    function closeAllSubmenus(container) {
        if (!container) container = document.getElementById('full-menu');
        if (!container) return;
        container.querySelectorAll('.menu-sub').forEach(function(sub) {
            sub.classList.remove('is-open');
        });
        container.querySelectorAll('.has-submenu').forEach(function(item) {
            item.classList.remove('is-open');
        });
        container.querySelectorAll('.menu-arrow-btn[aria-expanded="true"]').forEach(function(btn) {
            btn.setAttribute('aria-expanded', 'false');
        });
    }

    function initSubmenuToggle() {
        var fullMenu = document.getElementById('full-menu');
        if (!fullMenu) return;

        fullMenu.addEventListener('click', function(e) {
            var btn = e.target.closest('.menu-arrow-btn');
            if (!btn) return;

            var row = btn.closest('.menu-row');
            if (!row) return;
            var item = row.parentElement;
            if (!item || !item.classList.contains('has-submenu')) return;

            var sub = null;
            for (var i = 0; i < item.children.length; i++) {
                if (item.children[i].classList.contains('menu-sub')) {
                    sub = item.children[i];
                    break;
                }
            }
            if (!sub) return;

            e.preventDefault();
            var isOpen = item.classList.contains('is-open');
            if (isOpen) {
                sub.classList.remove('is-open');
                item.classList.remove('is-open');
                btn.setAttribute('aria-expanded', 'false');
            } else {
                sub.classList.add('is-open');
                item.classList.add('is-open');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    }

    function initHeroSwiper() {
        var heroEl = document.querySelector('.hero-swiper-container .swiper.w-full.h-full');
        if (!heroEl || typeof Swiper === 'undefined') return;
        new Swiper('.hero-swiper-container .swiper.w-full.h-full', {
            spaceBetween: 0,
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: { crossFade: true },
            speed: 1500,
            allowTouchMove: false,
        });
    }

    function initApproachSwipers() {
        var thumbsEl = document.querySelector('.approach-thumbs-swiper');
        if (!thumbsEl || typeof Swiper === 'undefined') return;

        var thumbsSwiper = new Swiper('.approach-thumbs-swiper', {
            spaceBetween: 16,
            slidesPerView: 4.5,
            watchSlidesProgress: true,
            scrollbar: { hide: false },
            breakpoints: {
                640: { slidesPerView: 6 },
                768: { slidesPerView: 7, scrollbar: { hide: true } },
                1024: { slidesPerView: 8, scrollbar: { hide: true } }
            },
        });

        var mainSwiper = new Swiper('.approach-main-swiper', {
            spaceBetween: 0,
            slidesPerView: 1,
            navigation: {
                nextEl: '.approach-nav-next',
                prevEl: '.approach-nav-prev',
            },
            pagination: {
                el: '.approach-pagination',
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class="' + className + '"></span>';
                },
            },
            thumbs: { swiper: thumbsSwiper },
            on: {
                slideChange: function() { initLucide(); },
                init: function() { initLucide(); }
            }
        });

        document.querySelectorAll('.approach-nav-prev, .approach-nav-next').forEach(function(btn) {
            btn.addEventListener('click', function() {
                setTimeout(initLucide, 100);
            });
        });

        document.querySelectorAll('.approach-thumbs-swiper button').forEach(function(button, index) {
            button.addEventListener('click', function() {
                mainSwiper.slideTo(index);
            });
        });
    }

    function initFooterContactForm() {
        var form = document.getElementById('mlzs-footer-contact-form');
        var msgEl = document.getElementById('mlzs-contact-form-message');
        var btn = document.getElementById('mlzs-contact-submit-btn');
        if (!form || !msgEl || !btn || typeof mlzsAjax === 'undefined') return;

        function showMessage(text, isError) {
            msgEl.textContent = text;
            msgEl.classList.remove('hidden');
            msgEl.classList.remove('bg-green-500/20', 'text-green-300', 'border-green-500/50');
            msgEl.classList.remove('bg-red-500/20', 'text-red-300', 'border-red-500/50');
            if (isError) {
                msgEl.classList.add('bg-red-500/20', 'text-red-300', 'border', 'border-red-500/50');
            } else {
                msgEl.classList.add('bg-green-500/20', 'text-green-300', 'border', 'border-green-500/50');
            }
            msgEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function hideMessage() {
            msgEl.classList.add('hidden');
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            hideMessage();
            btn.disabled = true;
            var btnText = btn.querySelector('.mlzs-btn-text');
            var btnIcon = btn.querySelector('.mlzs-btn-icon');
            if (btnText) btnText.textContent = 'Sending...';
            if (btnIcon) btnIcon.style.display = 'none';

            var fd = new FormData(form);
            var req = new XMLHttpRequest();
            req.open('POST', mlzsAjax.url);
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.onload = function() {
                btn.disabled = false;
                if (btnText) btnText.textContent = 'Send Message';
                if (btnIcon) btnIcon.style.display = '';

                try {
                    var data = JSON.parse(req.responseText);
                    if (data.success && data.data && data.data.message) {
                        showMessage(data.data.message, false);
                        form.reset();
                    } else {
                        var errMsg = (data.data && data.data.message) ? data.data.message : 'Something went wrong. Please try again.';
                        showMessage(errMsg, true);
                    }
                } catch (err) {
                    showMessage('Something went wrong. Please try again.', true);
                }
                if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
            };
            req.onerror = function() {
                btn.disabled = false;
                if (btnText) btnText.textContent = 'Send Message';
                if (btnIcon) btnIcon.style.display = '';
                showMessage('Unable to connect. Please check your connection and try again.', true);
                if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
            };
            req.send(fd);
        });
    }

    function initEnquiryForm() {
        var form = document.getElementById('mlzs-enquiry-form');
        var msgEl = document.getElementById('mlzs-enquiry-form-message');
        var btn = document.getElementById('mlzs-enquiry-submit-btn');
        if (!form || !msgEl || !btn || typeof mlzsAjax === 'undefined') return;

        var originalBtnText = (btn.querySelector('.mlzs-enquiry-btn-text') || {}).textContent || 'Submit Enquiry';

        function showMessage(text, isError) {
            msgEl.textContent = text;
            msgEl.classList.remove('hidden');
            msgEl.classList.remove('bg-green-800', 'text-white', 'border-green-500/50');
            msgEl.classList.remove('bg-red-500/20', 'text-red-300', 'border-red-500/50');
            if (isError) {
                msgEl.classList.add('bg-red-500/20', 'text-red-300', 'border', 'border-red-500/50');
            } else {
                msgEl.classList.add('bg-green-800', 'text-white', 'border', 'border-green-500/50');
            }
            msgEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function hideMessage() {
            msgEl.classList.add('hidden');
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            hideMessage();
            btn.disabled = true;
            var btnText = btn.querySelector('.mlzs-enquiry-btn-text');
            var btnIcon = btn.querySelector('.mlzs-enquiry-btn-icon');
            if (btnText) btnText.textContent = 'Submitting...';
            if (btnIcon) btnIcon.style.display = 'none';

            var fd = new FormData(form);
            var req = new XMLHttpRequest();
            req.open('POST', mlzsAjax.url);
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.onload = function() {
                btn.disabled = false;
                if (btnText) btnText.textContent = originalBtnText;
                if (btnIcon) btnIcon.style.display = '';

                try {
                    var data = JSON.parse(req.responseText);
                    if (data.success && data.data && data.data.message) {
                        showMessage(data.data.message, false);
                        form.reset();
                    } else {
                        var errMsg = (data.data && data.data.message) ? data.data.message : 'Something went wrong. Please try again.';
                        showMessage(errMsg, true);
                    }
                } catch (err) {
                    showMessage('Something went wrong. Please try again.', true);
                }
                if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
            };
            req.onerror = function() {
                btn.disabled = false;
                if (btnText) btnText.textContent = originalBtnText;
                if (btnIcon) btnIcon.style.display = '';
                showMessage('Unable to connect. Please check your connection and try again.', true);
                if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
            };
            req.send(fd);
        });
    }

    function initAdmissionForm() {
        var form = document.getElementById('mlzs-admission-form');
        var msgEl = document.getElementById('mlzs-admission-form-message');
        var btn = document.getElementById('mlzs-admission-submit-btn');
        if (!form || !msgEl || !btn || typeof mlzsAjax === 'undefined') return;

        var originalBtnText = (btn.querySelector('.mlzs-admission-btn-text') || {}).textContent || 'Submit Registration Form';

        function showMessage(text, isError) {
            msgEl.textContent = text;
            msgEl.classList.remove('hidden');
            msgEl.classList.remove('bg-green-500/20', 'text-green-300', 'border-green-500/50');
            msgEl.classList.remove('bg-red-500/20', 'text-red-300', 'border-red-500/50');
            if (isError) {
                msgEl.classList.add('bg-red-500/20', 'text-red-300', 'border', 'border-red-500/50');
            } else {
                msgEl.classList.add('bg-green-500/20', 'text-green-300', 'border', 'border-green-500/50');
            }
            msgEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function hideMessage() {
            msgEl.classList.add('hidden');
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            hideMessage();
            btn.disabled = true;
            var btnText = btn.querySelector('.mlzs-admission-btn-text');
            var btnIcon = btn.querySelector('.mlzs-admission-btn-icon');
            if (btnText) btnText.textContent = 'Submitting...';
            if (btnIcon) btnIcon.style.display = 'none';

            var fd = new FormData(form);
            var req = new XMLHttpRequest();
            req.open('POST', mlzsAjax.url);
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.onload = function() {
                btn.disabled = false;
                if (btnText) btnText.textContent = originalBtnText;
                if (btnIcon) btnIcon.style.display = '';

                try {
                    var data = JSON.parse(req.responseText);
                    if (data.success && data.data && data.data.message) {
                        showMessage(data.data.message, false);
                        form.reset();
                    } else {
                        var errMsg = (data.data && data.data.message) ? data.data.message : 'Something went wrong. Please try again.';
                        showMessage(errMsg, true);
                    }
                } catch (err) {
                    showMessage('Something went wrong. Please try again.', true);
                }
                if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
            };
            req.onerror = function() {
                btn.disabled = false;
                if (btnText) btnText.textContent = originalBtnText;
                if (btnIcon) btnIcon.style.display = '';
                showMessage('Unable to connect. Please check your connection and try again.', true);
                if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
            };
            req.send(fd);
        });
    }

    function initAcademicsTabs() {
        var tabs = document.querySelectorAll('.academics-tab');
        var panels = document.querySelectorAll('.academics-panel');
        if (!tabs.length || !panels.length) return;

        function setAcademicsTab(activeKey) {
            tabs.forEach(function(tab) {
                var key = tab.getAttribute('data-academics-tab');
                var isActive = key === activeKey;
                tab.classList.toggle('!bg-gray-900', isActive);
                tab.classList.toggle('!text-white', isActive);
                tab.classList.toggle('!shadow-md', isActive);
                tab.classList.toggle('!font-bold', isActive);
                tab.classList.toggle('!text-gray-500', !isActive);
                tab.classList.toggle('!hover:bg-gray-50', !isActive);
            });
            panels.forEach(function(panel) {
                var key = panel.getAttribute('data-academics-panel');
                panel.classList.toggle('hidden', key !== activeKey);
            });
            initLucide();
        }

        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                setAcademicsTab(tab.getAttribute('data-academics-tab'));
            });
        });

        var defaultTab = document.querySelector('.academics-tab[data-academics-tab]');
        setAcademicsTab(defaultTab ? defaultTab.getAttribute('data-academics-tab') : 'fun');
    }

    document.addEventListener('DOMContentLoaded', function() {
        initLucide();
        initHeaderScroll();
        initMenuToggle();
        initSubmenuToggle();
        initHeroSwiper();
        initApproachSwipers();
        initAcademicsTabs();
        initFooterContactForm();
        initEnquiryForm();
        initAdmissionForm();
    });
})();
