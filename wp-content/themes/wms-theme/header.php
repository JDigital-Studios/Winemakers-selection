<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="d929cf55-5fbd-4e6e-8fd6-d0d72fd9f8de" data-blockingmode="auto"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-798SGJ79BJ"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-798SGJ79BJ');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta class="foundation-mq">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">
	<link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png" rel="apple-icon-touch-icon" />	
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="https://use.typekit.net/fhg5slu.css">

    <?php wp_head(); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- <script>(function(d){var s = d.createElement("script");s.setAttribute("data-account", "OQBfWXhU5x");s.setAttribute("src", "https://cdn.userway.org/widget.js");(d.body || d.head).appendChild(s);})(document)</script><noscript>Please ensure Javascript is enabled for purposes of <a href="https://userway.org">website accessibility</a></noscript> -->
    <script>
    jQuery(function($) {
        $(document).ready(() => {
            var modal_content,
                modal_screen;
                $(document).ready(function() {
                    av_legality_check();
                });
                av_legality_check = function() {
                    if ($.cookie('is_legal') == "yes") {} else {
                        av_showmodal();
                        $(window).on('resize', av_positionPrompt);
                    }
                };
                av_showmodal = function() {
                    modal_screen = $('<div id="modal_screen" role="img"></div>');
                    modal_content = $('<div id="modal_content" style="display:none" role="dialog" aria-modal="true"></div>');
                    var modal_content_wrapper = $('<div id="modal_content_wrapper" class="content_wrapper"></div>');
                    var modal_regret_wrapper = $('<div id="modal_regret_wrapper" class="content_wrapper" style="display:none;"></div>');
                    var content_image = $('<div class="age_gate_header"><img src="https://www.winemakersselection.com/wp-content/themes/wms-theme/assets/images/wms-reserve-logo.svg" title="Winemakers Selection" alt="Winemakers Selection" /></div>');
                    var content_buttons = $('<div role="tablist" aria-label="Age Gate"><span class="heading_1">Are you of legal drinking age?</span><div class="agree"><label for="agree" class="show-for-sr">I agree to the Terms of Service and Privacy Policy</label><input type="checkbox" id="agree" class="btn-default" required name="agree" role="tab" aria-selected="true" tabindex="1"></input> I agree to the <a data-fancybox data-type="iframe" data-src="terms-of-service.html" role="tab">Terms of Service</a> and <a data-fancybox data-type="iframe" data-src="privacy-policy.html" role="tab">Privacy Policy</a></div></div>');
                    var content_text = $('<p>You must be at least 21 years old to view this site. By clicking "yes" you affirm that you are at least 21 years old. </p><nav><div class="btn_container"><button type="button" class="btn av_btn av_go" rel="yes" id="yes" role="tab" tabindex="2">Yes</button> <button type="button" class="btn av_btn av_no" rel="no" id="no" role="tab" tabindex="3">No</button></div></nav><p style="margin-top:20px;">You can learn more about how we use cookies by reviewing our <a data-fancybox data-type="iframe" data-src="privacy-policy.html">Privacy Policy</a>.</p>');
                    var content_footer = $('<footer class="footer"><p><small>&copy; <?php echo date('Y'); ?> Winemakers Selection Wines, Livermore, CA</small></p></footer>');
                    var regret_text = $('<h2 style="color: #000;margin: 200px auto;max-width: 50%;">You must be 21 years of age or older to view this site.</h2>');
                    modal_content_wrapper.append(content_image, content_buttons, content_text, content_footer);
                    modal_regret_wrapper.append(regret_text);
                    modal_content.append(modal_content_wrapper, modal_regret_wrapper);
                    $('body').append(modal_screen, modal_content);
                    av_positionPrompt();
                    modal_content.find('.av_btn').on('click', av_setCookie);
                };
                av_setCookie = function(e) {
                    e.preventDefault();
                    var is_legal = $(e.currentTarget).attr('rel');
                    $.cookie('is_legal', is_legal, {
                        expires: 30,
                        path: '/'
                    });
                    if ($("#agree").is(':checked') && (is_legal == "yes")) {
                        av_closeModal();
                        $(window).off('resize');
                    } else if (is_legal == "no") {
                        av_showRegret();
                    } else if (!$("#agree").is(':checked')) {
                        alert('You must agree to the terms of service.');
                    }
                };
                av_closeModal = function() {
                    modal_content.fadeOut();
                    modal_screen.fadeOut();
                };
                av_showRegret = function() {
                    modal_screen.addClass('nope');
                    modal_content.find('#modal_content_wrapper').hide();
                    modal_content.find('#modal_regret_wrapper').show();
                };
                av_positionPrompt = function() {
                    var top = ($(window).outerHeight() - $('#modal_content').outerHeight()) / 2;
                    var left = ($(window).outerWidth() - $('#modal_content').outerWidth()) / 2;
                    modal_content.css({
                        'top': top,
                        'left': left
                    });
                    if (modal_content.is(':hidden') && ($.cookie('is_legal') != "yes")) {
                        modal_content.fadeIn('slow');
                    }
                };
            });  
        });
</script>

	<script>
  function onClick(e) {
    e.preventDefault();
    grecaptcha.enterprise.ready(async () => {
      const token = await grecaptcha.enterprise.execute('6Lfc8sYrAAAAAG-TYNoe5xfsAlTX_mlzCRpqjJAx', {action: 'LOGIN'});
    });
  }
</script>
</head>
<body <?php body_class(); ?>>
    <div class="off-canvas-wrapper">
        <?php get_template_part('parts/content', 'offcanvas'); ?>
        <div class="off-canvas-content" data-off-canvas-content>
            <header class="header grid-container full" role="banner">
                <?php get_template_part('parts/nav', 'offcanvas-topbar'); ?>
            </header>