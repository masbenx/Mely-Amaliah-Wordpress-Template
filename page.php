<?php get_header(); ?>
		<div id="main" class="clearfix">			
			<!-- grab the sidebar -->
			<?php get_sidebar();?>
			<!-- sidebar wrap -->		
			
			<div id="content" class="filter-posts">
				<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
				<!-- grab the posts -->				
				<div data-id="post-<?php the_ID(); ?>" data-type="" <?php post_class(" post clearfix project"); ?>>
					<div class="box">
						<div class="shadow clearfix">
							<div class="frame">
								<?php 
									if(strlen($post -> post_title) > 0){
								?>
								<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<?php 
									}
								?>															
								<?php if ( has_post_thumbnail() ): ?>
										<a class="post-thumb" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'homepage-thumb' );?></a>
								<?php endif; ?>
															
	    						<?php if(strlen($post -> post_title) == 0){ ?> <p><a href="<?php the_permalink() ?>">Read more about this..</a></p> <?php }?>
								<?php the_content('Click here to read more.. &raquo;'); ?>
								<?php wp_link_pages( array( 'before' => '<p><div class="navigation"><div id="previous-posts">' . __( 'Pages:', '' ), 'after' => '</div></div></p>' ) ); ?>
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
				
				
				
				<?php endwhile; ?><!-- end loop post -->
				<?php endif;?>
				
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