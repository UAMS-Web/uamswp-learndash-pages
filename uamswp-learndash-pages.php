<?php

declare(strict_types=1);
/*
Plugin Name: UAMS 2020 - Learndash
Plugin URI: https://www.uams.edu/
Description: Add clases for UAMS 2020 theme to Learndash pages
Version: 1.0.2
Requires PHP: 8.2
Author: UAMS Web Services
Author URI: https://communications.uams.edu/web/
License: GPLv2 or later
Text Domain: uamswp
*/

// The header's Version is the only place the release number is written.
define('UAMSWP_LEARNDASH_VERSION', get_file_data(__FILE__, ['Version' => 'Version'])['Version']);

// * Add custom body class to the head
add_filter('body_class', 'uamswp_learndash_body_class');
/**
 * Add the default page template class on LearnDash course, lesson and quiz pages.
 *
 * @param  string[]  $classes  The body classes WordPress built for the request.
 * @return string[]
 */
function uamswp_learndash_body_class($classes)
{

    if (is_singular('sfwd-courses') || is_singular('sfwd-lessons') || is_singular('sfwd-quiz')) {
        $classes[] = 'page-template-default';
    }

    return $classes;

}

add_action('wp_enqueue_scripts', 'uamswp_learndash_css');
function uamswp_learndash_css(): void
{
    if (is_singular('sfwd-courses') || is_singular('sfwd-lessons')) {
        $dir = plugin_dir_url(__FILE__);
        wp_enqueue_style('uamswp-learndash', $dir.'/uams-2020-learndash.css', [], UAMSWP_LEARNDASH_VERSION, 'all');
    }
}

add_action('set_current_user', 'uamswp_hide_admin_bar');
function uamswp_hide_admin_bar(): void
{
    if (! current_user_can('edit_posts')) {
        show_admin_bar(false);
    }
}
