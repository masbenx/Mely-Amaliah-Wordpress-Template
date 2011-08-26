<?php get_header(); ?>
		<div id="main" class="clearfix">			
			<!-- grab the sidebar -->
			<?php get_sidebar();?>
			<!-- sidebar wrap -->			
			
			<div id="content" class="filter-posts">
				<!-- grab the posts -->				
				<div data-type="" <?php post_class(); ?>>
					<div class="box">
						<div class="shadow clearfix">
							<div class="frame">								
								<div class="okvideo">
								</div>							
								
								<a class="post-thumb" href="<?php echo home_url(); ?>" title="404 not found"><img src="<?php echo get_template_directory_uri(); ?>/images/404.jpg" /></img></a>
								
							</div><!-- frame -->
						</div><!-- shadow -->
						
						<!-- meta info bar -->
						<div class="bar" style="display:none;">
							<div class="bar-frame clearfix">
								<div class="author">
								</div>								
							</div><!-- bar frame -->
						</div><!-- bar -->					
					</div><!-- box -->
				</div><!--writing post-->
								
				<div style="clear:both;"> </div>
								
				<div class="post-nav">
					<div class="postnav-left"></div>
					<div class="postnav-right"></div>
					<div style="clear:both;"> </div>
				</div><!--end post navigation-->				
								
				<!-- grab comments on single pages -->
			</div><!--content-->
			<div class="push"></div>
		</div><!--main-->
		<div style="clear:both;"> </div>
<?php get_footer(); ?>