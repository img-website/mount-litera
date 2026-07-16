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
