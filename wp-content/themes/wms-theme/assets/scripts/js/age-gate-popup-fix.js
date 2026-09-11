/* Age-gate legal popups: ensure close X is always visible and iframe is viewport-bound. */
jQuery(document).ready(function($) {
    if (typeof $.fn.fancybox === 'undefined') {
        return;
    }

    // Re-initialize age-gate legal links with explicit always-visible toolbar.
    $('#modal_content a[data-fancybox]').fancybox({
        toolbar: true,
        smallBtn: false,
        iframe: {
            css: {
                width: '100%',
                height: '100%'
            }
        },
        baseClass: 'twg-legal-agegate-popup'
    });
});
