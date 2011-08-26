			<div id="sidebar-wrap" class="clearfix">
				<div id="sidebar">
					<!-- grab the logo -->
					<h1 class="logo-title">
						<a href="http://masbenx.net/"><img class="logo" src="<?php echo get_template_directory_uri();?>/images/masbenx.png" alt="Bugatti Type 35B" height="40" /></a>
					</h1>
					<!-- otherwise show the site title and description -->	
		            	
					<!-- grab sidebar widgets -->				
					<div class="widget">
						<h2 class="widgettitle">About Me</h2>
						<div class="textwidget"><?php echo get_option('MA_aboutme');?></div>
					</div>
					<div class="widget">
						<div class="flickr">
							<h2 class="widgettitle">Flickr</h2>
							<?php flickr_gallery();?>
							<div style="clear:both;"></div>
							<a target="_blank" class="flickr-more" href="http://www.flickr.com/photos/<?php echo get_option('MA_flickr'); ?>" title="">More Photos &rarr;</a>
						</div>
					</div>
									
					<?php if (dynamic_sidebar()):?>
					<div class="widget">
						<?php dynamic_sidebar( 'Right Sidebar' ); ?>
					</div>
					<?php endif;?>
					
				</div><!--sidebar-->
				
				<div style="clear:both;"></div>
	
				<!-- grab the sticky sidebar on the main blog pages, hide it on inside pages -->
				<div id="sticky" class="clearfix">
					<h2 class="sticky-title">Sticky Sidebar</h2>
					<div class="widget">
						<div class="twitter-box">
				 			<h2>Twitter</h2>
				 			<ul class="tweet-scroll">				 			<?php  
				 				$statuses = getTwitterStatus(3);
								foreach ($statuses as $status) { ?>								
				 					<li>
				 						<?php echo $status['message']; ?>
				 						<br/><b><?php echo $status['time']; ?></b>
				 					</li>				 				
								<?php } ?>
							<ul class="tweet-scroll">			 			
				 			<a class="tweets-more" href="http://twitter.com/<?php echo get_option('MA_twitter'); ?>" target="_blank" title="twitter">More Tweets &rarr;</a>
				 		</div>
				 	</div>
				 	<div class="widget">
				 		<form action="#" class="search-form clearfix">
							<fieldset>
								<input type="text" class="search-form-input text" name="s" onfocus="if (this.value == 'search the site') {this.value = '';}" onblur="if (this.value == '') {this.value = 'search the site';}" value="search the site"/>
								<input type="submit" value="Go" class="submit" />
							</fieldset>
						</form>
					</div>
				</div><!-- sticky -->
				<div style="clear:both;"></div>
			</div>