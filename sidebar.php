			<div id="sidebar-wrap" class="clearfix">
				<div id="sidebar">
					<!-- grab the logo -->
					<h1 class="logo-title">
						<a href="http://masbenx.net/"><img class="logo" src="<?php bloginfo('template_directory');?>/images/masbenx.png" alt="Bugatti Type 35B" height="40" /></a>
					</h1>
					<!-- otherwise show the site title and description -->	
		            	
					<!-- grab sidebar widgets -->				
					<div class="widget">
						<h2 class="widgettitle">About Me</h2>
						<div class="textwidget">[wcs_tud user=masbenx data=description].</div>
					</div>
					<div class="widget">
						<div class="flickr">
							<h2 class="widgettitle">Flickr</h2>
							<ul class="flickrPhotos">
								<li><a class="lightbox" rel="flickr" href="http://farm4.static.flickr.com/3440/5839925031_0e516d68f5.jpg" title="Shot_1299500925"><img src="http://farm4.static.flickr.com/3440/5839925031_0e516d68f5.jpg" alt="Shot_1299500925" title="Shot_1299500925" /></a></li>
								<li><a class="lightbox" rel="flickr" href="http://farm4.static.flickr.com/3395/5840472742_52316be1b5.jpg" title="Shot_1299503390"><img src="http://farm4.static.flickr.com/3395/5840472742_52316be1b5.jpg" alt="Shot_1299503390" title="Shot_1299503390" /></a></li>
								<li><a class="lightbox" rel="flickr" href="http://farm6.static.flickr.com/5264/5839924719_37a1ab8083.jpg" title="Shot_1299581396"><img src="http://farm6.static.flickr.com/5264/5839924719_37a1ab8083.jpg" alt="Shot_1299581396" title="Shot_1299581396" /></a></li>
								<li><a class="lightbox" rel="flickr" href="http://farm4.static.flickr.com/3128/5839924553_8e76a834a3.jpg" title="Shot_1300245514"><img src="http://farm4.static.flickr.com/3128/5839924553_8e76a834a3.jpg" alt="Shot_1300245514" title="Shot_1300245514" /></a></li>
							</ul>
							<div style="clear:both;"></div>
							<a target="_blank" class="flickr-more" href="http://flickr.com/photos/64104492@N02" title="">More Photos &rarr;</a>
						</div>
					</div>
				</div><!--sidebar-->
				
				<div style="clear:both;"></div>
	
				<!-- grab the sticky sidebar on the main blog pages, hide it on inside pages -->
				<div id="sticky" class="clearfix">
					<h2 class="sticky-title">Sticky Sidebar</h2>
					<div class="widget">
						<div class="twitter-box">
				 			<h2>Twitter</h2>
				 			<ul class="tweet-scroll">				 			<?php  
				 				$statuses = getTwitterStatus(4);
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