<?php


if (!function_exists('ilola_add_to_wishlist')) {
    function ilola_add_to_wishlist()
    {
        $response = [];
        $response['status'] = 0;
        try {
            global $wpdb;
            $tablename = $wpdb->prefix . 'ilola_wishlist';
            $product_id = $_POST['product_id'];
            $brand_id = $_POST['brand_id'];
            $user_id = get_current_user_id();
            $isExist = is_wishlist_exists($product_id, $user_id);
            if (!$isExist) {
                $insert = [];
                $insert['product_id'] = $product_id;
                $insert['brand_id'] = $brand_id;
                $insert['user_id'] = $user_id;
                $wpdb->insert($tablename, $insert);
                add_notification($user_id, $brand_id, "product_added_to_wishlist", "Your product has been added to a new Wishlist.", $product_id);
                $response['status'] = 1;
                $response['insert_id'] = $wpdb->insert_id;
                // $response['insert_data'] = $insert; 
                $response['message'] = 'Added successfully';
            } else {
                $response['message'] = 'Already added in wishlist';
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }
        echo json_encode($response);
        exit();
    }
}

if (!function_exists('ilola_remove_from_wishlist')) {
    function ilola_remove_from_wishlist()
    {
        $response = [];
        $response['status'] = 0;
        try {
            global $wpdb;
            $tablename = $wpdb->prefix . 'ilola_wishlist';
            $product_id = $_POST['product_id'];
            $brand_id = $_POST['brand_id'];
            $user_id = get_current_user_id();
            $isExist = is_wishlist_exists($product_id, $user_id);
            if ($isExist) {
                $where = [];
                $where['product_id'] = $product_id;
                $where['brand_id'] = $brand_id;
                $where['user_id'] = $user_id;
                $delete = $wpdb->delete($tablename, $where);
                // add_notification($user_id, $brand_id, "product_added_to_wishlist", "Your product has been removed from the Wishlist.", $product_id);
                if ($delete) {
                    $response['status'] = 1;
                    $response['message'] = 'Product removed from Wishlist';
                } else {
                    $response['message'] = 'Unable to remove from Wishlist';
                }
            } else {
                $response['message'] = 'Add to Wishlist';
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }
        echo json_encode($response);
        exit();
    }
}


if (!function_exists('is_wishlist_exists')) {
    function is_wishlist_exists($product_id)
    {
        global $wpdb;
        $user_id = get_current_user_id();
        $tablename = $wpdb->prefix . 'ilola_wishlist';
        $isExist = false;
        $sql = "SELECT id FROM $tablename WHERE product_id = '$product_id' and user_id = '$user_id'";
        $wpdb->get_results($sql);
        $num_rows = $wpdb->num_rows;
        if ($num_rows > 0) {
            $isExist = true;
        }
        return $isExist;
    }
}


if (!function_exists('ilola_delete_product_wishlist')) {
    function ilola_delete_product_wishlist()
    {
        global $wpdb;
        $wishlist_id = $_POST['wishlist_id'];
        $response = [];
        $response['status'] = 0;
        $tablename = $wpdb->prefix . 'ilola_wishlist';
        $delete = $wpdb->delete($tablename, ['id' =>  $wishlist_id, 'user_id' => get_current_user_id()]);
        if ($delete) {
            $response['status'] = 1;
            $response['message'] = 'Product removed from Wishlist';
        } else {
            $response['message'] = 'Unable to remove from Wishlist';
        }
        echo json_encode($response);
        exit();
    }
}

if (!function_exists('ilola_add_wishlist_link')) {
    function ilola_add_wishlist_link($atts)
    {
        global $plugin_url;
        $attributes = shortcode_atts(array(
            'product_id' => 0,
            'brand_id' => 0,
            'class' => ''
        ), $atts);

        $out_put_string = '';
        ob_start();
        include $plugin_url . 'views/wishlist-link.php';
        $out_put_string .= ob_get_contents();
        ob_end_clean();
        return $out_put_string;
    }
}

if (!function_exists('ilola_move_wishlist_link')) {
    function ilola_move_wishlist_link($atts)
    {
        global $plugin_url;
        $attributes = shortcode_atts(array(
            'product_id' => 0,
            'brand_id' => 0
        ), $atts);

        $out_put_string = '';
        ob_start();
        include $plugin_url . 'views/move-wishlist-link.php';
        $out_put_string .= ob_get_contents();
        ob_end_clean();
        return $out_put_string;
    }
}
