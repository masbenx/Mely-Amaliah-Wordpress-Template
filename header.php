<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head> 
	<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>	
	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/mely.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js?ver=3.2.1'></script>
	<!-- google fonts -->
	<link href='http://fonts.googleapis.com/css?family=Rokkitt&amp;v2' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Istok+Web:400,700&amp;v2' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Play:400,700&amp;v2' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css" type="text/css" media="screen" />
	
	<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js'></script>
	<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/jquery.sticky.js'></script>
	<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/quicksand/jquery-css-transform.js'></script>
	<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/quicksand/jquery.easing.1.3.js'></script>
	<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/quicksand/quicksand.js'></script>	
</head>

<body class="archive category category-photography category-15">
	<img alt="full screen background image" src="<?php bloginfo('template_directory'); ?>/background/box12.jpg" id="full-screen-background-image">
	<div id="wrapper" class="clearfix">
		<div class="top-bar">
			<div class="frame">
				<div class="frame-inside">
					<!-- header navigation menu -->
					<div class="menu-header-container">
						 
						<ul id="menu-header" class="nav">
							<li id="menu-item-109" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-109"><a href="<?php bloginfo('url'); ?>">Home</a></li>
							<?php //wp_nav_menu( array( 'menu' => 'li', 'menu_class' => 'menu-item menu-item-type-custom menu-item-object-custom menu-item-home', 'theme_location' => 'primary-menu', 'items_wrap' => '%3$s' )); ?>
							<?php header_menu_list(); ?>
							<!--
							<li id="menu-item-110" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-110"><a href="sample-page.html">Sample Page</a></li>
							<li id="menu-item-85" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-85"><a href="http://#">Drop Menu</a></li>
							<li id="menu-item-218" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-218"><a href="contact.html">Contact</a></li>
							!-->
						</ul>
						
					</div>								
								
					<!-- social icons -->
					<div id="social-strip-icons">
						<div class="fadehover">
							<a href="<?php echo get_option('MA_vimeo'); ?>" title="vimeo"><img src="<?php bloginfo('template_directory'); ?>/images/icon-vimeo.png" alt="vimeo" class="a" /></a>
							<a href="<?php echo get_option('MA_vimeo'); ?>" title="vimeo"><img src="<?php bloginfo('template_directory'); ?>/images/icon-vimeo-color.png" alt="vimeo" class="b" /></a>
						</div>

						<div class="fadehover">
							<a href="mailto:<?php echo get_option('MA_email'); ?>" title="email"><img src="<?php bloginfo('template_directory'); ?>/images/icon-email.png" alt="email" class="a" /></a>
							<a href="mailto:<?php echo get_option('MA_email'); ?>" title="email"><img src="<?php bloginfo('template_directory'); ?>/images/icon-email-color.png" alt="email" class="b" /></a>
						</div>

						<div class="fadehover">
							<a href="<?php echo get_option('MA_facebook'); ?>" title="facebook"><img src="<?php bloginfo('template_directory'); ?>/images/icon-facebook.png" alt="facebook" class="a" /></a>
							<a href="<?php echo get_option('MA_facebook'); ?>" title="facebook"><img src="<?php bloginfo('template_directory'); ?>/images/icon-facebook-color.png" alt="facebook" class="b" /></a>
						</div>

						<div class="fadehover">
							<a href="<?php echo get_option('MA_flickr'); ?>" title="flickr"><img src="<?php bloginfo('template_directory'); ?>/images/icon-flickr.png" alt="flickr" class="a" /></a>
							<a href="<?php echo get_option('MA_flickr'); ?>" title="flickr"><img src="<?php bloginfo('template_directory'); ?>/images/icon-flickr-color.png" alt="flickr" class="b" /></a>
						</div>

						<div class="fadehover">
							<a href="http://twitter.com/<?php echo get_option('MA_twitter'); ?>" title="twitter"><img src="<?php bloginfo('template_directory'); ?>/images/icon-twitter.png" alt="twitter" class="a" /></a>
							<a href="http://twitter.com/<?php echo get_option('MA_twitter'); ?>" title="twitter"><img src="<?php bloginfo('template_directory'); ?>/images/icon-twitter-color.png" alt="twitter" class="b" /></a>
						</div>
					</div>
									
				</div><!-- frame inside -->
			</div><!-- frame -->
		</div><!-- top bar -->
		<div style="clear:both;"></div>