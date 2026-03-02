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