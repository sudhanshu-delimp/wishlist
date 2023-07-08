<?php


if (!function_exists('ilola_wishlist_items')) {
    function ilola_wishlist_items($user_id)
    {
        global $wpdb;
        $wishlist = [];
        $tablename = $wpdb->prefix . 'ilola_wishlist';
        $wishlist = $wpdb->get_results("SELECT * FROM $tablename WHERE user_id = {$user_id} ORDER BY id DESC");
        return $wishlist;
    }
}

if (!function_exists('ilola_brand_product_wishlist')) {
    function ilola_brand_product_wishlist($user_id)
    {
        global $wpdb;
        $wishlist = [];
        $tablename = $wpdb->prefix . 'ilola_wishlist';
        $wishlist = $wpdb->get_results("SELECT count(id) AS product_count,product_id FROM $tablename WHERE brand_id = {$user_id} GROUP BY product_id ORDER BY id DESC");
        return $wishlist;
    }
}
