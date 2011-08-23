<?php get_header(); ?>
		<div id="main" class="clearfix">			
			<!-- grab the sidebar -->
			<?php get_sidebar();?>
			<!-- sidebar wrap -->			
			
			<div id="content" class="filter-posts">
				<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
				<!-- grab the posts -->				
				<div data-id="post-81" data-type="photography" class="post-81 photography post clearfix project">
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
								<div class="okvideo">
								</div>							
								<?php if ( has_post_thumbnail() ): ?>
										<a class="post-thumb" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'homepage-thumb' );?></a>
								<?php endif; ?>
															
	    						<?php if(strlen($post -> post_title) == 0){ ?> <p><a href="<?php the_permalink() ?>">Read more about this..</a></p> <?php }?>
								<?php the_content('Click here to read more.. &raquo;'); ?>
								<?php wp_link_pages( array( 'before' => '<p><div class="navigation"><div id="previous-posts">' . __( 'Pages:', '' ), 'after' => '</div></div></p>' ) ); ?>
							</div><!-- frame -->
						</div><!-- shadow -->
						
						<!-- meta info bar -->
						<div class="bar" >
							<div class="bar-frame clearfix">
								<div class="date">
									<strong class="day"><?php the_time('j') ?></strong>
									<div class="holder">
										<span class="month"><?php the_time('F') ?></span>
										<span class="year"><?php the_time('Y') ?></span>
									</div>
								</div>
								<div class="author">
									<strong class="title">AUTHOR</strong>
									<a href="<?php the_author_url(); ?>" title="Visit <?php the_author(); ?>;s website" rel="external"><?php the_author(); ?></a>
								</div>
								<div class="categories">
									<strong class="title">CATEGORY</strong>
									<p><?php the_category(', ') ?></p>
								</div>
								<div class="comments">
									<strong class="title">COMMENTS</strong>
									<a href="<?php the_permalink() ?>"><?php comments_number( '0 comment', '1 comment', '% comments' ); ?></a>
								</div>
								<div class="next-post">
									<?php next_post_link('<strong class="title">NEXT POST</strong> %link'); ?>
								</div>
								
								<div class="prev-post">
									<?php previous_post_link('<strong class="title">PREVIOUS POST</strong> %link'); ?>
								</div>
							</div><!-- bar frame -->
						</div><!-- bar -->
					</div><!-- box -->
				</div><!--writing post-->
				
				<?php comments_template( '', true ); ?>
				
				<?php endwhile; ?><!-- end loop post -->
				<?php endif;?>
				
				<div style="clear:both;"> </div>
				
				<div class="post-nav">
					<div class="postnav-left"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
					<div class="postnav-right"><?php next_posts_link('Next Entries &raquo;','') ?></div>
					<div style="clear:both;"> </div>
				</div><!--end post navigation-->				
								
				<!-- grab comments on single pages -->
				
			</div><!--content-->
								
				
			
			<div class="push"></div>
		</div><!--main-->
		<div style="clear:both;"> </div>
<?php get_footer(); ?>