<?php
class wmcid_DeleteCartItems{
	
	function __construct() {
			add_action('wp_enqueue_scripts', array($this,'wmcid_enqueue_front_scripts'),10,2);
			add_action('woocommerce_cart_item_remove_link',array($this,'wmcid_cart_item_checkbox'),10,2);
			add_action('woocommerce_before_cart_table',array($this,'wmcid_delete_cart_items_button'),10,2);
			add_action('wp_ajax_delete_cart_items', array($this,'wmcid_delete_cart_items')); 
			add_action('wp_ajax_nopriv_delete_cart_items',array($this,'wmcid_delete_cart_items'));
		}

	/**
	* Check woocommerce plugin is activated or not on plugin activation
	*/	
	public function wmcid_woocommerce_exists(){
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	        } else {
				deactivate_plugins( plugin_basename( __FILE__ ) );
            	wp_die( __( 'Please activate WooCommerce plugin first.', 'wc-multiple-cart-items-delete' ), 'Plugin dependency check', array( 'back_link' => true ) );
			}
	}	

	/**
	* Included custom javascript and ajax url
	*/	
	public function wmcid_enqueue_front_scripts(){
		wp_register_style('wcmcid-custom-style',WMCID_PLUGIN_DIR_URL.'css/custom.css');
 		wp_enqueue_style('wcmcid-custom-style');

		wp_enqueue_script('jquery');
		wp_register_script('wcmcid-custom-script',WMCID_PLUGIN_DIR_URL.'js/custom.js');
 		wp_enqueue_script('wcmcid-custom-script');
 		wp_localize_script('wcmcid-custom-script', 'Ajax', 
 			array(
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'minimum_item_msg' => __(apply_filters('minimum_item_msg_text','Please Select minimum 1 cart item to be deleted'),'wc-multiple-cart-items-delete'),
      'confirm_item_msg' => __(apply_filters('confirm_item_msg_text','Are you sure want to delete items'),'wc-multiple-cart-items-delete')
      		));	

	}


	/**
	 * Hook(woocommerce_cart_item_remove_link) callback function 
	 *
	 * @param array $html Cart item remove link html
	 * @param string $cart_item_key Unique Cart item key
	 */
	public function wmcid_cart_item_checkbox($html,$cart_item_key){
		$checkbox_html = '<span class="checkbox-wrapper"><input type="checkbox" name="cart-item-checkbox[]" value="'.$cart_item_key.'" class="cart-item-checkbox"></span>';
		return $checkbox_html.$html;
	}

	/**
	 * Hook(woocommerce_cart_item_remove_link) callback function 
	 *
	 * @param array $html Cart item remove link html
	 * @param string $cart_item_key Unique Cart item key
	 */
	public function wmcid_delete_cart_items_button(){
		$html = '<div class="checkall-block"><span class="checkall-box"><input type="checkbox" name="item-checkall" class="item-checkall"></span><button type="button" class="button delete-cart-items" name="delete_cart_items" value="'.__('Delete cart items','wc-multiple-cart-items-delete').'">'.__(apply_filters('delete_items_text','Delete cart items'),'wc-multiple-cart-items-delete').'</button></div>';
		echo $html;
	}


	/**
	* Ajax event which will call on "Delete Cart Items" Button on Cart page
	*/
	public function wmcid_delete_cart_items(){
    	$cart_keys = sanitize_text_field(trim($_POST['cart_keys']));
    	$cart_keys_array = explode(',',$cart_keys);
		    foreach ($cart_keys_array as $value) {
		       WC()->cart->remove_cart_item($value);
		    }
	    $resultArray = array('error'=>0);
	    echo json_encode($resultArray);
	    wp_die();
	}
}
new wmcid_DeleteCartItems();