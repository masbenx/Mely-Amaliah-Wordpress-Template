<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head> 
	<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/mely.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js?ver=3.2.1'></script>
	<!-- google fonts -->
	<link href='http://fonts.googleapis.com/css?family=Rokkitt&amp;v2' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Istok+Web:400,700&amp;v2' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Play:400,700&amp;v2' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css" type="text/css" media="screen" />
	
	<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js'></script>
	<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.sticky.js'></script>
	<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/quicksand/jquery-css-transform.js'></script>
	<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/quicksand/jquery.easing.1.3.js'></script>
	<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/quicksand/quicksand.js'></script>	

	<?php if (is_page() || is_404()):?>
	<style type="text/css">
		.post .frame {
			width:660px;
		}
	</style>
	<?php endif;?>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );?>
	<?php wp_head();?>
</head>
<?php 
if (is_page()):
	$class = "page page-template-default";
else:
	$class = "";
endif;
?>
<body <?php body_class('class-name'); ?>>
	<img alt="full screen background image" src="<?php echo get_template_directory_uri(); ?>/background/box12.jpg" id="full-screen-background-image">
	<div id="wrapper" class="clearfix">
		<div class="top-bar">
			<div class="frame">
				<div class="frame-inside">
					<!-- header navigation menu -->
					<div class="menu-header-container">
						 
						<ul id="menu-header" class="nav">
							<?php menu_list('header-menu', 'menu-item menu-item-type-custom menu-item-object-custom menu-item-home'); ?>
						</ul>
						
					</div>								
								
					<!-- social icons -->
					<div id="social-strip-icons">
						<div class="fadehover">
							<a href="<?php echo get_option('MA_vimeo'); ?>" title="vimeo"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-vimeo.png" alt="vimeo" class="a" /></a>
							<a href="<?php echo get_option('MA_vimeo'); ?>" title="vimeo"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-vimeo-color.png" alt="vimeo" class="b" /></a>
						</div>

						<div class="fadehover">
							<a href="mailto:<?php echo get_option('MA_email'); ?>" title="email"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-email.png" alt="email" class="a" /></a>
							<a href="mailto:<?php echo get_option('MA_email'); ?>" title="email"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-email-color.png" alt="email" class="b" /></a>
						</div>

						<div class="fadehover">
							<a href="<?php echo get_option('MA_facebook'); ?>" title="facebook"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-facebook.png" alt="facebook" class="a" /></a>
							<a href="<?php echo get_option('MA_facebook'); ?>" title="facebook"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-facebook-color.png" alt="facebook" class="b" /></a>
						</div>

						<div class="fadehover">
							<a href="http://www.flickr.com/photos/<?php echo get_option('MA_flickr'); ?>" title="flickr"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-flickr.png" alt="flickr" class="a" /></a>
							<a href="http://www.flickr.com/photos/<?php echo get_option('MA_flickr'); ?>" title="flickr"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-flickr-color.png" alt="flickr" class="b" /></a>
						</div>

						<div class="fadehover">
							<a href="http://twitter.com/<?php echo get_option('MA_twitter'); ?>" title="twitter"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-twitter.png" alt="twitter" class="a" /></a>
							<a href="http://twitter.com/<?php echo get_option('MA_twitter'); ?>" title="twitter"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-twitter-color.png" alt="twitter" class="b" /></a>
						</div>
					</div>
									
				</div><!-- frame inside -->
			</div><!-- frame -->
		</div><!-- top bar -->
		<div style="clear:both;"></div>