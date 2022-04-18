<?php

add_theme_support('title-tag');
add_theme_support('post-thumbnails', array('post'));
add_theme_support('custom-logo', array());

// Image size for single posts
add_image_size('bongo-thumbnail', 300, 200);

register_nav_menu('main-menu', 'Main menu');





add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );
function remove_block_css() {
wp_dequeue_style( 'wp-block-library' ); // WordPress core
wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
wp_dequeue_style( 'wc-block-style' ); // WooCommerce
wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
}




function bongotheme_register_style()
{
    $ver = rand();

    wp_enqueue_style('bongotheme', get_template_directory_uri() . '/style.css', array('bootstrap'), $ver, 'all');
   wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array('bootstrap'), $ver, 'all');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array(), '1.0', 'all');
    wp_enqueue_style('ripple', get_template_directory_uri() . '/assets/ripple/ripple.css', array(), '1.0', 'all');

}
add_action('wp_enqueue_scripts', 'bongotheme_register_style');

function bongotheme_register_scripts()
{
    $ver = rand();
    wp_enqueue_script('popper', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.bundle.min.js', array(), '1.0', $in_footer = true);
    wp_enqueue_script('lightbox', 'https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.0/dist/index.bundle.min.js', array('bongotheme'), '1.0', $in_footer = true);
    wp_enqueue_script('bongotheme', get_template_directory_uri() . '/assets/js/index.js', array(), $ver, $in_footer = true);
   // wp_enqueue_script('fontawesome',get_template_directory_uri() . '/assets/fontawesome-free-6.1.1-web/js/all.min.js', array(), '1.2', $in_footer = false);
    wp_enqueue_script('ripple', get_template_directory_uri() . '/assets/ripple/ripple.js', array(),  $ver, $in_footer = true);

}
add_action('wp_enqueue_scripts', 'bongotheme_register_scripts');

function bongotheme_getLogo()
{
    $logo = get_theme_mod('custom_logo');
    $image = wp_get_attachment_image_src($logo, 'full');

    if ($image == "") {
        $image_url = "https://nagadtips.com/wp-content/uploads/2021/08/nagadtips-min.png";
    } else {
        $image_url = $image[0];
    }
    return $image_url;
}


function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');


function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

include('inc/functions/nav-walker.php');
include('inc/functions/plugin-checker.php');
include('inc/functions/widgets.php');




function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
                the_title();
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    }  elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}




