<?php 
/** create admin option theme **/
$themename = "Mely Amaliah";  
$shortname = "MA";

/** option array to create form **/
$options = array (
array( "name" => $themename." Options",
	"type" => "title"),

array( 	"name" => "General Profile",
		"type" => "section"),
array( 	"type" => "open"),
array( 	"name" => "About Me",
		"desc" => "Describe your in several word",
		"id" => $shortname."_aboutme",
		"type" => "textarea",
		"std" => ""),
array( 	"name" => "Email",
		"desc" => "Enter your email address",
		"id" => $shortname."_email",
		"type" => "text",
		"std" => ""),
array( 	"name" => "Phone Number",
		"desc" => "Enter Your Phone Number",
		"id" => $shortname."_phone",
		"type" => "text",
		"std" => ""),
array( 	"name" => "Twitter Username",
		"desc" => "Enter your twitter username to create your twitter timeline",
		"id" => $shortname."_twitter",
		"type" => "text",
		"std" => ""),
array( 	"name" => "Facebook Link",
		"desc" => "Enter your facebook link",
		"id" => $shortname."_facebook",
		"type" => "text",
		"std" => ""),
array( 	"name" => "flickr Link",
		"desc" => "Enter your flickr username to show your flickr gallery",
		"id" => $shortname."_flickr",
		"type" => "text",
		"std" => ""),
array( 	"name" => "vimeo Link",
		"desc" => "Enter your vimeo link",
		"id" => $shortname."_vimeo",
		"type" => "text",
		"std" => ""),
array( 	"type" => "close"),


array( "name" => "Footer",
	"type" => "section"),
array( "type" => "open"),
array( "name" => "Google Analytics Code",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""),
array( "type" => "close")

);

function mytheme_add_admin() {

	global $themename, $shortname, $options;
	
	if ( $_GET['page'] == basename(__FILE__) ) {
	
		if ( 'save' == $_REQUEST['action'] ) {
	
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
			}
	
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { 
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
				} 
				else { 
					delete_option( $value['id'] ); 
				}
			}
	
			header("Location: admin.php?page=theme-options.php&saved=true");
			die;
					
		}
		else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				delete_option( $value['id'] ); 
			}
					
			header("Location: admin.php?page=theme-options.php&reset=true");
			die;			
		}
	}
	
	add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {
	$file_dir=get_bloginfo('template_directory');
	wp_enqueue_style("functions", $file_dir."/css/functions.css", false, "1.0", "all");
}


function mytheme_admin() {

	global $themename, $shortname, $options;
	$i=0;

	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
?>
	<div class="wrap rm_wrap">
		<h2><?php echo $themename; ?> Settings</h2>
		<div class="rm_opts">
			<form method="post">
			<?php foreach ($options as $value) {
				switch ( $value['type'] ) {
					case "open":
					break;
					case "close":
			?>
						</div>
						</div>
						<br />
			<?php 	break;
					case "title":
			?>
						<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>
			<?php 	break;
					case 'file':
			?>
						<div class="rm_input rm_text">
							<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 							<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 							<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
						</div>
			<?php 	break;
					case 'text':
			?>
						<div class="rm_input rm_text">
							<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
						 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
						 	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
						</div>
			<?php 	break;
					case 'textarea':
			?>
						<div class="rm_input rm_textarea">
							<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
							<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
							<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
						</div>
			<?php  	break;
					case 'select':
			?>
						<div class="rm_input rm_select">
							<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
							<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
							<?php foreach ($value['options'] as $option) { ?>
								<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option>
							<?php } ?>
							</select>
							<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
						</div>
			<?php 	break;
					case "checkbox":
			?>
						<div class="rm_input rm_checkbox">
							<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
							<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
							<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
							<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 						</div>
 			<?php 	break;
 					case "section":
 						$i++;
 			?>
 						<div class="rm_section">
 							<div class="rm_title">
 								<h3><img src="<?php bloginfo('template_directory')?>/images/masbenx2.png" class="inactive" alt="""><?php echo $value['name']; ?></h3>
 								<span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" /></span>
 								<div class="clearfix"></div>
 							</div>
							<div class="rm_options">
			<?php 	break;
				}
			}
			?>
			<input type="hidden" name="action" value="save" />
		</form>
		<form method="post">
			<p class="submit">
				<input name="reset" type="submit" value="Reset" />
				<input type="hidden" name="action" value="reset" />
			</p>
		</form>
		<div style="font-size:9px; margin-bottom:10px;">Icons: <a href="http://masbenx.net/">masbenx</a></div>
 	</div> 
<?php
}


add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');

/** end of admin option theme **/