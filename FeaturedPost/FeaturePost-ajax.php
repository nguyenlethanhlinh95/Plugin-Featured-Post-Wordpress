<?php 
	/**
	 * Plugin Name: FeaturePost Plugin 
	 * Plugin URI: 
	 * Description: This is the Plugin for admin, add content for Footer.php
	 * Version: 1.0.0
	 * Author: ThanhLinh
	 * Author URI: 
	 */


	//SETTINGS DISPLAY PAGE FOR ADMIN
	$wptq_settings = '';
	add_action( 'admin_menu', 'wpsi_create_admin_menu' );
	function wpsi_create_admin_menu(){
	    add_menu_page( 'Feature Post Plugin', 'Feature Post Plugin', 'manage_options', 'setting_page', 'settings_page_content');
	}


	function settings_page_content(){
	    $all_settings = get_option( 'wpsi_settings' );
	    global $wpsi_settings;
	    $wpsi_settings = $all_settings;
	    ?>
	    <div class="wrap">
	        <h1>Feature Post</h1>
	        
	        <form method="post" action="options.php">
	            <?php
	            settings_fields( 'wpsi_settings_group' );
	            do_settings_sections( 'setting_page' );
	            ?>
	        	 
	        </form>
	        </div>
	   <?php
	}



	add_action( 'admin_init', 'wpsi_page_setting_init' );
	function wpsi_page_setting_init()
	{
	   		register_setting('wpsi_settings_group','cate');
	   		register_setting('wpsi_settings_group','display');
	   		register_setting('wpsi_settings_group','code');
	   		//register_setting('wpsi_settings_group','where_to_show');

	   		

	   		add_settings_field(
		       'trackingcode', // ID
		       'Choose Category', // Title
		       'choose_cate', // Callback
		       'setting_page', // Page
		       'Sharp_Section' // Section
		   );

	   		add_settings_field(
		       'active_tracking', // ID
		       'Chosse display', // Title
		       'choose_display', // Callback
		       'setting_page', // Page
		       'Sharp_Section' // Section
		   );


	   		add_settings_section(
		       'Sharp_Section', // ID
		       '', // Title
		       '', // Callback
		       'setting_page' // Page
		   );


		   add_settings_field(
		       'Genereate', // ID
		       'Get code', // Title
		       'get_code', // Callback
		       'setting_page', // Page
		       'Sharp_Section' // Section
		   );
	      
	}	

	

	function choose_cate()
	{
	   ?>
	   <!-- <textarea class="textarea" style="width: 600px; height: 400px;"  name="Sharp_TextArea"><?php echo get_option('Sharp_TextArea'); ?></textarea> -->
		
		
		<!-- Get category -->
		<?php $cate_id = get_option('cate'); ?>

	   <select id="select_Category" name="cate">
	   		<option value="">Choose Category</option>	
		   	<?php $args = array( 
			    'hide_empty' => 0,
			    'taxonomy' => 'category',
			    'orderby' => id,
			    ); 
			    $cates = get_categories( $args ); 
			    foreach ( $cates as $cate ) {  ?>			    
					<option value="<?php echo $cate->term_id;?>"><?php echo $cate->name ?></option>
			<?php } ?>
		</select>



		<script>
			//document.getElementById("select_Category").onchange 
		</script>
	   <?php


	}

	function choose_display()
	{

	   ?>
	
		<?php $display = get_option('display'); ?>
		   <select id="select_display" name="display">
			  <option value="" >Choose display</option>
			  <option value="grid" >Grid</option>
			  <option value="list" >List</option>
			  <option value="carousel" >Carousel</option>
			</select>
	   <?php
	}

	function get_code()
	{?>
			<textarea id="txt_area" style="width: 400px; height: 200px;"  name="Sharp_TextArea"></textarea>
			<br>
			<a id="getCode">Get code</a>

			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
			<script>
				$('#getCode').click(function(event) {
					/* Act on the event */
					event.preventDefault();
					var display = $('#select_display option:selected').val();
					var cate = $('#select_Category option:selected').val();
					//var where = $('#whereToShow option:selected').val();

					$('#txt_area').val('[featured_post cate="'+cate+'" display="' +display+'"]');
					//[myshortcode cate="+cate+" choose=" +display+"]
				});
			</script>

			<style>
				/*a#getCode {
					    color: #01151e;
					    background: #7fcd5d;
					    margin-top: 17px !important;
					    display: inline-block;
					    padding: 7px 12px;
					    cursor: pointer;
					}*/

					a#getCode{
						color: #fff;
					    background: #0085ba;
					    border-color: #0073aa #006799 #006799;
					    margin-top: 17px !important;
					    display: inline-block;
					    padding: 7px 12px;
					    text-shadow: 0 -1px 1px #006799, 1px 2px 1px #006799, 0 1px 1px #006799, -1px 0 1px #006799;
					    cursor: pointer;
					    border-radius: 20px;
					}
			</style>
	<?php }


	// shortCode
	add_shortcode( 'featured_post', 'create_featured_post'  );

	function create_featured_post($atts)
	{
		if ( empty($atts) )
		{
			 $display = "";
			 $cate = "";
		}
		else{
			$display = $atts['display'];
			$cate    = $atts['cate'];
		}
		

		//if not choose cate then will get all Feature post have check.
		if ($cate == '')
		{
			$args = array( 
				    'meta_key'   => 'meta-checkbox',
				    'meta_value' => 'yes' 
				    ); 
			$getposts = new WP_Query($args);

			switch($display)
		    {
		    	case "grid":
		    		include_once(plugin_dir_path( __FILE__ ). 'template-parts/show-grid.php');
		    	break;

		    	case "list":
		    		include_once(plugin_dir_path( __FILE__ ). 'template-parts/show-list.php');
		    	break;

		    	case "carousel":
		    		include_once(plugin_dir_path( __FILE__ ). 'template-parts/show-carousel.php');
		    	break;

		    	default:
		    		include_once(plugin_dir_path( __FILE__ ). 'template-parts/show-list.php');
		    }
		}
		else
		{
			$dem = 0;
			$args = array( 
				    'hide_empty' => 0,
				    'taxonomy'   => 'category',
				    'orderby'    => id
				    ); 
			$cates = get_categories( $args ); 
		    foreach ( $cates as $cat )
		    {
		    	if ($cat->term_id == $cate )
			 		{ 
			 			$dem = 1; 
			 			break; 
			 		}
		    }		    
			if ( $dem == 1)
			{
				$getposts = new WP_query(); $getposts->query("post_status=publish&post_type=post&cat=".$cate);
				$check_all_list = 1;
				switch($display)
				    {
				    	case "grid":
				    		include_once(plugin_dir_path( __FILE__ ). 'template-parts/show-grid.php');
				    	break;

				    	case "list":
				    		include_once(plugin_dir_path( __FILE__ ). 'template-parts/show-list.php');
				    	break;

				    	case "carousel":
				    		include_once(plugin_dir_path( __FILE__ ). 'template-parts/show-carousel.php');
				    	break;

				    	default:
				    		include_once(plugin_dir_path( __FILE__ ). 'template-parts/show-list.php');
				    }

			}
			else
			{
				echo '<h2>Category Not Found !</h2>';
				

			}
		}

		

	}
	
	
	
	

	// FOR ADMIN CHECKBOX
	add_theme_support('post-thumbnails');
	add_image_size('featured_preview', 55, 55, true);
	// GET FEATURED IMAGE
	function ST4_get_featured_image($post_ID) {
	    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
	    if ($post_thumbnail_id) {
	        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
	        return $post_thumbnail_img[0];
	    }
	}


	// ADD NEW COLUMN
	function ST4_columns_head($defaults) {
	    $defaults['featured_image'] = 'Featured check';
	    return $defaults;
	}
	  
	// SHOW THE FEATURED IMAGE
	function ST4_columns_content($column_name, $post_ID) {
	    if ($column_name == 'featured_image') {
	        $post_featured_image = ST4_get_featured_image($post_ID);
	        $featured = get_post_meta( $post_ID );
	        ?>
	            <!-- <img src="' . $post_featured_image . '" style="width:50px; height:50px; object-fit:cover;" /> -->
	            <input type="checkbox" data-id="<?php echo $post_ID ?>" class="check_col" 
	            	<?php if ($featured['meta-checkbox'][0] == "yes") echo "checked"; ?> />
	            
	        <?php

	    }
	    ?>
		
	<?php }

	add_filter('manage_posts_columns', 'ST4_columns_head');
	add_action('manage_posts_custom_column', 'ST4_columns_content', 10, 2);





	// checkbox for single post

	// add checkbox
	function sm_custom_meta() {
    	add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback', 'post' );
	}
	function sm_meta_callback( $post ) {
	    $featured = get_post_meta( $post->ID );
	    ?>
	 
		<p>
	    <div class="sm-row-content">
	        <label for="meta-checkbox">
	            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
	            <?php _e( 'Featured this post', 'sm-textdomain' )?>
	        </label>
	        
	    </div>
	</p>
	 
	    <?php
	}
	add_action( 'add_meta_boxes', 'sm_custom_meta' );
	//end add checkbox

	/**
	 * Saves the custom meta input
	 */
	function sm_meta_save( $post_id ) {
	 	$featured = get_post_meta( $post_id );
	    // Checks save status
	    $is_autosave = wp_is_post_autosave( $post_id );
	    $is_revision = wp_is_post_revision( $post_id );
	    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
	 
	    // Exits script depending on save status
	    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
	        return;
	    }
	 
	 // Checks for input and saves
	if( isset( $_POST[ 'meta-checkbox' ] ) ) {
	    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
	    checked( $featured['meta-checkbox'][0], 'yes');
	} else {
	    update_post_meta( $post_id, 'meta-checkbox', '' );
	    checked( $featured['meta-checkbox'][0], 'no');
	}
	 
	}
	add_action( 'save_post', 'sm_meta_save' );


	// end checkbox for single post




add_action( 'admin_footer', 'my_action_javascript' ); // Write our JS below here

function my_action_javascript() { ?>
	<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  
	<script type="text/javascript" >
		jQuery(document).ready(function($) {
			$('.check_col').click(function(event) {
				var data = $(this).attr('data-id');
				$.ajax({
	                url: "<?php echo admin_url( 'admin-ajax.php')  ?>",
	                type: 'post',
	                data: {
	                	action:'featured_meta_ajax',
	                    id:data
	                }
	            });
			});
		});
	</script> <?php
}

//ajax
 add_action('wp_ajax_featured_meta_ajax', 'featured_meta_ajax_function');
 //add_action('wp_ajax_nopriv_random', 'random_function');
 function featured_meta_ajax_function() {
    $post_id = $_POST['id'];
    //$post_id = trim($post_id);
    //echo $post_id;
  	echo $post_id;
    $featured = get_post_meta($post_id);
	if ($featured['meta-checkbox'][0] == '')
	{
		update_post_meta( $post_id, 'meta-checkbox', 'yes' );
	}
	else
	{
		update_post_meta( $post_id, 'meta-checkbox', '' );
	}
	 die();
}

//end ajax



add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() 
{
	add_image_size( 'thumnail_small', 320, 325, true); 
}



 ?>