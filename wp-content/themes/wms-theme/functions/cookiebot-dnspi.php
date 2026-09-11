<?php
/**
 * Cookiebot integration + "Do Not Sell Or Share My Personal Information" footer link.
 *
 * - Injects the Do Not Sell link immediately after Privacy Policy in the
 *   footer-links menu, regardless of what is stored in the DB.
 * - Wires the link (and legacy #dnspi links) to Cookiebot.renew() with a
 *   best-effort switch to the Details tab.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Build a synthetic footer menu item for the Do Not Sell link. */
function wms_make_footer_dnspi_item() {
	$item = new stdClass();

	$item->ID                    = 0;
	$item->db_id                 = 0;
	$item->object_id             = 0;
	$item->title                 = 'Do Not Sell Or Share My Personal Information';
	$item->url                   = '#cookie-settings';
	$item->target                = '';
	$item->attr_title            = '';
	$item->description           = '';
	$item->classes               = array(
		'menu-item',
		'menu-item-type-custom',
		'menu-item-object-custom',
		'wms-do-not-sell-link',
	);
	$item->xfn                   = '';
	$item->current               = false;
	$item->current_item_ancestor = false;
	$item->current_item_parent   = false;
	$item->menu_item_parent      = 0;
	$item->post_parent           = 0;
	$item->type                  = 'custom';
	$item->object                = 'custom';
	$item->type_label            = 'Custom Link';
	$item->menu_order            = 0;
	$item->_invalid              = false;

	return $item;
}

/**
 * Reorder the footer menu so the Do Not Sell link sits directly after Privacy
 * Policy. Any existing menu item with a "Do Not Sell" title is removed first to
 * avoid duplicates across environments.
 */
function wms_footer_links_insert_dnspi( $sorted_menu_items, $args ) {
	if ( empty( $args->theme_location ) || 'footer-links' !== $args->theme_location ) {
		return $sorted_menu_items;
	}

	$filtered = array();
	foreach ( $sorted_menu_items as $item ) {
		if ( isset( $item->title ) && false !== stripos( $item->title, 'Do Not Sell' ) ) {
			continue;
		}
		$filtered[] = $item;
	}

	$privacy_index = -1;
	foreach ( $filtered as $i => $item ) {
		if ( isset( $item->title ) && false !== stripos( $item->title, 'Privacy Policy' ) ) {
			$privacy_index = $i;
			break;
		}
	}

	$dnspi = wms_make_footer_dnspi_item();

	if ( -1 !== $privacy_index ) {
		array_splice( $filtered, $privacy_index + 1, 0, array( $dnspi ) );
	} else {
		$filtered[] = $dnspi;
	}

	return $filtered;
}
add_filter( 'wp_nav_menu_objects', 'wms_footer_links_insert_dnspi', 20, 2 );

/**
 * Enqueue a small inline script that opens Cookiebot and tries to land on the
 * Details tab when the Do Not Sell link is clicked.
 */
function wms_cookiebot_dnspi_inline_script() {
	$js = <<<'JS'
/* Cookiebot Do Not Sell Or Share My Personal Information handler */
(function() {
  function wmsOpenCookiebotDetails() {
    if (typeof Cookiebot === 'undefined' || typeof Cookiebot.renew !== 'function') {
      window.alert('Cookiebot consent manager is loading. Please try again in a moment.');
      return;
    }

    Cookiebot.renew();

    var attempts = 0;
    var maxAttempts = 60;
    var interval = setInterval(function() {
      var dialog = document.getElementById('CybotCookiebotDialog');
      if (!dialog) {
        attempts++;
        if (attempts > maxAttempts) {
          clearInterval(interval);
        }
        return;
      }

      var detailsBtn = dialog.querySelector(
        'button.CybotCookiebotDialogNavItemDetails, ' +
        'a.CybotCookiebotDialogNavItemDetails, ' +
        '#CybotCookiebotDialogTabDetails, ' +
        '[aria-controls="CybotCookiebotDialogBodyDetails"]'
      );

      if (!detailsBtn) {
        var buttons = dialog.querySelectorAll('button, a');
        for (var i = 0; i < buttons.length; i++) {
          var text = (buttons[i].textContent || buttons[i].innerText || '').trim();
          if (/Details/i.test(text)) {
            detailsBtn = buttons[i];
            break;
          }
        }
      }

      if (detailsBtn) {
        detailsBtn.click();
        clearInterval(interval);
      }

      attempts++;
      if (attempts > maxAttempts) {
        clearInterval(interval);
      }
    }, 100);
  }

  function wmsAttachDnspiHandlers() {
    var selectors = 'a[href="#cookie-settings"], a[href*="#dnspi"]';
    document.querySelectorAll(selectors).forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        wmsOpenCookiebotDetails();
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', wmsAttachDnspiHandlers);
  } else {
    wmsAttachDnspiHandlers();
  }
})();
JS;

	wp_register_script( 'wms-dnspi', '', array(), '4.0', true );
	wp_enqueue_script( 'wms-dnspi' );
	wp_add_inline_script( 'wms-dnspi', $js );
}
add_action( 'wp_enqueue_scripts', 'wms_cookiebot_dnspi_inline_script', 1000 );
