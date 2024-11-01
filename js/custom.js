jQuery(document).ready(function($){
	ajax_url = Ajax.ajaxurl;
	minimum_item_msg= Ajax.minimum_item_msg;
	confirm_item_msg= Ajax.confirm_item_msg;


	deleteCartItemsEvent();

	jQuery( document.body ).on( 'updated_cart_totals', function(){
    		deleteCartItemsEvent();
		});

	function deleteCartItemsEvent(){
			jQuery('.item-checkall').prop('checked', false);
			jQuery('.cart-item-checkbox').prop('checked', false);
			
				jQuery(".item-checkall").change(function(){  
		   			 var status = this.checked; 
				    jQuery('.cart-item-checkbox').each(function(){ 
				        this.checked = status;
				    });
				});

			jQuery(".delete-cart-items").click(function(){
						cartItemArray = [];
			    			jQuery(".cart-item-checkbox:checkbox:checked").each(function () {
			            		cartItemArray.push(jQuery.trim(jQuery(this).val()));
			        		});


			        		if(cartItemArray.length > 0){
			        			if(confirm(confirm_item_msg)){
									jQuery.ajax({
							            url: ajax_url,
							            type:'POST',
							            dataType: "json",
							            data:  
										{'action': 'delete_cart_items',
							              'cart_keys' :cartItemArray.join(),
							            },
							            success:function(result) {
							            	if(result.error == 0){
							            		location.reload();	
							            	}
							            	
							            },
							            error: function(errorThrown){
							            	console.log(errorThrown);
							            }
					   				});
				   				}	
			        		}else{
			        			alert(minimum_item_msg);
			        			return false;
			        		}
				
		        });
		}

});
