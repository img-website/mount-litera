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
            var logoImgs = logo.querySelectorAll('img');
            var divider = logo.querySelector('.w-px');
            if (window.scrollY > 50) {
                header.classList.remove('text-white', 'h-24', 'border-white/10');
                header.classList.add('bg-white/95', 'backdrop-blur-[10px]', 'shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)]', 'h-16', 'text-black', 'border-transparent');
                logoImgs.forEach(function(logoImg) {
                    logoImg.classList.remove('h-12', 'sm:h-[3.6rem]', 'md:h-[4.2rem]', 'lg:h-[4.8rem]');
                    logoImg.classList.add('h-10');
                    logoImg.classList.remove('brightness-0', 'invert');
                });
                if (divider) {
                    divider.classList.remove('h-12', 'sm:h-[3.6rem]', 'md:h-[4.2rem]', 'lg:h-[4.8rem]');
                    divider.classList.add('h-10');
                    divider.classList.remove('bg-white/20');
                    divider.classList.add('bg-slate-900/20');
                }
            } else {
                header.classList.add('text-white', 'h-24', 'border-white/10');
                header.classList.remove('bg-white/95', 'backdrop-blur-[10px]', 'shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)]', 'h-16', 'text-black', 'border-transparent');
                logoImgs.forEach(function(logoImg) {
                    logoImg.classList.remove('h-10');
                    logoImg.classList.add('h-12', 'sm:h-[3.6rem]', 'md:h-[4.2rem]', 'lg:h-[4.8rem]');
                    logoImg.classList.add('brightness-0', 'invert');
                });
                if (divider) {
                    divider.classList.remove('h-10');
                    divider.classList.add('h-12', 'sm:h-[3.6rem]', 'md:h-[4.2rem]', 'lg:h-[4.8rem]');
                    divider.classList.remove('bg-slate-900/20');
                    divider.classList.add('bg-white/20');
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
        var heroEl = document.querySelector('.hero-swiper-container .swiper');
        if (!heroEl || typeof Swiper === 'undefined') return;

        var heroSwiper = new Swiper(heroEl, {
            spaceBetween: 0,
            slidesPerView: 1,
            loop: true,
            navigation: {
                nextEl: '.hero-nav-next',
                prevEl: '.hero-nav-prev',
            },
            pagination: {
                el: '.hero-pagination',
                clickable: true,
                dynamicBullets: true,
                dynamicMainBullets: 3,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: { crossFade: true },
            speed: 1500,
            allowTouchMove: false,
        });

        var endedHandlers = new WeakMap();

        function stopAllVideos() {
            var allVideos = heroEl.querySelectorAll('.hero-slide-video');
            allVideos.forEach(function(video) {
                try {
                    video.pause();
                    video.currentTime = 0;
                } catch (e) {}
            });
        }

        function bindVideoEnded(video) {
            if (!video) return;
            if (endedHandlers.has(video)) return;
            var onEnded = function() {
                if (!heroSwiper || heroSwiper.destroyed) return;
                heroSwiper.slideNext();
            };
            video.addEventListener('ended', onEnded);
            endedHandlers.set(video, onEnded);
        }

        function updateHeroSlideState() {
            if (!heroSwiper || heroSwiper.destroyed) return;
            stopAllVideos();
            if (heroSwiper.autoplay && heroSwiper.autoplay.running) {
                heroSwiper.autoplay.stop();
            }

            var activeSlide = heroSwiper.slides[heroSwiper.activeIndex];
            if (!activeSlide) return;

            var slideType = (activeSlide.getAttribute('data-slide-type') || 'image').toLowerCase();
            if (slideType === 'video') {
                var video = activeSlide.querySelector('.hero-slide-video');
                if (video) {
                    bindVideoEnded(video);
                    var playPromise = video.play();
                    if (playPromise && typeof playPromise.catch === 'function') {
                        playPromise.catch(function() {});
                    }
                }
                return;
            }

            if (heroSwiper.autoplay) {
                heroSwiper.autoplay.start();
            }
        }

        heroSwiper.on('init', updateHeroSlideState);
        heroSwiper.on('slideChangeTransitionEnd', updateHeroSlideState);
        heroSwiper.on('beforeDestroy', stopAllVideos);
        updateHeroSlideState();
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
        initContactFormAjax('mlzs-footer-contact-form', 'mlzs-contact-form-message', 'mlzs-contact-submit-btn', '.mlzs-btn-text', '.mlzs-btn-icon', 'Send Message');
    }

    function initAlumniContactForm() {
        initContactFormAjax('mlzs-alumni-contact-form', 'mlzs-alumni-contact-form-message', 'mlzs-alumni-contact-submit-btn', '.mlzs-alumni-btn-text', '.mlzs-alumni-btn-icon', 'Send Suggestion');
    }

    function initContactFormAjax(formId, messageElId, btnId, btnTextSel, btnIconSel, defaultBtnText) {
        var form = document.getElementById(formId);
        var msgEl = document.getElementById(messageElId);
        var btn = document.getElementById(btnId);
        if (!form || !msgEl || !btn || typeof mlzsAjax === 'undefined') return;

        function showMessage(text, isError) {
            msgEl.textContent = text;
            msgEl.classList.remove('hidden');
            msgEl.classList.remove('bg-green-800', 'text-white', 'border-green-500/50');
            msgEl.classList.remove('bg-red-800', 'text-white', 'border-red-500/50');
            if (isError) {
                msgEl.classList.add('bg-red-800', 'text-white', 'border', 'border-red-500/50');
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
            var btnText = btn.querySelector(btnTextSel);
            var btnIcon = btn.querySelector(btnIconSel);
            if (btnText) btnText.textContent = 'Sending...';
            if (btnIcon) btnIcon.style.display = 'none';

            var fd = new FormData(form);
            var req = new XMLHttpRequest();
            req.open('POST', mlzsAjax.url);
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.onload = function() {
                btn.disabled = false;
                if (btnText) btnText.textContent = defaultBtnText;
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
                if (btnText) btnText.textContent = defaultBtnText;
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
            msgEl.classList.remove('bg-red-800', 'text-white', 'border-red-500/50');
            if (isError) {
                msgEl.classList.add('bg-red-800', 'text-white', 'border', 'border-red-500/50');
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
            msgEl.classList.remove('bg-green-800', 'text-white', 'border-green-500/50');
            msgEl.classList.remove('bg-red-800', 'text-white', 'border-red-500/50');
            if (isError) {
                msgEl.classList.add('bg-red-800', 'text-white', 'border', 'border-red-500/50');
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

    function initRegistrationForm() {
        var form = document.getElementById('mlzs-registration-form');
        var msgEl = document.getElementById('mlzs-registration-form-message');
        var btn = document.getElementById('mlzs-registration-submit-btn');
        if (!form || !msgEl || !btn || typeof mlzsAjax === 'undefined') return;

        var btnTextEl = btn.querySelector('.mlzs-registration-btn-text');
        var originalBtnText = (btnTextEl || {}).textContent || 'Submit Registration Form';

        function initRegPhotoPreview() {
            var boxes = document.querySelectorAll('.reg-photo-box');
            boxes.forEach(function(box) {
                var placeholder = box.querySelector('.reg-photo-placeholder');
                var previewWrap = box.querySelector('.reg-photo-preview');
                var previewImg = previewWrap ? previewWrap.querySelector('img') : null;
                var removeBtn = box.querySelector('.reg-photo-remove');
                var fileInput = box.querySelector('input[type="file"]');
                if (!placeholder || !previewWrap || !previewImg || !removeBtn || !fileInput) return;

                function showPreview(file) {
                    if (!file || !file.type.match(/^image\//)) return;
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        placeholder.classList.add('hidden');
                        previewWrap.classList.remove('hidden');
                        removeBtn.classList.remove('hidden');
                        if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
                    };
                    reader.readAsDataURL(file);
                }

                function hidePreview() {
                    fileInput.value = '';
                    previewImg.src = '';
                    placeholder.classList.remove('hidden');
                    previewWrap.classList.add('hidden');
                    removeBtn.classList.add('hidden');
                    if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
                }

                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) showPreview(this.files[0]);
                });

                removeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    hidePreview();
                });
            });
        }

        initRegPhotoPreview();

        form.addEventListener('reset', function() {
            setTimeout(function() {
                document.querySelectorAll('.reg-photo-box').forEach(function(box) {
                    var placeholder = box.querySelector('.reg-photo-placeholder');
                    var previewWrap = box.querySelector('.reg-photo-preview');
                    var previewImg = previewWrap ? previewWrap.querySelector('img') : null;
                    var removeBtn = box.querySelector('.reg-photo-remove');
                    var fileInput = box.querySelector('input[type="file"]');
                    if (placeholder) placeholder.classList.remove('hidden');
                    if (previewWrap) previewWrap.classList.add('hidden');
                    if (previewImg) previewImg.src = '';
                    if (removeBtn) removeBtn.classList.add('hidden');
                    if (fileInput) fileInput.value = '';
                });
                if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();
            }, 0);
        });

        function showMessage(text, isError) {
            msgEl.textContent = text;
            msgEl.classList.remove('hidden');
            msgEl.classList.remove('bg-green-800', 'text-white', 'border-green-500/50');
            msgEl.classList.remove('bg-red-800', 'text-white', 'border-red-500/50');
            if (isError) {
                msgEl.classList.add('bg-red-800', 'text-white', 'border', 'border-red-500/50');
            } else {
                msgEl.classList.add('bg-green-800', 'text-white', 'border', 'border-green-500/50');
            }
            msgEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            msgEl.classList.add('hidden');
            btn.disabled = true;
            if (btnTextEl) btnTextEl.textContent = 'Submitting...';

            var fd = new FormData(form);
            var req = new XMLHttpRequest();
            req.open('POST', mlzsAjax.url);
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.onload = function() {
                btn.disabled = false;
                if (btnTextEl) btnTextEl.textContent = originalBtnText;
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
                if (btnTextEl) btnTextEl.textContent = originalBtnText;
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

    /**
     * Safety net: the hero must expose exactly one <h1>. Swiper's loop mode
     * clones slides, so if the slide carrying the H1 is cloned we demote the
     * extra copies to <p> (identical classes, so nothing changes visually).
     */
    function dedupeHeroH1() {
        var hero = document.querySelector('.hero-swiper-container');
        if (!hero) return;
        var h1s = hero.querySelectorAll('h1');
        for (var i = 1; i < h1s.length; i++) {
            var el = h1s[i];
            var p = document.createElement('p');
            p.className = el.className;
            p.innerHTML = el.innerHTML;
            if (el.parentNode) el.parentNode.replaceChild(p, el);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        initLucide();
        initHeaderScroll();
        initMenuToggle();
        initSubmenuToggle();
        initHeroSwiper();
        dedupeHeroH1();
        setTimeout(dedupeHeroH1, 600); // catch clones Swiper adds after init
        initApproachSwipers();
        initAcademicsTabs();
        initFooterContactForm();
        initAlumniContactForm();
        initEnquiryForm();
        initAdmissionForm();
        initRegistrationForm();
    });
})();
