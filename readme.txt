=== WC Multiple Cart Items Delete ===
Contributors: gunjanpatel
Donate link: https://profiles.wordpress.org/gunjanpatel
Tags: e-commerce,store,cart
Requires at least: 4.7
Tested up to: 4.9.8
Requires PHP: 5.6.0
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
Allows to delete multiple cart items in bulk on woocommerce cart page.
 
== Description ==

This "WC Multiple Cart Items Delete" plugin can be used to delete cart items in bulk on cart page using checkbox.
 
== Installation ==
 
Please check following steps for installation.

1. Add plugin to the /wp-content/plugins/ directory 

2. Check first Woocommerce plugin is activated or not from backend plugin list. If it's not activated then active it otherwise it will show error like 'Please activate WooCommerce plugin first'.

3. Activate the plugin from backend plugins list.

== Frequently Asked Questions ==
 
= How can i change "Delete Cart Items" button text?=
 
To change button text , you need to add filter in functions.php file of your activated theme/child theme.

add_filter('delete_items_text','delete_items_text_callback');
function delete_items_text_callback($string){
	$string = 'Delete Items';
	return $string;
}

== Screenshots ==
 
1. Note that the screenshot is existed in the "/images" directory of the plugin.(screenshot-1.png)

== Changelog ==

= 1.0.0 =
* Initial Release

== Upgrade Notice ==

= 1.0.0 =
* Initial Release