<?php
function wms_cookiebot_dnspi_inline_script() {
    $js = <<<'JS'
/* Cookiebot Do Not Sell Or Share My Personal Information handler */
(function() {
  function openCookiebotDetails() {
    if (typeof Cookiebot !== 'undefined' && Cookiebot.renew) {
      Cookiebot.renew();
      var attempts = 0;
      var interval = setInterval(function() {
        var detailsTab = document.querySelector('button[aria-label*="Details"], button.CybotCookiebotDialogBodyLevelButton, .CookiebotBanner .Details, #CybotCookiebotDialogBodyLevelButtonLevelOptinAllowallSelection');
        if (detailsTab) {
          detailsTab.click();
          clearInterval(interval);
        }
        attempts++;
        if (attempts > 50) clearInterval(interval);
      }, 100);
    } else {
      window.alert('Cookiebot consent manager is loading. Please try again in a moment.');
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href*="#dnspi"]').forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        openCookiebotDetails();
      });
    });
  });
})();
JS;
    wp_register_script( 'wms-dnspi', '', [], '3.0', true );
    wp_enqueue_script( 'wms-dnspi' );
    wp_add_inline_script( 'wms-dnspi', $js );
}
add_action( 'wp_enqueue_scripts', 'wms_cookiebot_dnspi_inline_script', 1000 );
