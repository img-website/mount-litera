/**
 * MLZS Blog — smart search + category filter (AJAX) and share/copy helpers.
 */
(function () {
    'use strict';

    function refreshIcons() {
        if (typeof lucide !== 'undefined' && lucide.createIcons) {
            lucide.createIcons();
        }
    }

    function initSmartSearch() {
        var form    = document.getElementById('mlzs-blog-search');
        var results = document.getElementById('mlzs-blog-results');
        var input   = document.getElementById('mlzs-blog-q');
        var countEl = document.getElementById('mlzs-blog-count');
        if (!form || !results || !input || typeof mlzsBlog === 'undefined') {
            return;
        }

        var activeCat = 'all';
        var activeChip = document.querySelector('.mlzs-cat-chip[data-cat="all"]');
        var timer = null;
        var lastReq = 0;

        function setChip(slug) {
            activeCat = slug || 'all';
            document.querySelectorAll('.mlzs-cat-chip').forEach(function (chip) {
                var on = chip.getAttribute('data-cat') === activeCat;
                chip.classList.toggle('bg-primary', on);
                chip.classList.toggle('text-white', on);
                chip.classList.toggle('border-primary', on);
                chip.classList.toggle('shadow-glow', on);
                chip.classList.toggle('bg-white', !on);
                chip.classList.toggle('text-gray-700', !on);
                chip.classList.toggle('border-gray-200', !on);
            });
        }

        function setBusy(busy) {
            results.style.opacity = busy ? '0.45' : '1';
            results.style.transition = 'opacity .2s ease';
        }

        function run() {
            var q = input.value.trim();
            var reqId = ++lastReq;
            setBusy(true);

            var body = new URLSearchParams();
            body.append('action', 'mlzs_blog_search');
            body.append('nonce', mlzsBlog.nonce);
            body.append('q', q);
            body.append('cat', activeCat);

            fetch(mlzsBlog.ajaxUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
                body: body.toString()
            })
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    if (reqId !== lastReq) { return; } // ignore stale responses
                    if (data && data.success) {
                        results.innerHTML = data.data.html;
                        if (countEl) {
                            var n = data.data.count;
                            countEl.textContent = q
                                ? n + ' result(s) for “' + q + '”'
                                : n + ' article(s)';
                        }
                        refreshIcons();
                    }
                    setBusy(false);
                    updateUrl(q);
                })
                .catch(function () { setBusy(false); });
        }

        function updateUrl(q) {
            if (!window.history || !window.history.replaceState) { return; }
            var params = new URLSearchParams();
            if (q) { params.set('bs', q); }
            if (activeCat && activeCat !== 'all') { params.set('cat', activeCat); }
            var qs = params.toString();
            window.history.replaceState({}, '', window.location.pathname + (qs ? '?' + qs : ''));
        }

        function debounced() {
            clearTimeout(timer);
            timer = setTimeout(run, 320);
        }

        form.addEventListener('submit', function (e) { e.preventDefault(); clearTimeout(timer); run(); });
        input.addEventListener('input', debounced);

        document.querySelectorAll('.mlzs-cat-chip').forEach(function (chip) {
            chip.addEventListener('click', function (e) {
                e.preventDefault();
                setChip(chip.getAttribute('data-cat'));
                run();
                var top = results.getBoundingClientRect().top + window.scrollY - 120;
                window.scrollTo({ top: top, behavior: 'smooth' });
            });
        });
    }

    function initCopyLink() {
        document.querySelectorAll('.mlzs-copy-link').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var url = btn.getAttribute('data-mlzs-copy') || window.location.href;
                var done = function () {
                    var i = btn.querySelector('[data-lucide]');
                    if (i) { i.setAttribute('data-lucide', 'check'); refreshIcons(); }
                    btn.classList.add('bg-primary', 'text-white');
                    setTimeout(function () {
                        if (i) { i.setAttribute('data-lucide', 'link'); refreshIcons(); }
                        btn.classList.remove('bg-primary', 'text-white');
                    }, 1600);
                };
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url).then(done).catch(function () {});
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initSmartSearch();
        initCopyLink();
    });
})();

(function () {
    'use strict';

    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* Reading progress bar */
    function initProgress() {
        var bar = document.querySelector('.mlzs-progress__bar');
        var article = document.querySelector('.mlzs-article');
        if (!bar || !article) { return; }
        function update() {
            var rect = article.getBoundingClientRect();
            var total = rect.height - window.innerHeight;
            var passed = -rect.top;
            var pct = total > 0 ? (passed / total) * 100 : (rect.top <= 0 ? 100 : 0);
            bar.style.width = Math.max(0, Math.min(100, pct)) + '%';
        }
        update();
        window.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update);
    }

    /* Highlight the current section in the table of contents */
    function initTocHighlight() {
        var links = document.querySelectorAll('[data-toc-link]');
        if (!links.length) { return; }
        var map = {};
        links.forEach(function (l) {
            var id = l.getAttribute('data-toc-link');
            (map[id] = map[id] || []).push(l);
        });
        var headings = [];
        Object.keys(map).forEach(function (id) {
            var el = document.getElementById(id);
            if (el) { headings.push(el); }
        });
        if (!headings.length) { return; }

        function setActive(id) {
            links.forEach(function (l) {
                l.classList.toggle('is-active', l.getAttribute('data-toc-link') === id);
            });
        }

        if ('IntersectionObserver' in window) {
            var visible = {};
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) { visible[e.target.id] = e.isIntersecting; });
                for (var i = 0; i < headings.length; i++) {
                    if (visible[headings[i].id]) { setActive(headings[i].id); return; }
                }
            }, { rootMargin: '-120px 0px -70% 0px', threshold: 0 });
            headings.forEach(function (h) { io.observe(h); });
        }

        // Smooth scroll (respects reduced-motion)
        links.forEach(function (l) {
            l.addEventListener('click', function (e) {
                var target = document.getElementById(l.getAttribute('data-toc-link'));
                if (!target) { return; }
                e.preventDefault();
                target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
                if (history.replaceState) { history.replaceState(null, '', '#' + target.id); }
                setActive(target.id);
                var det = l.closest('details');
                if (det) { det.open = false; }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initProgress();
        initTocHighlight();
    });
})();

/* FAQ accordion — enforces one-open-at-a-time. The markup also uses the native
   exclusive <details name="..."> grouping; this simply guarantees the same
   behaviour in browsers that don't implement it yet. */
(function () {
    'use strict';
    function initFaqAccordion() {
        document.querySelectorAll('[data-mlzs-accordion]').forEach(function (group) {
            var items = Array.prototype.slice.call(group.querySelectorAll('details'));
            if (items.length < 2) { return; }
            // Runs regardless of native <details name=""> support, so the
            // one-open-at-a-time rule is guaranteed in every browser.
            items.forEach(function (item) {
                item.addEventListener('toggle', function () {
                    if (!item.open) { return; }
                    items.forEach(function (other) {
                        if (other !== item && other.open) { other.open = false; }
                    });
                });
            });
        });
    }
    document.addEventListener('DOMContentLoaded', initFaqAccordion);
})();
