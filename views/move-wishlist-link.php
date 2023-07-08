<?php

if(!is_user_logged_in()){
    exit();
}

$wishtext = '';
if (!is_wishlist_exists($attributes['product_id'])) {
    $wishtext = 'Move to Wishlist';
    $anchorclassname = 'add_wishlist add_wishlist_btn';
} else {
    $wishtext = 'Already added to Wishlist';
    $anchorclassname = 'remove_wishlist';
}
?>
<a data-product-id="<?php echo $attributes['product_id']; ?>" data-brand-id="<?php echo $attributes['brand_id']; ?>" class="btn bg-light btn-move-wishlist move_wishlist_btn <?php echo $anchorclassname; ?>" href="javascript:void(0)"><?php echo $wishtext; ?></a>