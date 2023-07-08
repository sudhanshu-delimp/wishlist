<?php


/*
Plugin Name:  Ilola Wishlist Plugin
Plugin URI:   https://ilolas.com/ 
Description:  A plugin to add products to wishlist
Version:      1.0
Author:       Delimp 
Author URI:   https://delimp.com/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/


if (!defined('ABSPATH')) {
    exit;
}

$plugin_url = plugin_dir_path(__FILE__);

include_once $plugin_url . 'inc/helpers.php';
include_once $plugin_url . 'action.php';
include_once $plugin_url . 'method.php';

wp_enqueue_style('toaster-css', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css');
wp_enqueue_script('toaster-js', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js', array('jquery'), rand(), true);
wp_enqueue_script('ilola_wishlist_script', plugin_dir_url(__FILE__) . 'inc/js/wishlist.js', array('jquery'), rand(), true);
wp_localize_script('ilola_wishlist_script', 'ilola', ['action_url' => admin_url("admin-ajax.php"), 'user_id' => get_current_user_id()]);
wp_enqueue_script('ilola_fontawesome_script', 'https://kit.fontawesome.com/4401dddf60.js', array('jquery'), rand(), true);
