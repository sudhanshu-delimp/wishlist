<?php

if(!is_user_logged_in()){
    exit();
}

$classname = $wishtext = '';
if (!is_wishlist_exists($attributes['product_id'])) {
    $classname = 'fa-regular';
    $wishtext = 'Add to Wishlist';
    $anchorclassname = 'add_wishlist';
} else {
    $classname = 'fa-solid';
    $wishtext = 'Already Added to Wishlist';
    $anchorclassname = 'remove_wishlist';
}
$custom_class = 'wishlist_add_to_cart'; 
if ( WC()->cart && ! WC()->cart->is_empty() ) {
    foreach( WC()->cart->get_cart() as $cart_item_key => $values ) {
       $product = $values['product_id'];
       if ( $attributes['product_id'] == $product ) {
        $custom_class = 'wishlist_view_request_list'; 
        break;
       }
    }
 }
?>

<div class="<?php echo $attributes['class'].' '.$custom_class; ?>">
    <a class="add_wishlist_btn <?php echo $anchorclassname; ?>" data-product-id="<?php echo $attributes['product_id']; ?>" data-brand-id="<?php echo $attributes['brand_id']; ?>"><i class="<?php echo $classname; ?> fa-heart"></i><?php echo $wishtext; ?></a>
</div>