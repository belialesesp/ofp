(function($) {
  $("#show-look-around-btn").click(function () {
    $('.look-around__menu').addClass('showing')
  });
  $("#hidde-look-around-btn").click(function () {
    $('.look-around__menu').removeClass('showing')
  });
})(jQuery);

function close_pop_up(popup) {
  jQuery(`#${popup}`).fadeOut(400)
}

/**
 * Enhanced Page Sidebar Detection and Handling
 * This function ensures the page sidebar is properly detected and displayed in the pre-footer area
 */
function enhancedPageSidebarDetection() {
  // Check if we're on a page
  if (!document.body.classList.contains('page')) {
    return;
  }
  
  // For pages, we always want to hide the sidebar and show only the pre-footer
  document.body.classList.add('has-pre-footer-sidebar');
  document.body.classList.remove('has-sidebar');
  document.body.classList.remove('has-page-sidebar');
  
  // Hide any sidebar that might be visible
  const sidebars = document.querySelectorAll('.sidebar:not(.pre-footer-page-sidebar-wrapper .widget)');
  sidebars.forEach(sidebar => {
    sidebar.style.display = 'none';
  });
  
  // Function to check if the page content contains a sidebar block
  function hasSidebarBlockContent() {
    // Target the main content area
    const mainContent = document.querySelector('.site-main .entry-content');
    if (!mainContent) return false;
    
    // Check for various sidebar indicators in the content
    const hasUniqueCard = mainContent.querySelector('.unique-card') !== null;
    const hasFreeResources = mainContent.querySelector('.free-resources:not(.widget .free-resources)') !== null;
    const hasExtraBenefits = mainContent.querySelector('.extra-benefits') !== null;
    const hasSuccessStories = mainContent.querySelector('.success-stories:not(.widget .success-stories)') !== null;
    
    // If any of these block types exist in the main content, we should hide the widget sidebar
    return hasUniqueCard || hasFreeResources || hasExtraBenefits || hasSuccessStories;
  }
  
  // Make sure the pre-footer sidebar container is visible
  const preFooterSidebar = document.querySelector('.pre-footer-page-sidebar-container');
  if (preFooterSidebar) {
    preFooterSidebar.style.display = 'block';
  }
}

// Execute the enhanced detection
enhancedPageSidebarDetection();

/**
 * Flodesk popup SVG cleanup
 *
 * Flodesk injects decorative <svg> background shapes into the form container
 * after page load. If a security/caching plugin strips the <svg> and <path>
 * tags from a cached copy of the page, the raw SVG path coordinate strings
 * (e.g. "M10.1305 2.1628 10.6096...") are left as visible text nodes.
 *
 * This MutationObserver watches the popup's Flodesk container and removes
 * any <svg> elements as soon as Flodesk injects them. The form inputs, labels,
 * submit button, and success state are all plain HTML — hiding the SVGs has
 * zero visual impact on the functional form.
 *
 * Add this block anywhere in ofp-functions.js (outside the jQuery wrapper
 * so it runs immediately, not on DOM-ready).
 */
(function() {
  'use strict';

  /**
   * Strip all <svg> children from a node.
   * Also removes direct text nodes that look like SVG path data
   * (sequences of numbers and letters like "M10.13 2.16 C4.49...").
   */
  function removeFlodeskSVGs(container) {
    // Remove <svg> elements
    container.querySelectorAll('svg').forEach(function(svg) {
      svg.remove();
    });

    // Remove direct text nodes that are SVG path data (starts with M/m followed by numbers)
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

  /**
   * Start observing a Flodesk container for injected SVGs.
   */
  function watchFlodeskContainer(container) {
    // Clean up immediately in case Flodesk already ran
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

  /**
   * On DOMContentLoaded, watch every .flodesk-form-container inside .pop-up.
   * Uses a small polling fallback in case Flodesk adds containers dynamically.
   */
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

    // Immediate pass
    initWatchers();

    // Poll for 5s in case Flodesk creates the container after DOMContentLoaded
    var polls = 0;
    var interval = setInterval(function() {
      initWatchers();
      if (++polls >= 10) clearInterval(interval);
    }, 500);
  });

})();

/**
 * OFP Slider Manager
 *
 * Centralises all Splide slider initialisation for the theme.
 * PHP templates no longer need inline <script> blocks — they just output
 * standard Splide HTML markup with an optional data-splide attribute for
 * per-instance option overrides.
 *
 * HOW IT WORKS
 * ------------
 * 1. On DOMContentLoaded, OFPSlider.init() scans the page for every
 *    element with the class "splide" that has not yet been initialised.
 *
 * 2. Options are resolved in this priority order (lowest → highest):
 *    a. Built-in CONFIGS keyed by an extra class on the slider element
 *       (e.g. class="splide success-stories-splide" picks the
 *       'success-stories-splide' config).
 *    b. The data-splide JSON attribute on the element itself (Splide
 *       reads this natively; we also handle it explicitly for safe
 *       error handling).
 *
 * 3. All mounted instances are tracked in a WeakMap so:
 *    - Double-mounting the same element is silently prevented.
 *    - Instances can be destroyed cleanly (useful after AJAX re-renders).
 *
 * ADDING A NEW SLIDER TYPE
 * ------------------------
 * Add an entry to the CONFIGS object below. The key must match a CSS
 * class that will be present on the .splide root element. Options follow
 * the standard Splide API.
 *
 * AJAX / DYNAMIC CONTENT
 * ----------------------
 * After injecting new slider HTML into the DOM, call:
 *   OFPSlider.init();          // mounts any new, uninitialised sliders
 *   OFPSlider.mountOne(el);    // mount a specific element
 *   OFPSlider.destroyOne(el);  // destroy before re-rendering
 */
var OFPSlider = (function() {
  'use strict';

  // ─── Named slider configurations ────────────────────────────────────────────
  // Key = CSS class present on the .splide root element.
  // Values = Splide options (https://splidejs.com/guides/options/).
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

  // ─── Internal state ──────────────────────────────────────────────────────────
  // WeakMap so entries are automatically released when elements are removed
  // from the DOM — no manual cleanup needed for garbage-collected nodes.
  var instances = new WeakMap();

  // ─── Private helpers ─────────────────────────────────────────────────────────

  /**
   * Resolve the merged options for a given slider element.
   * Named config (from class) is the base; data-splide JSON overrides on top.
   *
   * @param  {Element} el
   * @return {Object}
   */
  function resolveOptions(el) {
    var config = {};

    // Apply named config if the element carries the matching class
    Object.keys(CONFIGS).forEach(function(key) {
      if (el.classList.contains(key)) {
        // Shallow-clone so mutations don't pollute the shared CONFIGS entry
        config = Object.assign({}, CONFIGS[key]);
        // Deep-clone breakpoints sub-object if present
        if (config.breakpoints) {
          config.breakpoints = Object.assign({}, config.breakpoints);
        }
      }
    });

    // data-splide attribute overrides named config
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

  // ─── Public API ──────────────────────────────────────────────────────────────

  /**
   * Mount a single Splide element.
   * Safe to call on an already-mounted element — will be skipped.
   *
   * @param {Element} el  The .splide root element.
   */
  function mountOne(el) {
    // Guard: already tracked by us
    if (instances.has(el)) return;

    // Guard: Splide itself marks mounted elements with this class
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

  /**
   * Destroy a mounted slider instance.
   * Useful before AJAX re-renders that replace slider HTML.
   *
   * @param {Element} el  The .splide root element.
   */
  function destroyOne(el) {
    if (!instances.has(el)) return;

    try {
      instances.get(el).destroy();
    } catch (e) {
      console.warn('OFPSlider: Error while destroying slider on', el, e);
    }

    instances.delete(el);
  }

  /**
   * Scan the page and mount every uninitialised .splide element.
   * Safe to call multiple times — already-mounted sliders are skipped.
   * Call this after injecting dynamic content via AJAX.
   */
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

// Initialise all sliders once the DOM is ready.
// Using DOMContentLoaded (not window load) is intentional: Splide does not
// need images to be loaded to calculate layout correctly.
document.addEventListener('DOMContentLoaded', function() {
  OFPSlider.init();
});