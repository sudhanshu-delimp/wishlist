<?php


add_action('wp_ajax_ilola_add_to_wishlist', 'ilola_add_to_wishlist');

add_action('wp_ajax_ilola_remove_from_wishlist', 'ilola_remove_from_wishlist');

add_action('wp_ajax_ilola_delete_product_wishlist', 'ilola_delete_product_wishlist');

add_shortcode('ilola_add_wishlist_link', 'ilola_add_wishlist_link');

add_shortcode('ilola_move_wishlist_link', 'ilola_move_wishlist_link');
