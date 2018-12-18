<?php
/*
Plugin Name: WooCommerce Cart & Checkout Same Page
Plugin URI: https://github.com/anup04sust
Description: This Plugin make content cart in checkout page 
Author: Anup Biswas
Version: 1.6
Author URI: https://github.com/anup04sust
*/
add_action( 'woocommerce_before_checkout_form', 'wc_cartcheckout_cart_on_checkout_page_only', 5 );
 
function wc_cartcheckout_cart_on_checkout_page_only() {
 
if ( is_wc_endpoint_url( 'order-received' ) ) return;
 
// NOTE: I had to change the name of the shortcode below...
// ...as it would have displayed this site's Cart...
// ... make sure to use "woocommerce_cart" inside "[]":
 
echo do_shortcode('[woocommerce_cart]');
 
}

add_action( 'template_redirect', 'wc_cartcheckout_redirect_empty_cart_checkout_to_home' );
 
function wc_cartcheckout_redirect_empty_cart_checkout_to_home() {
    if ( is_cart() && is_checkout() && 0 == WC()->cart->get_cart_contents_count() && ! is_wc_endpoint_url( 'order-pay' ) && ! is_wc_endpoint_url( 'order-received' ) ) {
        wp_safe_redirect( home_url() );
        exit;
    }
}