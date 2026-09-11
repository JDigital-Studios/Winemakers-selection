<?php
require_once(get_template_directory().'/functions/theme-support.php'); 
require_once(get_template_directory().'/functions/cleanup.php'); 
require_once(get_template_directory().'/functions/enqueue-scripts.php'); 
require_once(get_template_directory().'/functions/menu.php'); 
require_once(get_template_directory().'/functions/cookiebot-dnspi.php'); 
//require_once(get_template_directory().'/functions/sidebar.php'); 
//require_once(get_template_directory().'/functions/comments.php'); 
require_once(get_template_directory().'/functions/page-navi.php'); 
require_once(get_template_directory().'/functions/translation/translation.php'); 
// require_once(get_template_directory().'/functions/editor-styles.php'); t
require_once(get_template_directory().'/functions/disable-emoji.php'); 
// require_once(get_template_directory().'/functions/related-posts.php'); 
// require_once(get_template_directory().'/functions/login.php'); 
// require_once(get_template_directory().'/functions/admin.php'); 
add_filter('jpeg_quality', function($arg){return 100;});
// Add wines to body class
function add_wine_to_body($wine) {
    global $post;
    if (isset($post)) {
        $wine[] = $post->post_name;
    }
    return $wine;
}
add_filter('body_class', 'add_wine_to_body');
// ACF
add_filter( 'acf/the_field/allow_unsafe_html', function( $allowed, $selector ) {
    if ( $selector === "content" ) {
        return true;
    }
    return $allowed;
}, 10, 2);

// CF7 hack
remove_action( 'wpcf7_swv_create_schema', 'wpcf7_swv_add_select_enum_rules', 20, 2 );

// ACF Allowed Tags
add_filter( 'wp_kses_allowed_html', 'acf_add_allowed_iframe_tag', 10, 2 );
function acf_add_allowed_iframe_tag( $tags, $context ) {
   if ( $context === 'acf' ) {
      $tags['iframe'] = array(
         'src'             => true,
         'height'          => true,
         'width'           => true,
         'frameborder'     => true,
         'allowfullscreen' => true,
         'class'           => true,
      );

      $tags['script'] = array(
         'src' => true,
         'async' => true,
         'defer' => true,
         'charset' => true
      );

      $tags['link'] = array(
         'href' => true,
         'rel' => true,
         'title' => true,
         'type' => true
      );
   }

   return $tags;
}

// Remove ACF unsafe HTML notice 
add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' );