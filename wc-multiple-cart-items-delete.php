<?php
/**
 * Plugin Name: WC Multiple Cart Items Delete
 * Description: Delete multiple cart items in bulk on cart page 
 * Version: 1.0.0
 * Author: Gunjan Patel
 * Author URI: https://profiles.wordpress.org/gunjanpatel
 * License: GPLv2 or later
 * Text Domain: wc-multiple-cart-items-delete
 */

register_activation_hook( __FILE__,array('wmcid_DeleteCartItems','wmcid_woocommerce_exists'));
define('WMCID_PLUGIN_NAME','WC Multiple Cart Items Delete');
define('WMCID_PLUGIN_DIR_URL',plugin_dir_url(__FILE__));
include_once 'controller.php';