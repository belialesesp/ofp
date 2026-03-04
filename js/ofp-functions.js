/**
 * ofp-functions.js
 *
 */

// ── Look-around menu ──────────────────────────────────────────────────────────
// DOM-ready guard ensures the elements exist before we try to bind to them.
// The $menu.length check exits early on pages that don't render the look-around
// section, so no handlers are attached when there's nothing to attach to.
(function($) {
    'use strict';

    $(function() {
        var $menu    = $('.look-around__menu');
        var $showBtn = $('#show-look-around-btn');
        var $hideBtn = $('#hidde-look-around-btn');

        if (!$menu.length) return;

        $showBtn.on('click', function() {
            $menu.addClass('showing');
        });

        $hideBtn.on('click', function() {
            $menu.removeClass('showing');
        });
    });

})(jQuery);

// ── Global popup helper (called from inline onclick in footer.php) ────────────
function close_pop_up(popup) {
    jQuery('#' + popup).fadeOut(400);
}

// ── Enhanced Page Sidebar Detection ──────────────────────────────────────────
/**
 * Ensures the page sidebar is properly detected and displayed in the
 * pre-footer area on page-type templates.
 *
 * Note: the inner hasSidebarBlockContent() helper that existed in the previous
 * version has been removed — it was declared but never called anywhere.
 */
function enhancedPageSidebarDetection() {
    if (!document.body.classList.contains('page')) {
        return;
    }

    document.body.classList.add('has-pre-footer-sidebar');
    document.body.classList.remove('has-sidebar');
    document.body.classList.remove('has-page-sidebar');

    var sidebars = document.querySelectorAll('.sidebar:not(.pre-footer-page-sidebar-wrapper .widget)');
    sidebars.forEach(function(sidebar) {
        sidebar.style.display = 'none';
    });

    var preFooterSidebar = document.querySelector('.pre-footer-page-sidebar-container');
    if (preFooterSidebar) {
        preFooterSidebar.style.display = 'block';
    }
}

enhancedPageSidebarDetection();

// ── Flodesk popup SVG cleanup ─────────────────────────────────────────────────
/**
 * Flodesk injects decorative <svg> shapes into its form container after load.
 * If a caching/security plugin strips SVG tags from the cached HTML, the raw
 * SVG path coordinate strings are left as visible text nodes.
 *
 * This MutationObserver watches each popup's Flodesk container and removes any
 * <svg> elements as soon as Flodesk injects them. The form inputs, labels,
 * submit button and success state are plain HTML — hiding SVGs has zero visual
 * impact on the functional form.
 */
(function() {
    'use strict';

    function removeFlodeskSVGs(container) {
        container.querySelectorAll('svg').forEach(function(svg) {
            svg.remove();
        });

        // Also remove bare text nodes that are SVG path data left by stripped tags.
        var walker = document.createTreeWalker(container, NodeFilter.SHOW_TEXT, null, false);
        var toRemove = [];
        var node;
        while ((node = walker.nextNode())) {
            if (/^[Mm][\d\s.,CLHVZQSclhvzqsAa-]+$/.test(node.nodeValue.trim())) {
                toRemove.push(node);
            }
        }
        toRemove.forEach(function(n) { n.parentNode && n.parentNode.removeChild(n); });
    }

    function watchFlodeskContainer(container) {
        removeFlodeskSVGs(container);

        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes.length) {
                    removeFlodeskSVGs(container);
                }
            });
        });

        observer.observe(container, { childList: true, subtree: true });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var popups = document.querySelectorAll('.pop-up');
        if (!popups.length) return;

        function initWatchers() {
            document.querySelectorAll('.pop-up .flodesk-form-container').forEach(function(el) {
                if (!el.dataset.ofpWatched) {
                    el.dataset.ofpWatched = '1';
                    watchFlodeskContainer(el);
                }
            });
        }

        initWatchers();

        // Poll for 5 s in case Flodesk creates the container after DOMContentLoaded.
        var polls = 0;
        var interval = setInterval(function() {
            initWatchers();
            if (++polls >= 10) clearInterval(interval);
        }, 500);
    });

})();

// ── OFP Slider Manager ────────────────────────────────────────────────────────
/**
 * Centralises all Splide slider initialisation for the theme.
 * PHP templates output standard Splide markup; this module handles mounting.
 *
 * See the Splide refactor session notes for full documentation.
 */
var OFPSlider = (function() {
    'use strict';

    // Named slider configurations keyed by CSS class on the .splide root.
    var CONFIGS = {

        // custom-blocks/success-stories/success-stories-template.php
        'success-stories-splide': {
            type:       'loop',
            perPage:    2,
            perMove:    1,
            gap:        '1rem',
            pagination: false,
            arrows:     true,
            breakpoints: {
                991: { perPage: 1 }
            }
        },

        // custom-blocks/course-library/course-library-template.php
        'course-library-splide': {
            type:        'loop',
            heightRatio: 0,
            pagination:  false,
            arrows:      true,
            perPage:     2,
            gap:         '1rem',
            arrowPath:   'M29.6548 23.8359H7.33398V20.1693H29.6548L19.3882 9.9026L22.0007 7.33594L36.6673 22.0026L22.0007 36.6693L19.3882 34.1026L29.6548 23.8359Z',
            breakpoints: {
                991: { perPage: 1 }
            }
        }

    };

    // WeakMap instance registry — prevents double-mount, enables clean teardown,
    // and releases entries automatically when elements are GC'd.
    var instances = new WeakMap();

    function resolveOptions(el) {
        var config = {};

        Object.keys(CONFIGS).forEach(function(key) {
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
                config = Object.assign(config, JSON.parse(dataAttr));
            } catch (e) {
                console.warn('OFPSlider: Ignoring invalid JSON in data-splide on', el, e);
            }
        }

        return config;
    }

    function mountOne(el) {
        if (instances.has(el)) return;
        if (el.classList.contains('is-initialized')) return;

        if (typeof Splide === 'undefined') {
            console.warn('OFPSlider: Splide library is not loaded. Cannot mount slider.', el);
            return;
        }

        var options = resolveOptions(el);

        try {
            var splide = new Splide(el, options);
            splide.mount();
            instances.set(el, splide);
        } catch (e) {
            console.error('OFPSlider: Failed to mount slider on', el, e);
        }
    }

    function destroyOne(el) {
        if (!instances.has(el)) return;

        try {
            instances.get(el).destroy();
        } catch (e) {
            console.warn('OFPSlider: Error while destroying slider on', el, e);
        }

        instances.delete(el);
    }

    function init() {
        if (typeof Splide === 'undefined') {
            console.warn('OFPSlider: Splide library is not loaded. Skipping init.');
            return;
        }

        document.querySelectorAll('.splide').forEach(function(el) {
            mountOne(el);
        });
    }

    return {
        init:       init,
        mountOne:   mountOne,
        destroyOne: destroyOne
    };

})();

// Single DOMContentLoaded listener initialises all sliders on the page.
document.addEventListener('DOMContentLoaded', function() {
    OFPSlider.init();
});