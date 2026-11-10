<?php

declare(strict_types=1);
/*
Plugin Name: UAMS 2020 - Learndash
Plugin URI: https://www.uams.edu/
Description: Add clases for UAMS 2020 theme to Learndash pages
Version: 1.0.0
Requires PHP: 8.2
Author: Todd McKee
Author URI:
License: GPLv2 or later
Text Domain: uamswp
*/
// * Add custom body class to the head
add_filter('body_class', 'uamswp_learndash_body_class');
function uamswp_learndash_body_class($classes)
{

    if (is_singular('sfwd-courses') || is_singular('sfwd-lessons') || is_singular('sfwd-quiz')) {
        $classes[] = 'page-template-default';
    }

    return $classes;

}
add_action('wp_enqueue_scripts', 'uamswp_learndash_css');
function uamswp_learndash_css()
{
    if (is_singular('sfwd-courses') || is_singular('sfwd-lessons')) {
        $dir = plugin_dir_url(__FILE__);
        wp_enqueue_style('uamswp-learndash', $dir.'/uams-2020-learndash.css', [], '0.1.0', 'all');
    }
}

add_action('set_current_user', 'uamswp_hide_admin_bar');
function uamswp_hide_admin_bar()
{
    if (! current_user_can('edit_posts')) {
        show_admin_bar(false);
    }
}
