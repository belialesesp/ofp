/**
 * ofp-functions.js
 *
 */

// ── Namespace bootstrap ───────────────────────────────────────────────────────
// Defensive assignment: safe if another script has already created window.OFP.
window.OFP = window.OFP || {};

// ── Look-around menu ──────────────────────────────────────────────────────────
(function ($) {
    'use strict';

    $(function () {
        var $menu    = $('.look-around__menu');
        var $showBtn = $('#show-look-around-btn');
        var $hideBtn = $('#hidde-look-around-btn');

        // Exit silently on pages that don't include the look-around section.
        if (!$menu.length) return;

        $showBtn.on('click', function () { $menu.addClass('showing'); });
        $hideBtn.on('click', function () { $menu.removeClass('showing'); });
    });

}(jQuery));

// ── Popup helper ──────────────────────────────────────────────────────────────
/**
 * window.OFP.closePopup( id )
 *
 * Called from the inline onclick attributes in footer.php:
 *   onclick="OFP.closePopup('<?php echo esc_js($popupID); ?>')"
 *
 * Replaces the old bare global `close_pop_up`. The function name in footer.php
 * must be updated from  close_pop_up(...)  to  OFP.closePopup(...)  — see the
 * footer.php patch delivered alongside this file.
 */
window.OFP.closePopup = function (id) {
    jQuery('#' + id).fadeOut(400);
};

// ── Enhanced page sidebar detection ──────────────────────────────────────────
// Runs immediately at parse time (intentional — same as before).
// Result is not published to the namespace; it has no public callers.
(function () {
    'use strict';

    if (!document.body.classList.contains('page')) return;

    document.body.classList.add('has-pre-footer-sidebar');
    document.body.classList.remove('has-sidebar', 'has-page-sidebar');

    document.querySelectorAll(
        '.sidebar:not(.pre-footer-page-sidebar-wrapper .widget)'
    ).forEach(function (el) {
        el.style.display = 'none';
    });

    var preFooter = document.querySelector('.pre-footer-page-sidebar-container');
    if (preFooter) preFooter.style.display = 'block';

}());

// ── Flodesk popup SVG cleanup ─────────────────────────────────────────────────
/**
 * Flodesk injects decorative <svg> shapes into its form container after load.
 * If a caching/security plugin strips SVG tags from the cached HTML the raw
 * coordinate strings are left as visible text nodes. This MutationObserver
 * removes them as soon as Flodesk injects them.
 */
(function () {
    'use strict';

    function removeFlodeskSVGs(container) {
        container.querySelectorAll('svg').forEach(function (svg) { svg.remove(); });

        // Remove stray text nodes that look like SVG path data.
        var walker = document.createTreeWalker(
            container, NodeFilter.SHOW_TEXT, null, false
        );
        var toRemove = [];
        var node;
        while ((node = walker.nextNode())) {
            if (/^[Mm][\d\s.,CLHVZQSclhvzqsAa-]+$/.test(node.nodeValue.trim())) {
                toRemove.push(node);
            }
        }
        toRemove.forEach(function (n) {
            if (n.parentNode) n.parentNode.removeChild(n);
        });
    }

    function watchFlodeskContainer(container) {
        removeFlodeskSVGs(container);
        var observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (m) {
                if (m.addedNodes.length) removeFlodeskSVGs(container);
            });
        });
        observer.observe(container, { childList: true, subtree: true });
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (!document.querySelector('.pop-up')) return;

        function initWatchers() {
            document.querySelectorAll('.pop-up .flodesk-form-container').forEach(function (el) {
                if (!el.dataset.ofpWatched) {
                    el.dataset.ofpWatched = '1';
                    watchFlodeskContainer(el);
                }
            });
        }

        initWatchers();

        // Poll for 5 s in case Flodesk creates the container after DOMContentLoaded.
        var polls = 0;
        var pollInterval = setInterval(function () {
            initWatchers();
            if (++polls >= 10) clearInterval(pollInterval);
        }, 500);
    });

}());

// ── OFP Slider module ─────────────────────────────────────────────────────────
/**
 * Centralises Splide slider initialisation for the theme.
 * Published to window.OFP.slider so AJAX handlers can call:
 *
 *   OFP.slider.init()           — mount all uninitialised .splide elements
 *   OFP.slider.mountOne(el)     — mount a specific element (AJAX inject)
 *   OFP.slider.destroyOne(el)   — destroy before replacing slider HTML
 */
window.OFP.slider = (function () {
    'use strict';

    var CONFIGS = {

        'success-stories-splide': {
            type:       'loop',
            perPage:    2,
            perMove:    1,
            gap:        '1rem',
            pagination: false,
            arrows:     true,
            breakpoints: { 991: { perPage: 1 } }
        },

        'course-library-splide': {
            type:        'loop',
            heightRatio: 0,
            pagination:  false,
            arrows:      true,
            perPage:     2,
            gap:         '1rem',
            arrowPath:   'M29.6548 23.8359H7.33398V20.1693H29.6548L19.3882 9.9026L22.0007 7.33594L36.6673 22.0026L22.0007 36.6693L19.3882 34.1026L29.6548 23.8359Z',
            breakpoints: { 991: { perPage: 1 } }
        }

    };

    // WeakMap instance registry — prevents double-mount, allows clean teardown,
    // entries are released automatically when elements are garbage-collected.
    var instances = new WeakMap();

    function resolveOptions(el) {
        var config = {};
        Object.keys(CONFIGS).forEach(function (key) {
            if (el.classList.contains(key)) {
                config = Object.assign({}, CONFIGS[key]);
                if (config.breakpoints) {
                    config.breakpoints = Object.assign({}, config.breakpoints);
                }
            }
        });
        var dataAttr = el.getAttribute('data-splide');
        if (dataAttr) {
            try {
                Object.assign(config, JSON.parse(dataAttr));
            } catch (e) {
                console.warn('OFP.slider: invalid JSON in data-splide on', el, e);
            }
        }
        return config;
    }

    function mountOne(el) {
        if (instances.has(el) || el.classList.contains('is-initialized')) return;
        if (typeof Splide === 'undefined') {
            console.warn('OFP.slider: Splide not loaded, cannot mount', el);
            return;
        }
        try {
            var splide = new Splide(el, resolveOptions(el));
            splide.mount();
            instances.set(el, splide);
        } catch (e) {
            console.error('OFP.slider: mount failed on', el, e);
        }
    }

    function destroyOne(el) {
        if (!instances.has(el)) return;
        try { instances.get(el).destroy(); }
        catch (e) { console.warn('OFP.slider: destroy error on', el, e); }
        instances.delete(el);
    }

    function init() {
        if (typeof Splide === 'undefined') {
            console.warn('OFP.slider: Splide not loaded, skipping init.');
            return;
        }
        document.querySelectorAll('.splide').forEach(mountOne);
    }

    return { init: init, mountOne: mountOne, destroyOne: destroyOne };

}());

// Initialise all sliders once the DOM is ready.
document.addEventListener('DOMContentLoaded', function () {
    window.OFP.slider.init();
});