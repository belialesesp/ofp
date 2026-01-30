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